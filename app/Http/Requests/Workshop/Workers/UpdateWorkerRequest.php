<?php

namespace App\Http\Requests\Workshop\Workers;

use App\Enums\Workshop\ContractTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'login' => 'required',
            'phone' => 'string|min:9',
            'info' => 'sometimes',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('Imię jest wymagane'),
            'first_name.string' => __('Imię musi być ciągiem znaków'),
            'first_name.min' => __('Imię jest za krótkie'),
            'last_name.required' => __('Nazwisko jest wymagane'),
            'last_name.string' => __('Nazwisko musi być ciągiem znaków'),
            'last_name.min' => __('Nazwisko jest za krótkie'),
            'phone.string' => __('Numer telefonu musi być ciągiem znaków'),
            'phone.min' => __('Numer telefonu jest błędny'),
            'login.required' => __('Login jest wymagany'),
            'email.required' => __('Adres e-mail jest wymagany'),
        ];
    }
}
