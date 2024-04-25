<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Newsletter;
use App\Mail\NewsletterMail;

class NewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletters every minute without a time limit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $recipients = Newsletter::all()->pluck('email')->toArray();

        Mail::to($recipients)->send(new NewsletterMail($recipients));
    }
}
