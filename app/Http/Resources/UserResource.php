<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'email_verified_at' => $this->serializeDate($this->email_verified_at), //Serialization Date 
            'google_id' => $this->google_id,
            'roles_subscription' => $this->roles_subscription,
            'remember_token' => $this->remember_token,
            'created_at' => $this->serializeDate(Carbon::parse($this->created_at)), //Serialization Date
            'updated_at' => $this->serializeDate(Carbon::parse($this->updated_at)), //Serialization Date 
        ];
    }

    protected function serializeDate($date): ?string
    {
        if (!is_null($date)) {
            return $date->format('Y-m-d H:i:s'); //Melakukan Serialization Date
        }
        return null;
    }
}
