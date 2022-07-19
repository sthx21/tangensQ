<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshopRequest extends FormRequest
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
         $NULLABLE_MAX_25 = 'nullable|max:25';
        return [
            'title' => 'required|string|max:100',
            'additional_title' => 'string|max:100',
            'targets' => 'string',
            'misc' => 'string',
            'misc_link' => 'string',
            'price' => 'numeric',
            'topic_coreQuestions' => 'array',
            'process_flow' => 'string',
            'detail' => 'nullable|max:800',
            'start_date_part_two' => 'string',
            'end_date_part_two' => 'string',
            'series_two'       => 'string',
            'series_three'       => 'int',
            'series_four'       => 'int',
            'locationOne' => $NULLABLE_MAX_25,
            'locationTwo' => $NULLABLE_MAX_25,
            'locationThree' => $NULLABLE_MAX_25,
            'locationFour' => $NULLABLE_MAX_25,
//            'start_dateOne' => 'required|date|after_or_equal:today',
            'end_dateOne' => 'nullable|date|after:start_dateOne',
            'start_dateTwo' => 'nullable|date|after_or_equal:today',
            'end_dateTwo' => 'nullable|date|after:start_dateTwo',
            'start_dateThree' => 'nullable|date|after_or_equal:today',
            'end_dateThree' => 'nullable|date|after:start_dateThree',
            'start_dateFour' => 'nullable|date|after_or_equal:today',
            'end_dateFour' => 'nullable|date|after:start_dateFour',
            'cancel_days_one' => 'string',
            'cancel_days_two' => 'string',
            'cancel_days_three' => 'string',
            'cancel_days_four' => 'string',
            'trainer_one' => '',
            'trainer_two' => '',
            'trainer_three' => '',
            'trainer_four' => '',
            'trainer_five' => '',
            'trainer_six' => '',
            'trainer_seven' => '',
            'trainer_eight' => '',


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
            'title.required' => 'Der Titel ist ein Pflichtfeld.',
            'start_date.required' => 'Start Datum ist ein Pflichtfeld.',
            'max' => 'Mehr als :max zulässige Zeichen im Feld :attribute verwendet.',
            'after' => 'Das Ende muss ein Datum nach dem Start Datum sein oder bei 1 Tages Seminar Feld leer lassen.',
            'after_or_equal' => 'Das Start Datum darf nicht in der Vergangenheit liegen.',

        ];
    }
}
