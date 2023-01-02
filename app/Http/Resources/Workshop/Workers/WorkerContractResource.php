<?php

namespace App\Http\Resources\Workshop\Workers;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerContractResource extends JsonResource
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
            'salary' => $this->salary,
            'position' => $this->position,
            'contract_from' => $this->contract_from,
            'contract_to' => $this->contract_to,
            'contract_type' => $this->contract_type,
            'is_archived' => $this->is_archived,
        ];
    }
}
