<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'email:rfc,dns'],
            'description' => ['required'],
            'reminder_time' => ['required', 'date'],
            'image' => ['required', 'file', 'image'],
        ];
    }
}
