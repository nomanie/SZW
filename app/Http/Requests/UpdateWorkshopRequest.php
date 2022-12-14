<?php

namespace App\Http\Requests;

use App\Rules\NipRule;
use App\Rules\RegonRule;
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
                    'name' => 'string|required',
                    'nip' => ['string', 'required', new NipRule()],
                    'regon' => ['string', 'required', new RegonRule()],
                    'company_created_at' => 'sometimes|nullable|date',
                    'owners' => 'array|sometimes|nullable',
                    'owners.*.first_name' => [Rule::requiredIf(count($this->owners) > 0), 'string', 'min:2'],
                    'owners.*.last_name' => [Rule::requiredIf(count($this->owners) > 0), 'string', 'min:2'],
                ];
                break;
            case 'contact':
                $rules = [
                    'phone' => 'string|min:9|sometimes|nullable',
                    'email' => 'email|sometimes|nullable',
                    'website' => 'string|sometimes|nullable',
                    'social_media' => 'array|sometimes|nullable',
                ];
                break;
            case 'places':
                $rules = [
                    'places' => 'array|sometimes|nullable',
                    'places.*.city' => 'string|required',
                    'places.*.phone' => 'string|required|min:9',
                    'places.*.street' => 'string|required',
                    'places.*.zip_code' => 'string|regex:/^[0-9]{2}-[0-9]{3}/|required',
                    'places.*.building_number' => 'string|required',
                    'places.*.flat_number' => 'string|sometimes|nullable',
                ];
                break;
            case 'contact_form':
                $rules = [
                    'view' => 'numeric|in:0,1,2,3',
                    'fields' => 'array|sometimes|nullable',
                    'fields.*.max' => 'sometimes|nullable|numeric',
                    'fields.*.min' => 'sometimes|nullable|numeric',
                    'fields.*.name' => 'required|string',
                    'fields.*.type' => 'required|in:0,1,2,3,4,5',
                    'fields.*.required' => 'required|boolean',
                ];
                break;
            case 'additional_fields':
                $rules = [
                    'fields' => 'array|sometimes|nullable',
                    'fields.*.name' => 'required|string',
                    'fields.*.type' => 'required|in:0,1,2,3',
                    'fields.*.value' => 'required|string',
                ];
                //@todo dodać validacje map po dodaniu modułu
        }
        $rules['section'] = 'in:info,contact,places,contact_form,additional_fields,map';
        return $rules;
    }
}
