<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $trainer_id
 * @property int|null $client_id
 * @property int|null $staff_id
 * @property int|null $workshop_id
 * @property int|null $webex_id
 * @property int|null $inhouse_id
 * @property int|null $offer_id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Offer|null $offer
 * @property-read \App\Models\Staff|null $staff
 * @property-read \App\Models\Trainer|null $trainer
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Webex|null $webex
 * @property-read \App\Models\Workshop|null $workshop
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereInhouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereTrainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereWebexId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereWorkshopId($value)
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Attachment
 *
 * @property int $id
 * @property array|null $bodies
 * @property string|null $from
 * @property string|null $to
 * @property string|null $subject
 * @property int $user_id
 * @property int|null $offer_id
 * @property int|null $staff_id
 * @property int|null $client_id
 * @property int $read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Offer|null $offers
 * @property-read \App\Models\Staff|null $staff
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereBodies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attachment whereUserId($value)
 */
	class Attachment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CanceledWorkshop
 *
 * @property int $id
 * @property string $name
 * @property string $reason
 * @property int|null $trainer_id
 * @property int|null $client_id
 * @property int|null $user_id
 * @property int|null $staff_id
 * @property int|null $company_id
 * @property int|null $workshop_id
 * @property int|null $webex_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop query()
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereTrainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereWebexId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CanceledWorkshop whereWorkshopId($value)
 */
	class CanceledWorkshop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string|null $origin
 * @property string|null $lead_position
 * @property string|null $old_id
 * @property string|null $position
 * @property int $company_id
 * @property string|null $department
 * @property string|null $academic_title
 * @property string|null $title
 * @property string|null $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $second_email
 * @property string|null $phone
 * @property string|null $second_phone
 * @property string|null $fax_number
 * @property string|null $zip
 * @property string|null $house_number
 * @property string|null $street
 * @property string|null $additional_address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $office_zip
 * @property string|null $office_house_number
 * @property string|null $office_street
 * @property string|null $office_additional_address
 * @property string|null $office_city
 * @property string|null $office_state
 * @property string|null $office_country
 * @property string|null $address_origin
 * @property string|null $homepage
 * @property string|null $infon
 * @property string|null $info
 * @property string $slug
 * @property string|null $newsletter
 * @property int $active
 * @property string|null $inactive_date
 * @property string|null $last_note
 * @property string|null $function
 * @property string|null $responsible
 * @property string|null $revenue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Database\Factories\ClientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Client findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Query\Builder|Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAcademicTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddressOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereInactiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereInfon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLeadPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOfficeZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSecondEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Client withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Client withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Client withoutTrashed()
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property string|null $old_id
 * @property int|null $group_id
 * @property int $user_id
 * @property string $name
 * @property string|null $management
 * @property string|null $homepage
 * @property string|null $main_email
 * @property string|null $second_email
 * @property string|null $main_phone
 * @property string|null $second_phone
 * @property string|null $phone_office
 * @property string|null $fax_number
 * @property string|null $zip
 * @property string|null $house_number
 * @property string|null $street
 * @property string|null $additional_address
 * @property string|null $city
 * @property string|null $country
 * @property string|null $state
 * @property string|null $address_origin
 * @property string|null $billing_zip
 * @property string|null $billing_house_number
 * @property string|null $billing_street
 * @property string|null $billing_additional_address
 * @property string|null $payment_method
 * @property string|null $last_note
 * @property string|null $managed_by
 * @property string|null $info
 * @property string|null $about
 * @property string|null $newsletter
 * @property string|null $revenue
 * @property string $discount
 * @property string|null $discount_until
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $group
 * @property-read int|null $group_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read \App\Models\User|null $responseable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read int|null $staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Database\Factories\CompanyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Company findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Query\Builder|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddressOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereBillingAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereBillingHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereBillingStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDiscountUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereFaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLastNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereMainEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereMainPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereManagedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereManagement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereOldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhoneOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSecondEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Company withoutTrashed()
 */
	class Company extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string|null $location
 * @property string|null $company
 * @property string|null $offer_number
 * @property int $user_id
 * @property string|null $first_trainer_name
 * @property string|null $second_trainer_name
 * @property string $start
 * @property string|null $end
 * @property string|null $startTime
 * @property string|null $endTime
 * @property int $allDay
 * @property int $booked
 * @property string|null $groupId
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAllDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBooked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereFirstTrainerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereOfferNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSecondTrainerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FileUpload
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $trainer_id
 * @property int|null $client_id
 * @property int|null $staff_id
 * @property int|null $workshop_id
 * @property int|null $webex_id
 * @property int|null $inhouse_id
 * @property int|null $offer_id
 * @property int $user_id
 * @property string|null $file_name
 * @property string|null $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Offer|null $offer
 * @property-read \App\Models\Staff|null $staff
 * @property-read \App\Models\Trainer|null $trainer
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Webex|null $webex
 * @property-read \App\Models\Workshop|null $workshop
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereInhouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereTrainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereWebexId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileUpload whereWorkshopId($value)
 */
	class FileUpload extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Group
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $info
 * @property string $slug
 * @property int|null $discount
 * @property string|null $discount_until
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read string $cp_full_name
 * @property-read string $cp_title_full_name
 * @property-read string $hr_full_name
 * @property-read string $hr_title_full_name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read int|null $staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Group findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Query\Builder|Group onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDiscountUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Group withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Group withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Group withoutTrashed()
 */
	class Group extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property string $invoice_number
 * @property string|null $invoice_date
 * @property int|null $offer_id
 * @property string|null $due_date
 * @property int|null $quantity
 * @property string|null $description
 * @property string|null $unit_price
 * @property string|null $amount
 * @property string|null $total
 * @property string|null $free_text
 * @property string|null $payment_status
 * @property int|null $discount
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Webex[] $webexes
 * @property-read int|null $webexes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereFreeText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Invoice withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Invoice withoutTrashed()
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $name
 * @property string|null $street_address
 * @property string|null $house_number
 * @property string|null $zip
 * @property string|null $email
 * @property string|null $phone
 * @property string $contact_last_name
 * @property string|null $contact_first_name
 * @property string $contact_email
 * @property string|null $contact_info
 * @property string|null $contact_phone
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Illuminate\Database\Eloquent\Builder|Location findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Query\Builder|Location onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereContactFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereContactLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Location withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Location withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Location withoutTrashed()
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notes
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @method static \Illuminate\Database\Eloquent\Builder|Notes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notes whereUserId($value)
 */
	class Notes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string|null $title
 * @property string $offer_number
 * @property string|null $offer_date
 * @property string|null $valid_until
 * @property string|null $target_date
 * @property string|null $due_date
 * @property string|null $confirmation_date
 * @property string|null $completion_date
 * @property string|null $special_agreement
 * @property string|null $status
 * @property string|null $amount
 * @property string|null $about
 * @property int|null $user_id
 * @property string|null $type
 * @property string|null $discount
 * @property array|null $clientMembers
 * @property array|null $staffMembers
 * @property string|null $history
 * @property array|null $events
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $workshop_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Webex[] $webexes
 * @property-read int|null $webexes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Illuminate\Database\Eloquent\Builder|Offer findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Offer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereClientMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereConfirmationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereEvents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereOfferDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereOfferNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereSpecialAgreement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereStaffMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereValidUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereWorkshopId($value)
 * @method static \Illuminate\Database\Query\Builder|Offer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Offer withoutTrashed()
 */
	class Offer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reminder
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $trainer_id
 * @property int|null $client_id
 * @property int|null $staff_id
 * @property int|null $workshop_id
 * @property int|null $webex_id
 * @property int|null $inhouse_id
 * @property int|null $offer_id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $due_date
 * @property string|null $description
 * @property int $complete
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Offer|null $offer
 * @property-read \App\Models\Staff|null $staff
 * @property-read \App\Models\Trainer|null $trainer
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Webex|null $webex
 * @property-read \App\Models\Workshop|null $workshop
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereInhouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereTrainerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereWebexId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereWorkshopId($value)
 */
	class Reminder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Revenue
 *
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Webex[] $webexes
 * @property-read int|null $webexes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue newQuery()
 * @method static \Illuminate\Database\Query\Builder|Revenue onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue query()
 * @method static \Illuminate\Database\Query\Builder|Revenue withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Revenue withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Revenue withoutTrashed()
 */
	class Revenue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Staff
 *
 * @property int $id
 * @property string|null $lead_position
 * @property string|null $old_id
 * @property string|null $position
 * @property int $company_id
 * @property string|null $department
 * @property string|null $academic_title
 * @property string|null $title
 * @property string|null $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $second_email
 * @property string|null $phone
 * @property string|null $second_phone
 * @property string|null $fax_number
 * @property string|null $zip
 * @property string|null $house_number
 * @property string|null $street
 * @property string|null $additional_address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $office_zip
 * @property string|null $office_house_number
 * @property string|null $office_street
 * @property string|null $office_additional_address
 * @property string|null $office_city
 * @property string|null $office_state
 * @property string|null $office_country
 * @property string|null $address_origin
 * @property string|null $homepage
 * @property string|null $infon
 * @property string|null $info
 * @property string $slug
 * @property int|null $newsletter
 * @property int|null $active
 * @property string|null $inactive_date
 * @property string|null $last_note
 * @property string|null $function
 * @property string|null $responsible
 * @property string|null $revenue
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \App\Models\Company|null $company
 * @property-read string $full_name
 * @property-read string $title_full_name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Illuminate\Database\Eloquent\Builder|Staff findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newQuery()
 * @method static \Illuminate\Database\Query\Builder|Staff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereAcademicTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereAddressOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereFaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereInactiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereInfon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereLastNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereLeadPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOfficeZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereOldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereSecondEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Staff withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Staff withoutTrashed()
 */
	class Staff extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $old_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read int|null $staff_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereOldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Trainer
 *
 * @property int $id
 * @property string $title
 * @property int $company_id
 * @property string|null $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $second_email
 * @property string|null $phone
 * @property string|null $second_phone
 * @property string|null $fax_number
 * @property string|null $zip
 * @property string|null $house_number
 * @property string|null $street
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $company_name
 * @property string|null $additional_address
 * @property string|null $homepage
 * @property string|null $info
 * @property string $slug
 * @property int $active
 * @property string|null $inactive_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $consulting_fee_per_day
 * @property string|null $training_fee_per_day
 * @property string|null $coaching_fee_per_hour
 * @property int $user_id
 * @property-read \App\Models\Company|null $company
 * @property-read string $full_name
 * @property-read string $title_full_name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workshop[] $workshops
 * @property-read int|null $workshops_count
 * @method static \Database\Factories\TrainerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Trainer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereAdditionalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCoachingFeePerHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereConsultingFeePerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereFaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereInactiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereSecondEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereTrainingFeePerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Trainer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trainer withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Trainer withoutTrashed()
 */
	class Trainer extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $profile_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $verification_token
 * @property string|null $verified
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $attachment_identifier_email
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAttachmentIdentifierEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Webex
 *
 * @property int $id
 * @property string $title
 * @property string|null $additional_title
 * @property string|null $detail
 * @property string|null $targets
 * @property string|null $misc
 * @property string|null $misc_link
 * @property string|null $price
 * @property array|null $topic_coreQuestions
 * @property string|null $process_flow
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int|null $series_two
 * @property int|null $series_three
 * @property int|null $chatroom
 * @property string|null $cancellation_date
 * @property string|null $invite_date
 * @property string $slug
 * @property string|null $webex_id
 * @property string|null $meetingNumber
 * @property string|null $agenda
 * @property string|null $password
 * @property string|null $phoneAndVideoSystemPassword
 * @property string|null $meetingType
 * @property string|null $state
 * @property string|null $timezone
 * @property string|null $start
 * @property string|null $end
 * @property string|null $hostUserId
 * @property string|null $hostDisplayName
 * @property string|null $hostEmail
 * @property string|null $hostKey
 * @property string|null $siteUrl
 * @property string|null $sipAddress
 * @property string|null $dialInIpAddress
 * @property string|null $enabledAutoRecordMeeting
 * @property string|null $allowAuthenticatedDevices
 * @property string|null $enabledJoinBeforeHost
 * @property string|null $joinBeforeHostMinutes
 * @property string|null $enableConnectAudioBeforeHost
 * @property string|null $excludePassword
 * @property string|null $publicMeeting
 * @property string|null $enableAutomaticLock
 * @property string|null $webLink
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trainer[] $trainers
 * @property-read int|null $trainers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Webex findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Webex newQuery()
 * @method static \Illuminate\Database\Query\Builder|Webex onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Webex query()
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereAdditionalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereAgenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereAllowAuthenticatedDevices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereCancellationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereChatroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereDialInIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEnableAutomaticLock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEnableConnectAudioBeforeHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEnabledAutoRecordMeeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEnabledJoinBeforeHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereExcludePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereHostDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereHostEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereHostKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereHostUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereInviteDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereJoinBeforeHostMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereMeetingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereMeetingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereMisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereMiscLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex wherePhoneAndVideoSystemPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereProcessFlow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex wherePublicMeeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereSeriesThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereSeriesTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereSipAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereSiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereTargets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereTopicCoreQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereWebLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Webex whereWebexId($value)
 * @method static \Illuminate\Database\Query\Builder|Webex withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Webex withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Webex withoutTrashed()
 */
	class Webex extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Workshop
 *
 * @property int $id
 * @property string $title
 * @property string|null $additional_title
 * @property string|null $detail
 * @property string|null $targets
 * @property string|null $misc
 * @property string|null $misc_link
 * @property string|null $location
 * @property string|null $region
 * @property string|null $price
 * @property array|null $topic_coreQuestions
 * @property string|null $process_flow
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $status
 * @property int $user_id
 * @property array|null $series
 * @property string|null $cancellation_date
 * @property string|null $invite_date
 * @property string $slug
 * @property int $canceled
 * @property string|null $canceled_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Location[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Staff[] $staff
 * @property-read int|null $staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trainer[] $trainers
 * @property-read int|null $trainers_count
 * @method static \Database\Factories\WorkshopFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop newQuery()
 * @method static \Illuminate\Database\Query\Builder|Workshop onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop sortable($defaultParameters = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereAdditionalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereCanceledBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereCancellationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereInviteDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereMisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereMiscLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereProcessFlow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereTargets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereTopicCoreQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Workshop withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Workshop withoutTrashed()
 */
	class Workshop extends \Eloquent {}
}

