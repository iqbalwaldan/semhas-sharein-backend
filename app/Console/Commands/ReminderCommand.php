<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reminder;
use Carbon\Carbon;
use App\Mail\ReminderMail;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Users Reminder Every Minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminders = Reminder::whereBetween('reminder_time', [Carbon::now()->startOfMinute(), Carbon::now()->endOfMinute()])->get();

        if ($reminders->isNotEmpty()) {
            $data = $reminders->map(function ($reminder) {
                return [
                    'name' => $reminder->name,
                    'email' => $reminder->email,
                    'phone_number' => $reminder->phone_number
                ];
            });

            $name_recipients = $data->pluck('name')->toArray();
            $email_recipients = $data->pluck('email')->toArray();

            foreach ($email_recipients as $email) {
                $name_index = array_search($email, $email_recipients);
                $name = $name_recipients[$name_index];

                Mail::to($email)->send(new ReminderMail($name, $email));

                $this->info("Email sent to $name with email $email");
            }

            $this->info('Reminders checked and emails sent successfully.');
        } else {
            $this->info('No reminders to send.');
        }
    }
}
