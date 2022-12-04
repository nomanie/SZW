<?php

namespace App\Http\Requests\Auth;

use App\Enums\AccountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterWorkshopRequest extends FormRequest
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
            'email' => ['required','email'],
            'name' => 'required|string|min:2',
            'password' => 'required|string|confirmed|min:8',
            'nip' => 'required',
            'regon' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('Adres e-mail jest wymagany'),
            'email.email' => __('Adres e-mail musi być poprawnym adresem'),
            'name.required' => __('Imię jest wymagane'),
            'name.min' => __('Imię musi mieć przynajmniej 2 znaki'),
            'password.required' => __('Hasło jest wymagane'),
            'password.min' => __('Hasło musi mieć przynajmniej 8 znaków'),
            'password.confirmed' => __('Hasło musi być potwierdzone'),
            'nip.required' => __('NIP jest wymagany'),
            'regon.required' => __('REGON jest wymagany'),
        ];
    }
}
