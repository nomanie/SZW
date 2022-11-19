<?php

namespace App\Http\Requests\Auth;

use App\Enums\AccountTypeEnum;
use App\Enums\Workshop\ContractTypeEnum;
use App\Rules\uniqueForAccountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class RegisterClientRequest extends FormRequest
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
            'email' =>  ['required','email', new uniqueForAccountType(AccountTypeEnum::CLIENT)],
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'password' => 'required|string|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('Adres e-mail jest wymagany'),
            'email.email' => __('Adres e-mail musi być poprawnym adresem'),
            'first_name.required' => __('Imię jest wymagane'),
            'first_name.min' => __('Imię musi mieć przynajmniej 2 znaki'),
            'last_name.required' => __('Nazwisko jest wymagane'),
            'last_name.min' => __('Nazwisko musi mieć przynajmniej 2 znaki'),
            'password.required' => __('Hasło jest wymagane'),
            'password.min' => __('Hasło musi mieć przynajmniej 8 znaków'),
            'password.confirmed' => __('Hasło musi być potwierdzone')
        ];
    }
}
