<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacebookController extends Controller
{
    private $graphUrl;
    private $accessToken;

    public function __construct()
    {
        $this->graphUrl = config('services.facebook.graph_url');
        $this->accessToken = config('services.facebook.access_token');
    }

    public function getMe(Request $request)
    {
        $response = Http::get($this->graphUrl . 'me', [
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

    public function getGroups(Request $request)
    {
        $response = Http::get($this->graphUrl . '3487746578131976/groups', [
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

    public function postWithLocalPhoto(Request $request): \Illuminate\Http\JsonResponse
    {
        // Upload the local photo to Facebook and get the photo ID
        $photoId = $this->uploadLocalPhoto('C:\Users\chriz\OneDrive\Pictures\TUBESPAW\pp1.jpeg');

        // Create a post with the uploaded photo
        $response = Http::post($this->graphUrl . '3487746578131976/groups/feed', [
            'access_token' => $this->accessToken,
            'message' => 'This is the text content of my post with a local photo.',
            'attached_media[0]' => '{"media_fbid":"' . $photoId . '"}',
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'message' => 'Successfully posted with a local photo',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to post with a local photo to Facebook API',
                'error' => $response->json(),
            ], 500);
        }
    }

    private function uploadLocalPhoto(string $localPath): string
    {
        $response = Http::attach(
            'source',
            file_get_contents(public_path($localPath)),
            'photo.jpg'
        )->post($this->graphUrl . '3487746578131976/photos', [
            'access_token' => $this->accessToken,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Return the ID of the uploaded photo
            return $data['id'];
        } else {
            // Handle the case where the photo upload fails
            abort(500, 'Failed to upload local photo to Facebook API');
        }
    }

    // public function getGroups(Request $request)
    // {
    //     $response = Http::get($this->graphUrl . '3487746578131976/groups', [
    //         'access_token' => $this->accessToken,
    //     ]);

    //     if ($response->successful()) {
    //         $data = $response->json();

    //         return response()->json([
    //             'message' => 'Successfully get data',
    //             'data' => $data,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Failed to get data from Facebook API',
    //             'error' => $response->json(),
    //         ], 500);
    //     }
    // }

    public function post(Request $request)
    {
        $response = Http::post($this->graphUrl . 'me', [
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
}