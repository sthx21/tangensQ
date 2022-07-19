<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebexRequest extends FormRequest
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
            // Input via WebSite
            'title'                             => 'required|string|max:100',
            'additional_title'                  => 'string|max:100',
            'targets'                           => 'string',
            'misc'                              => 'string',
            'misc_link'                         => 'string',
            'price'                             => 'numeric',
            'topic_coreQuestions'               => 'array',
            'process_flow'                      => 'string',
            'detail'                            => 'nullable|max:800',
            'start_date'                        => 'string',
            'start_date_part_two'               => 'string',
            'end_date_part_two'                 => 'string',
            'series_two'                        => 'int',
            'series_three'                      => 'int',
            'series_four'                       => 'int',
            'trainer'                       => 'string',
            'trainer_two'                       => 'nullable|string',
            //Input via Api
            'webex_id'                          => 'string',
            'meetingNumber'                     => 'string',
            'webex_title'                       => 'string',
            'agenda'                            => 'string',
            'password'                          => 'string',
            'phoneAndVideoSystemPassword'       => 'string',
            'meetingType'                       => 'string',
            'state'                             => 'string',
            'timezone'                          => 'string',
            'start_time'                             => 'string',
            'end_time'                               => 'string',
            'hostUserId'                        => 'string',
            'hostDisplayName'                   => 'string',
            'hostEmail'                         => 'string',
            'hostKey'                           => 'string',
            'siteUrl'                           => 'string',
            'webLink'                           => 'string',
            'sipAddress'                        => 'string',
            'dialInIpAddress'                   => 'string',
            'enabledAutoRecordMeeting'          => 'string',
            'allowAuthenticatedDevices'         => 'string',
            'enabledJoinBeforeHost'             => 'string',
            'joinBeforeHostMinutes'             => 'int',
            'enableConnectAudioBeforeHost'      => 'string',
            'excludePassword'                   => 'string',
            'publicMeeting'                     => 'string',
            'enableAutomaticLock'               => 'string',
            'allowAnyUserToBeCoHost'               => 'string',
            'sendEmail'               => 'string',
            'allowFirstUserToBeCoHost'               => 'string',
            'hostEmail'                         => 'string',
            'chatroom'                          => ''





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
