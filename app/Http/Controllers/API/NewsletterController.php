<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use App\Mail\NewsletterMail;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function index()
    {
        $recipients = Newsletter::all()->pluck('email')->toArray();

        if (!empty($recipients)) {
            return response([
                'message' => 'All Subscriber\'s Email Attached as Recipients',
                'recipients' => $recipients
            ], 200);
        } else {
            return response([
                'message' => 'There is no Subscriber\'s Email Attached as Recipients',
                'recipients' => null
            ], 200);
        }
    }

    public function store(NewsletterRequest $NewsletterRequest)
    {
        $newsletterData = $NewsletterRequest->validated();

        $checkDuplicate = Newsletter::where('email', $NewsletterRequest->email)->first();

        if ($checkDuplicate) {
            return response([
                'message' => 'You have already subscribed to Sharein',
                'email' => $checkDuplicate
            ], 409);
        } else {
            $newsletterData['email'] = $NewsletterRequest->email;
            $newsletter = Newsletter::create($newsletterData);

            return response([
                'message' => 'Thank you for subscribing to Sharein',
                'newsletter' => $newsletter
            ], 201);
        }
    }

    public function sendNewsletter()
    {
        $recipients = Newsletter::all()->pluck('email')->toArray();

        Mail::to($recipients)->send(new NewsletterMail($recipients));

        return response([
            'message' => 'Newsletters sent to all subsribers successfully',
            'recipients' => $recipients
        ], 201);
    }
}
