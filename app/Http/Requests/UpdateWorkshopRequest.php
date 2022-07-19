<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {

        return [
            'title' => 'required|string|max:100',
            'additional_title' => 'string|max:100',
            'detail' => 'nullable|max:800',
            'topic_coreQuestions' => 'array',
            'location' => 'nullable|max:25',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'trainer' => 'nullable',
            'status' => 'nullable',
            'targets' => 'string',
            'misc' => 'string',
            'misc_link' => 'string',
            'price' => 'numeric',
            'process_flow' => 'string',


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
            'title.required' => 'Der Titel ist ein Pflichtfeld.',
            'start_date.required' => 'Start Datum ist ein Pflichtfeld.',
            'max' => 'Mehr als :max zulässige Zeichen im Feld :attribute verwendet.',
            'after_or_equal' => 'Das Ende muss ein Datum nach dem Start Datum sein oder bei 1 Tages Seminar Feld leer lassen.',
            'location.required'  => 'Dieses Feld darf nicht leer sein..',
            'date' => ''

        ];
    }
}
