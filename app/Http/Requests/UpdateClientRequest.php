<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
        $client = Client::where('email', $this->email)->first() ?? '';
        return [
            'workshop_id' => '',
            'company_id' => 'string',
            'first_name' => 'max:30',
            'last_name' => 'required|max:20',
            'phone' => 'max:25',
            'info' =>       'max:200',
            'email' => 'email',
            'title' => 'string',
            'origin' => '',
            'tags'  => '',
            'tag'   =>''
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
            'last_name.required' => 'Der Nachname ist ein Pflichtfeld.',
            'origin.required' => 'Dieses Feld darf nicht leer sein...',

            'email.required' => 'Die Email ist ein Pflichtfeld. Wenn noch unbekannt, Platzhalter verwenden und später nachtragen.',
            'email.unique' => 'Diese Email Adresse ist schon bei einem anderen Kunden hinterlegt.',
            'max' => 'Mehr als :max zulässige Zeichen im Feld :attribute verwendet.'

        ];
    }
}
