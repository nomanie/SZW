<?php

namespace App\Http\Requests\Workshop\Documents;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequest extends FormRequest
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
            'fv_header' => 'sometimes|nullable',
            'issue_date' => 'required',
            'sold_date' => 'required',
            'issuer_name' => 'required',
            'issuer_address' => 'required',
            'issuer_nip' => 'required',
            'recipient_name' => 'required',
            'recipient_address' => 'required',
            'recipient_nip' => 'sometimes|nullable',
            'sum_vat' => 'required',
            'sum_net' => 'required',
            'sum_gross' => 'required',
            'payment_date' => 'required',
            'bank_type' => 'sometimes|nullable',
            'account_number' => 'required',
            'notes' => 'sometimes|nullable',
            'payment_type' => 'required',
            'contents' => 'required|array',
            'contents.*.units' => 'required',
            'contents.*.unit_net' => 'required',
            'contents.*.vat_rate_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'issue_date.required' => __('Data wystawienia jest wymagana'),
            'sold_date.required' => __('Data sprzedaży jest wymagana'),
            'issuer_name.required' => __('Nazwa sprzedawcy jest wymagana'),
            'issuer_address.required' => __('Adres sprzedawcy jest wymagany'),
            'issuer_nip.required' => __('NIP sprzedawcy jest wymagany'),
            'recipient_name.required' => __('Nazwa odbiorcy jest wymagana'),
            'recipient_address.required' => __('Adres odbiorcy jest wymagany'),
            'payment_date.required' => __('Data płatności jest wymagana'),
            'account_number.required' => __('Numer konta jest wymagany'),
            'payment_type.required' => __('Typ płatności jest wymagany'),
            'contents.*.units.required' => __('Ilość jest wymagana'),
            'contents.*.unit_net.required' => __('Wartość jest wymagana'),
            'contents.*.vat_rate_id.required' => __('Stawka VAT jest wymagana'),
        ];
    }
}
