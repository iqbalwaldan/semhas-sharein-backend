<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Illuminate\Console\Command;

class PostToFacebook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:post';
    // protected $signature = 'posts:run-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Post to Page Facebook based on schedule';
    protected $description = 'Run scheduled posts';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Schedule::runScheduledPosts();
        return 0;
    }
}
