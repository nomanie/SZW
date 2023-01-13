<?php

namespace App\Http\Resources\Workshop;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'street' => $this->street,
            'building_number' => $this->building_number,
            'flat_number' => $this->flat_number,
            'zip_code' => $this->zip_code,
            'consent_marketing_notification' => (bool) $this->consent_marketing_notification,
            'consent_sms_notification' => (bool) $this->consent_sms_notification
        ];
    }
}
