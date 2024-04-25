<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpenAIRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAIController extends Controller
{
    public function openAIGenerate(OpenAIRequest $openAIRequest)
    {
        $title = $openAIRequest->title;

        $result = [];

        for ($i = 0; $i < 2; $i++) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.open-ai.client_key'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $title
                    ]
                ],
                'max_tokens' => 200,
                'stop' => ["11."],
            ])->json();

            if (isset($response['choices'][0]['message']['content'])) {
                $result[] = $i == 0
                    ? ['caption' => $response['choices'][0]['message']['content']]
                    : ['caption' => $i . '. ' . $response['choices'][0]['message']['content']];
            } else {
                return response([
                    'message' => 'Error: Unexpected response structure from Open AI',
                    'data' => $response,
                ], 500);
            }
        }

        return response([
            'message' => 'Successfully Generate From Open AI',
            'result' => $result,
        ]);
    }
}
