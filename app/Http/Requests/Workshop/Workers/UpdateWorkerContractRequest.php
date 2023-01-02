<?php

namespace App\Http\Requests\Workshop\Workers;

use App\Enums\Workshop\ContractTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkerContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'contract_from' => 'required|date',
            'contract_to' => 'sometimes|nullable|date',
            'contract_type' => Rule::in(ContractTypeEnum::cases()),
            'position' => 'sometimes|nullable',
            'salary' => 'sometimes|nullable'
        ];
    }

    public function messages()
    {
        return [
            'contract_from.required' => 'To pole jest wymagane',
            'contract_from.date' => 'To pole musi być datą',
            'contract_type.in' => 'Rodzaj umowy jest zły',
        ];
    }
}
