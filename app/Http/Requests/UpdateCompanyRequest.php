<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        return [
            'name'                                  => 'required|max:50',
            'main_email'                            => 'nullable',
            'main_phone'                            => 'nullable',
            'street'                                => '',
            'house_number'                          => '',
            'zip'                                   => '',
            'city'                                  =>'',
            'additional_address'                    => '',
            'info'                                  => 'nullable',
            'homepage'                              => 'nullable',
            'hr_title'                              => 'max:10',
            'hr_first_name'                         => 'nullable',
            'hr_last_name'                          => 'max:25',
            'hr_email'                              => 'email|max:100',
            'hr_phone'                              => 'nullable',
            'hr_info'                               => 'nullable',
            'cp_title'                              => 'max:10',
            'cp_first_name'                         => 'nullable',
            'cp_last_name'                          => 'max:25',
            'cp_email'                              => 'email|max:100',
            'cp_phone'                              => 'nullable',
            'cp_info'                               => 'nullable',
            'payment_method'                               => 'nullable'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Der Name des Unternehmens ist ein Pflichtfeld.',
            'hr_last_name.required' => 'Der Name des Personalers ist ein Pflichtfeld. Wenn noch unbekannt, Platzhalter verwenden und später nachtragen.',
            'hr_email.required' => 'Die Email des Personalers ist ein Pflichtfeld. Wenn noch unbekannt, Platzhalter verwenden und später nachtragen.',
            'max' => 'Mehr als :max zulässige Zeichen im Feld :attribute verwendet.',
        ];
    }
}
