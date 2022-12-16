<?php

namespace App\Http\Resources\Workshop\WorkshopInformations;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class WorkshopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'logo' => Storage::disk('workshop')->url($this->logo),
            'places' => $this->places->toArray() ?? [],
            'additional_fields' => $this->additionalFields->toArray(),
            'contact_form' => $this->contactForm,
            'owners' => $this->owners,
            'informations' => [
                'name' => $this->name,
                'nip' => $this->nip,
                'regon' => $this->regon,
                'company_created_at' => $this->company_created_at,
            ],
            'contact' => [
                'phone' => $this->phone,
                'email' => $this->email,
                'website' => $this->website,
                'social_media' => [
                    'facebook' => $this->social_media['facebook'] ?? null,
                    'instagram' => $this->social_media['instagram'] ?? null
                ]
            ]
        ];
    }
}
