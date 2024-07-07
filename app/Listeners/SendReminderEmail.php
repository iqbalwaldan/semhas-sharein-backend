<?php

namespace App\Listeners;

use App\Events\ReminderEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;

class SendReminderEmail
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(object $event): void
    // {
    //     //
    // }
    public function handle(ReminderEmailEvent $event)
    {
        $reminder = $event->reminder;

        Mail::to($reminder->email)->send(new ReminderEmail($reminder));
    }
}
