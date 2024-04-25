<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PostToGroupRequest;

class GroupPostController extends Controller
{
    private $graphUrl;
    private $accessToken;

    public function __construct()
    {
        $this->graphUrl = config('services.facebook.graph_url');
        $this->accessToken = config('services.facebook.access_token');
    }

    public function getGroups(Request $request)
    {
        $response = Http::get($this->graphUrl . $request->user_fb_account_id . '/groups', [
            'access_token' => $this->accessToken,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'message' => 'Successfully get data',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to get data from Facebook API',
                'error' => $response->json(),
            ], 500);
        }
    }

    public function postToGroup(PostToGroupRequest $postToGroupRequest)
    {
        if (is_array($postToGroupRequest->group_id) && count($postToGroupRequest->group_id) > 1) {
            $successfullyPostedGroups = [];

            foreach ($postToGroupRequest->group_id as $groupId) {
                $response = Http::attach(
                    'file',
                    file_get_contents($postToGroupRequest->file('file')->path()),
                    $postToGroupRequest->file('file')->getClientOriginalName()
                )->post($this->graphUrl . $groupId . '/photos', [
                    'access_token' => $this->accessToken,
                    'message' => $postToGroupRequest->message,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $successfullyPostedGroups[] = $groupId;
                } else {
                    return response()->json([
                        'message' => 'Failed to get data from Facebook API for group_id: ' . $groupId,
                        'error' => $response->json(),
                    ], 500);
                }
            }

            return response()->json([
                'message' => 'Successfully posted to groups',
                'successfully_posted_groups_id' => $successfullyPostedGroups,
            ]);
        } else {
            $response = Http::attach(
                'file',
                file_get_contents($postToGroupRequest->file('file')->path()),
                $postToGroupRequest->file('file')->getClientOriginalName()
            )->post($this->graphUrl . $postToGroupRequest->group_id . '/photos', [
                'access_token' => $this->accessToken,
                'message' => $postToGroupRequest->message,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return response()->json([
                    'message' => 'Successfully posted to group',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to get data from Facebook API',
                    'error' => $response->json(),
                ], 500);
            }
        }
    }
}