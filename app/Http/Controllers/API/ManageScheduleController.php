<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Post;
use Carbon\Carbon;
use Telegram\Bot\Objects\Update;

class ManageScheduleController extends Controller
{
    private $graphUrl;
    private $accessToken;

    public function __construct()
    {
        $this->graphUrl = config('services.facebook.graph_url');
        $this->accessToken = config('services.facebook.access_token');
    }

    public function storeSchedule(PostRequest $PostRequest)
    {
        $postData = $PostRequest->validated();

        // Set the user_id and user_fb_account_id values
        $postData['user_id'] = $PostRequest->user_id;
        $postData['user_fb_account_id'] = $PostRequest->user_fb_account_id;
        $postData['title'] = $PostRequest->title;
        $postData['price'] = $PostRequest->price;
        $postData['caption'] = $PostRequest->caption;
        $postData['hashtag'] = $PostRequest->hashtag;
        $postData['post_time'] = $PostRequest->post_time;
        $postData['group_id_destination'] = $PostRequest->group_id_destination;

        // Create the post
        $post = Post::create($postData);

        // Add media to the post
        $media = $post->addMediaFromRequest('image')->toMediaCollection('image', 'media/post');

        // Update the post with the media_id
        $post->update(['media_id' => $media->id]);

        $imageUrl = $media->getFullUrl();

        return response([
            'message' => 'Scheduled Post Created Successfully',
            'data' => [
                'post' => $post,
                'image_url' => $imageUrl, // Add image URL to the response
            ],
        ], 200);
    }


    public function getAllSchedule(Request $request)
    {
        $all_post_list = Post::where('user_id', $request->user_id)->get();

        if ($all_post_list->isNotEmpty()) {
            $formattedPosts = $all_post_list->map(function ($post) {
                $media = $post->getFirstMedia('image');

                if ($media) {
                    $imageUrl = $media->getFullUrl();
                } else {
                    $imageUrl = null;
                }

                return [
                    'post' => $post,
                    'image_url' => $imageUrl,
                ];
            });

            return response([
                'message' => 'Successfully Get All Scheduled Post',
                'post_list' => $formattedPosts,
            ], 200);
        } else {
            return response([
                'message' => 'No Scheduled Post Available',
                'post_list' => null,
            ], 200);
        }
    }


    public function checkPost()
    {
        $on_time_post_list = Post::whereBetween('post_time', [Carbon::now()->startOfMinute(), Carbon::now()->endOfMinute()])
            ->get();

        if ($on_time_post_list->isNotEmpty()) {
            $formattedPosts = $on_time_post_list->map(function ($post) {
                $media = $post->getFirstMedia('post');

                if ($media) {
                    $imageUrl = $media->getFullUrl();
                } else {
                    $imageUrl = null;
                }

                return [
                    'post' => $post,
                    'image_url' => $imageUrl,
                ];
            });

            return response([
                'message' => 'Successfully get post',
                'post_list' => $formattedPosts,
            ], 200);
        } else {
            return response([
                'message' => 'No Post List Available',
                'post_list' => [],
            ], 200);
        }
    }


    public function postToGroup(Request $request)
    {
        $post_list = Post::whereBetween('post_time', [Carbon::now()->startOfMinute(), Carbon::now()->endOfMinute()])->get();

        if (count($post_list) > 0) {
            foreach ($post_list as $post) {
                if ($request->hasFile('file') && $request->file('file')->isValid()) {
                    $response = Http::attach(
                        'file',
                        file_get_contents($request->file('file')->path()),
                        $request->file('file')->getClientOriginalName()
                    )->post($this->graphUrl . $post->group_id . '/photos', [
                        'access_token' => $this->accessToken,
                        'message' => $request->message,
                    ]);

                    if ($response->successful()) {
                        return response([
                            'message' => 'success',
                            'response' => $response,
                            'post_list' => $post_list
                        ]);
                    } else {
                        return response([
                            'message' => 'error',
                            'response' => $response,
                            'post_list' => $post_list
                        ]);
                    }
                } else {
                    return response([
                        'message' => 'error',
                        'response' => 'Invalid or missing file in the request.'
                    ]);
                }
            }

            return response([
                'message' => 'success',
                'post_list' => $post_list
            ]);
        }

        return response([
            'message' => 'success get 0 data',
            'post_list' => null
        ]);
    }

    public function editSchedule(Request $request)
    {
        $schedule = Post::where('id', $request->input('id'))->first();

        return response()->json([
            'message' => 'Successfully retrieved the schedule',
            'schedule' => $schedule
        ], 200);
    }

    public function updateSchedule(UpdateScheduleRequest $updateScheduleRequest)
    {
        try {
            $updateScheduleRequest->validated();

            $post = Post::where('id', $updateScheduleRequest->id)->first();

            $post->update([
                'post_time' => $updateScheduleRequest->post_time,
            ]);

            return response()->json([
                'message' => 'Schedule updated successfully',
                'data' => $post,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update schedule',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteSchedule(Request $request)
    {
        $schedule = Post::where('id', $request->id)->first();

        if ($schedule->delete()) {
            return response()->json([
                'message' => 'Successfully deleted the schedule',
                'schedule' => $schedule
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error while deleting the schedule'
            ], 500);
        }
    }
}
