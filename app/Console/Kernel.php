<?php

namespace App\Console;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use App\Models\Newsletter;
use App\Mail\NewsletterMail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->exec('php artisan newsletter:send')->dailyAt('15:00')->timezone('Asia/Jakarta');
        // $schedule->exec('php artisan reminder:check')->everyMinute()->timezone('Asia/Jakarta');
        // $schedule->exec('php artisan group:post')->everyMinute()->timezone('Asia/Jakarta');
        // $schedule->exec('php artisan page:post')->everyMinute()->timezone('Asia/Jakarta');
        // $schedule->command('page:post')->everyMinute()->timezone('Asia/Jakarta');
        $schedule->command('reminder:send')->everyMinute()->timezone('Asia/Jakarta');
        $schedule->command('auto:post')->everyMinute()->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
