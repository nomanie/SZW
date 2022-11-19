<?php

namespace App\Http\Requests\Auth;

use App\Rules\FreeLoginForWorker;
use Illuminate\Foundation\Http\FormRequest;

class RegisterWorkerRequest extends FormRequest
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
            'first_name' => 'required|min:2|string',
            'last_name' => 'required|min:2|string',
            'login' => ['required', new FreeLoginForWorker($this->workshop_id)],
            'password' => 'required|min:8|confirmed',
            'position' => 'sometimes|nullable',
            'contract_from' => 'sometimes|nullable',
            'contract_to' => 'sometimes|nullable',
            'contract_type' => 'sometimes|nullable',
            'salary' => 'sometimes|nullable',
            'info' => 'sometimes|nullable',
            'is_active' => 'sometimes|nullable',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => __('Imię jest wymagane'),
            'first_name.min' => __('Imię musi mieć przynajmniej 2 znaki'),
            'last_name.required' => __('Nazwisko jest wymagane'),
            'last_name.min' => __('Nazwisko musi mieć przynajmniej 2 znaki'),
            'login.required' => __('Login jest wymagany'),
            'password.required' => __('Hasło jest wymagane'),
            'password.min' => __('Hasło musi mieć przynajmniej 8 znaków'),
            'password.confirmed' => __('Hasło musi być potwierdzone'),
        ];
    }
}
