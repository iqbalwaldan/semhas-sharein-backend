<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Post;
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
                'remainder' => false,
            ]);

            // Save media to database
            // Proses pengunggahan file
            if ($request->hasFile('file_input')) {
                $file = $request->file('file_input');
                $fileCopy = $file->storeAs('tmp', $file->getClientOriginalName());

                // Reopen the stored file and add it to the media collection
                $post->addMedia(storage_path('app/tmp/' . $file->getClientOriginalName()))
                    ->usingFileName($file->getClientOriginalName())
                    ->toMediaCollection('post_photo', 'media/post');
            }

            // Post to Facebook
            // $client = new Client();
            // $response = $client->request('POST', 'https://graph.facebook.com/v20.0/' . $decode->id . '/feed', [
            //     'headers' => [
            //         'Accept' => 'application/json',
            //         'Authorization' => 'Bearer ' . $decode->access_token,
            //     ],
            //     'form_params' => [
            //         'message' => $request->caption,
            //     ]
            // ]);





            // $response = json_decode($response->getBody(), true);
            // if (isset($response['id'])) {
            //     $post->update([
            //         'post_id' => $response['id'],
            //     ]);
            // } else if (isset($response['post_id'])){
            //     $post->update([
            //         'post_id' => $response['post_id'],
            //         'media_id' => $response['id'],
            //     ]);
            // }
            DB::commit();
        }
    }
}
