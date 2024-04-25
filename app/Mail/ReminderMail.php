<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $reminders;
    private $name;
    private $email;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email)
    {
        // $this->reminders = $reminders;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))
            ->subject('Reminder from Sharein')
            ->view('reminder')
            ->with([
                'nama' => $this->name,
                'website' => 'https://sharein.adslink.id/'
            ]);
    }
}
