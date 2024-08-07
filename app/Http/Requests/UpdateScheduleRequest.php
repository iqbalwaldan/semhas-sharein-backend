<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateScheduleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_time' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
                function ($attribute, $value, $fail) {
                    $currentTime = Carbon::now();
                    $inputTime = Carbon::createFromFormat('Y-m-d H:i:s', $value);

                    if ($inputTime <= $currentTime) {
                        $fail($attribute . ' must be a date and time after now.');
                    }
                },
            ],
        ];
    }
}
