<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Reminder;
use App\Models\Schedule;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoPostController extends Controller
{
    public function index()
    {
        return view('client.user.auto-post.index', [
            'title' => 'Auto Post',
            'active' => 'auto-post',
        ]);
    }

    public function getFacebookData(Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://graph.facebook.com/v20.0/me/accounts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('API_TOKEN'), // Jika memerlukan token
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json($data['data']);
    }

    public function post(Request $request)
    {
        $facebook_page = $request->facebook_page;
        for ($i = 0; $i < count($facebook_page); $i++) {
            $decode = json_decode($facebook_page[$i]);

            // Save post to database
            DB::beginTransaction();
            $post = Post::create([
                'user_id' => auth()->id(),
                'page_id' => $decode->id,
                'caption' => $request->caption,
                'status' => 'publish',
            ]);

            // Save media to database
            if ($request->hasFile('file_input')) {
                $file = $request->file('file_input');
                $fileCopy = $file->storeAs('tmp', $file->getClientOriginalName());

                $post->addMedia(storage_path('app/tmp/' . $file->getClientOriginalName()))
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('post_photo', 'media/post');
            }

            // Save schedule to database
            if ($request->has('date')) {
                $datetime = $request->date . ' ' . $request->time;
                $schedule = Schedule::create([
                    'post_id' => $post->id,
                    'post_time' => $datetime,
                ]);

                $post->update([
                    'status' => 'scheduled',
                ]);

                // Save to reminder
                $reminder = Reminder::create([
                    'user_id' => auth()->id(),
                    'name' => 'Post Reminder',
                    'email' => auth()->user()->email,
                    'description' => 'Post Reminder',
                    'reminder_time' => $datetime,
                ]);
            }

            DB::commit();

            if ($request->hasFile('file_input')) {
                // Post Image to Facebook
                $client = new Client();
                $response = $client->request('POST', 'https://graph.facebook.com/v20.0/' . $decode->id . '/photos', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $decode->access_token,
                    ],
                    'form_params' => [
                        'message' => $request->caption,
                        'url' => $post->getFirstMediaUrl('post_photo'),
                    ]
                ]);
            } else {
                // Post Caption to Facebook
                $client = new Client();
                $response = $client->request('POST', 'https://graph.facebook.com/v20.0/' . $decode->id . '/feed', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $decode->access_token,
                    ],
                    'form_params' => [
                        'message' => $request->caption,
                    ]
                ]);
            }

            $response = json_decode($response->getBody(), true);
            if (isset($response['id'])) {
                $post->update([
                    'post_id' => $response['id'],
                ]);
            } else if (isset($response['post_id'])) {
                $post->update([
                    'post_id' => $response['post_id'],
                    'media_id' => $response['id'],
                ]);
            }
        }
    }
}
