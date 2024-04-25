<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class GroupPostCommand extends Command
{
    private $graphUrl;
    private $accessToken;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'group:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post to groups at a specific time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->graphUrl = config('services.facebook.graph_url');
        $this->accessToken = config('services.facebook.access_token');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $post_list = Post::whereBetween('post_time', [Carbon::now()->startOfMinute(), Carbon::now()->endOfMinute()])->get();

        foreach ($post_list as $post) {
            $this->postToGroups($post);
        }
    }

    // private function postToGroups(Post $post)
    // {
    //     $response = Http::attach(
    //         'file',
    //         file_get_contents($post->file->path()),
    //         $post->file->getClientOriginalName()
    //     )->post($this->graphUrl . $post->group_id . '/photos', [
    //         'access_token' => $this->accessToken,
    //         'message' => $post->message,
    //     ]);

    //     if ($response->successful()) {
    //         $data = $response->json();
    //         $this->info("Successfully posted for Post ID: {$post->id}");
    //     } else {
    //         $this->error("Failed to post for Post ID: {$post->id}");
    //         $this->error($response->json());
    //     }
    // }
    private function postToGroups(Post $post)
    {
        $response = Http::attach(
            'file',
            file_get_contents($post->file->path()),
            $post->file->getClientOriginalName()
        )->post($this->graphUrl . $post->group_id . '/photos', [
            'access_token' => $this->accessToken,
            'message' => $post->title,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->info("Successfully posted for Post ID: {$post->id}");
        } else {
            $this->error("Failed to post for Post ID: {$post->id}");
            $this->error("HTTP Status Code: {$response->status()}");
            $this->error("Response Body: " . json_encode($response->json(), JSON_PRETTY_PRINT));
        }
    }
}
