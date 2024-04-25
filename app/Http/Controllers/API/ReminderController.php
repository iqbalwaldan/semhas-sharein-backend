<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReminderRequest;
use App\Mail\ReminderMail;
use App\Models\Reminder;
use App\Models\User;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class ReminderController extends Controller
{
    protected $telegram;

    public function createReminder(ReminderRequest $ReminderRequest)
    {
        $reminderData = $ReminderRequest->validated();

        $reminderData['user_id'] = Auth::user()->id;
        $reminderData['name'] = $ReminderRequest->name;
        $reminderData['phone_number'] = $ReminderRequest->phone_number;
        $reminderData['email'] = $ReminderRequest->email;
        $reminderData['description'] = $ReminderRequest->description;
        $reminderData['reminder_time'] = $ReminderRequest->reminder_time;

        $reminder = Reminder::create($reminderData);

        $media = $reminder->addMediaFromRequest('image')->toMediaCollection('image', 'media/reminder');
        $imageUrl = $media->getFullUrl();

        return response([
            'message' => 'Reminder Created Successfully',
            'data' => [
                'reminder' => $reminder,
                'image_url' => $imageUrl, // Menambahkan URL gambar ke dalam respons
            ],
        ], 200);
    }

    public function checkReminder()
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

                $recipients[] = "Email sent to $name with email $email";
            }

            return response([
                'messages' => 'Succesfully sent email to all recipients',
                'recipients' => $recipients
            ], 200);
        } else {
            return response([
                'message' => 'No reminders to send',
                'recipients' => null
            ], 200);
        }
    }

    public function sendMessage($id)
    {
        return $this->telegram->sendMessage([
            'chat_id' => $id,
            'text' => 'Selamat datang di Sharein Bot.'
        ]);
    }

    public function messages()
    {
        return $this->telegram->getUpdates();
    }

    public function getMe()
    {
        $response = Telegram::getMe();

        return $response;
    }

    public function setWebhook()
    {
        $url = 'https://4edf-2a09-bac5-3a1a-18c8-00-278-be.ngrok-free.app';

        // Menggunakan fasad Telegram untuk mengatur webhook
        $response = Telegram::setWebhook(['url' => $url . '/telegram/webhook/' . config('services.telegram.bot_token')]);

        // dd($response);
        // return ['message' => 'Webhook is already set'];
        return response([
            'message' => 'Webhook is already set',
            'response' => $response
        ]);
    }

    public function webhook(Request $request)
    {
        $user_id = $request['message']['from']['id'];

        $is_user_found = User::where('telegram_chat_id', $user_id)->first();

        if ($is_user_found->telegram_chat_id == null && $request['message'] == '/daftar') {
            Telegram::sendMessage([
                'chat_id' => $user_id,
                'user_id' => $is_user_found,
                'text' => 'Yes Sir, Welcome to Sharein' . $is_user_found
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $user_id,
                'user_id' => $is_user_found,
                'text' => 'Silahkan daftar terlebih dahulu dengan mengirim pesan /daftar' . $is_user_found
            ]);
        }
    }
}
