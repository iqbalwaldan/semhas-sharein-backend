<?php

namespace App\Console\Commands;

use App\Http\Controllers\Client\AutoPostController;
use Illuminate\Console\Command;

class AutoPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Posting to Social Media';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new AutoPostController();
        $controller->schedulePost();

        return 0;
    }
}
