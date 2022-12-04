<?php

namespace App\Http\Requests\Auth;

use App\Rules\FreeLoginForWorker;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:identities,email',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => __('Podaj adres e-mail'),
            'email.exists' => __('Taki adres e-mail nie istnieje w Naszej bazie'),
            'password.required' => __('Podaj hasło'),
        ];
    }
}
