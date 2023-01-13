<?php

namespace App\Http\Requests\Workshop;

use App\Rules\NipRule;
use App\Rules\RegonRule;
use App\Rules\ZipCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkshopRequest extends FormRequest
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
        switch ($this->section) {
            case 'info':
                $rules = [
                    'name' => 'required',
                    'nip' => ['required', new NipRule()],
                    'regon' => ['required', new RegonRule()],
                    'company_created_at' => 'sometimes|nullable|date',
                    'owners' => 'sometimes|nullable',
                    'owners.*.first_name' => [Rule::requiredIf(count($this->owners) > 0), 'string', 'min:2'],
                    'owners.*.last_name' => [Rule::requiredIf(count($this->owners) > 0), 'string', 'min:2'],
                ];
                break;
            case 'contact':
                $rules = [
                    'phone' => 'min:9|sometimes|nullable',
                    'email' => 'email|sometimes|nullable',
                    'website' => 'sometimes|nullable',
                    'social_media' => 'sometimes|nullable',
                ];
                break;
            case 'places':
                $rules = [
                    'places' => 'array|sometimes|nullable',
                    'places.*.city' => 'required',
                    'places.*.phone' => 'required|min:9',
                    'places.*.street' => 'required',
                    'places.*.zip_code' => ['required', new ZipCodeRule()],
                    'places.*.building_number' => 'required',
                    'places.*.flat_number' => 'sometimes|nullable',
                ];
                break;
            case 'contact_form':
                $rules = [
                    'view' => 'required|in:0,1,2,3',
                    'fields' => 'sometimes|nullable',
                    'fields.*.max' => 'sometimes|nullable',
                    'fields.*.min' => 'sometimes|nullable',
                    'fields.*.name' => 'required',
                    'fields.*.type' => 'required|in:0,1,2,3,4,5',
                    'fields.*.required' => 'sometimes|nullable',
                ];
                break;
            case 'additional_fields':
                $rules['fields'] = 'sometimes|nullable';
                foreach ($this->fields as $index => $value) {
                    $rules['fields.' . $index . '.name'] = Rule::requiredIf($this->fields[$index]['type'] !== null && $this->fields[$index]['value'] !== null);
                    $rules['fields.' . $index . '.type'] = ['in:0,1,2,3', Rule::requiredIf($this->fields[$index]['name'] !== null && $this->fields[$index]['value'] !== null)];
                    $rules['fields.' . $index . '.value'] = Rule::requiredIf($this->fields[$index]['name'] !== null && $this->fields[$index]['type'] !== null);
                }
            //@todo dodać validacje map po dodaniu modułu
        }
        $rules['section'] = 'in:info,contact,places,contact_form,additional_fields,map';
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('Nazwa jest wymagana'),
            'nip.required' => __('NIP jest wymagany'),
            'regon.required' => __('REGON jest wymagany'),
            'company_created_at.date' => __('Data utworzenia firmy musi być datą'),
            //
            'owners.*.first_name.required' => __('Imię właściciela jest wymagane'),
            'owners.*.last_name.required' => __('Nazwisko właściciela jest wymagane'),
            //
            'phone.min' => __('Numer telefonu musi mieć przynajmniej :min znaków'),
            'email.email' => __('Adres e-mail jest nieprawidłowy'),
            //
            'places.*.city.required' => __('Miasto jest wymagane'),
            'places.*.phone.required' => __('Numer telefonu jest wymagany'),
            'places.*.phone.min' => __('Numer telefonu musi mieć przynajmniej :min znaków'),
            'places.*.street.required' => __('Ulica jest wymagana'),
            'places.*.zip_code.required' => __('Kod pocztowy jest wymagany'),
            'places.*.building_number.required' =>__('Numer budynku jest wymagany'),
            //
            'view.required' => __('Wygląd formularza jest wymagany'),
            'view.in' => __('Wybrany wygląd formularza jest błędny'),
            'fields.*.name.required' => __('Nazwa pola jest wymagana'),
            'fields.*.type.required' => __('Typ pola jest wymagany'),
            'fields.*.type.in' => __('Wybrany typ pola jest błędny'),
            'fields.*.value.required' => __('Wartość pola jest wymagana'),
        ];
    }
}
