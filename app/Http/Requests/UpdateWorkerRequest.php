<?php

namespace App\Http\Requests;

use App\Enums\Workshop\ContractTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateWorkerRequest extends FormRequest
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'contract_from' => 'required|date',
            'contract_to' => 'required|date',
            'login' => 'required',
            'phone' => 'string|min:9',
            'contract_type' => Rule::in(ContractTypeEnum::getList()),
            'position' => 'sometimes',
            'info' => 'sometimes',
            'salary' => 'sometimes'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Imię jest wymagane',
            'first_name.string' => 'Imię musi być ciągiem znaków',
            'first_name.min' => 'Imię jest za krótkie',
            'last_name.required' => 'Nazwisko jest wymagane',
            'last_name.string' => 'Nazwisko musi być ciągiem znaków',
            'last_name.min' => 'Nazwisko jest za krótkie',
            'contract_from.required' => 'To pole jest wymagane',
            'contract_from.date' => 'To pole musi być datą',
            'contract_to.required' => 'To pole jest wymagane',
            'contract_to.date' => 'To pole musi być datą',
            'phone.string' => 'Numer telefonu musi być ciągiem znaków',
            'phone.min' => 'Numer telefonu jest błędny',
            'login.required' => 'Login jest wymagany',
            'contract_type.in' => 'Rodzaj umowy jest zły',
        ];
    }
}
