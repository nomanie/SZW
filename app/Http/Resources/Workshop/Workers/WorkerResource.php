<?php

namespace App\Http\Resources\Workshop\Workers;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'login' => $this->login,
            'position' => $this->position,
            'contract_from' => $this->contract_from,
            'contract_to' => $this->contract_to,
            'contract_type' => $this->contract_type,
            'salary' => $this->salary,
            'info' => $this->info,
            'is_active' => $this->is_active,
        ];
    }
}
