<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'workshop_id' => '',
            'company_id' => 'required',
            'first_name' => 'max:30',
            'last_name' => 'required|max:20',
            'email' => 'required|unique:clients|email',
            'phone' => 'max:25',
            'info' => 'max:200',
            'origin' => '',
            'tag' => '',
            'tags' => '',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'last_name.required' => 'Der Nachname ist ein Pflichtfeld.',
            'origin.required' => 'Die Akquise ist ein Pflichtfeld.',
            'email.required' => 'Die Email ist ein Pflichtfeld. Wenn noch unbekannt, Platzhalter verwenden und später nachtragen.',
            'company_id.required' => 'Der Arbeitgeber ist ein Pflichtfeld.',
            'title.required' => 'Die Anrede kann nicht leer bleiben',
            'email.unique' => 'Diese Email Adresse ist schon bei einem anderen Kunden hinterlegt.',
            'max' => 'Mehr als :max zulässige Zeichen im Feld :attribute verwendet.'

        ];
    }
}
