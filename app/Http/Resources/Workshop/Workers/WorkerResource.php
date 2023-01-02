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
        $contract = $this->currentContract;
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'login' => $this->login,
            'info' => $this->info,
            'contract_id' => $contract->id,
            'is_active' => $this->is_active,
            'salary' => $contract->salary,
            'contract_type' => $contract->contract_type,
            'contract_from' => $contract->contract_from,
            'contract_to' => $contract->contract_to,
            'position' => $contract->position,
            'for_indefined_period' => $contract->contract_to === null,
            'permissions' => $this->permissions->pluck('pivot')->pluck('permission_id')
        ];
    }
}
