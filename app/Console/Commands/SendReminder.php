<?php

namespace App\Console\Commands;

use App\Http\Controllers\Client\ReminderController;
use Illuminate\Console\Command;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new ReminderController();
        $controller->sendReminder();

        return 0;
    }
}
