<?php

namespace App\Http\Requests\Auth;

use App\Rules\FreeLoginForWorker;
use Illuminate\Foundation\Http\FormRequest;

class TwoFARequest extends FormRequest
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
            'code' => 'required|min:6|max:6',
            'email' => 'email|required'
        ];
    }
    public function messages()
    {
        return [
            'code.required' => __('Kod jest wymagany'),
            'code.min' => __('Kod musi mieć 6 znaków'),
            'code.max' => __('Kod musi mieć 6 znaków')
        ];
    }
}
