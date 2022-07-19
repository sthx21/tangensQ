<?php

namespace App\Models;

use Database\Factories\WorkshopFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;



class Webex extends Model

{
    use Notifiable;
    use Sluggable;
    use SoftDeletes;
    use HasFactory;

    ////
    // Default $attributes Value for instantiation (for __construct) only if Model::make/create is used
    // Not applicable with new Model;
    ////
    protected $attributes = [];

    ////
    // Setting the types for the $attributes
    ////
    protected $casts = [
//$this->phone => 'int',
        'topic_coreQuestions' => 'array',
        'attrib' => 'array',    ];
    ////
    // Property Instantiation for Use in Controller
    ////


    ////
    // Every new Workshop needs an array of $attributes to be constructed
    // Returns Model(Collection) with given $attributes
    ////
public function __construct(array $attributes = [])
{
    parent::__construct($attributes);
    //Take Value from $attributes and attach to the new Model
    //$this->title = $attributes->title
}

    ////
    //Mass assignable - has to be set if storing in database
    ////
    protected $fillable = [

        'webex_id',
        'meetingNumber',
        'title',
        'agenda',
        'password',
        'additional_title',
        'start_date',
        'targets',
        'misc',
        'misc_link',
        'price',
        'topic_coreQuestions',
        'process_flow',
        'detail',
        'chatroom',
        'phoneAndVideoSystemPassword',
        'meetingType',
        'state',
        'timezone',
        'start',
        'end',
        'hostUserId',
        'hostDisplayName',
        'hostEmail',
        'hostKey',
        'siteUrl',
        'webLink',
        'sipAddress',
        'dialInIpAddress',
        'enabledAutoRecordMeeting',
        'allowAuthenticatedDevices',
        'enabledJoinBeforeHost',
        'joinBeforeHostMinutes',
        'enableConnectAudioBeforeHost',
        'excludePassword',
        'publicMeeting',
        'enableAutomaticLock',
        'webex_invite_date',
        'cancellation_date'

    ];
    ///////////////////////////////////////////////
    /////Make the Model sluggable
    /**
     * Get the route key for the model. Needed to make the Model sluggable / ID to slug redirect
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * Return the sluggable configuration array for this model.
     * Source = Wich Input for slugging
     *
     * @return array
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'start_date']
            ]
        ];
    }
    ///////////////////////////////////////////////
    ///////////////////////////////////////////////

    ////
    //Functions / Methods
    ////
    ///
    /**
     * Set the Status on Index
     *
     * @param $workshop
     * @return Webex
     */
    public function setStatus($workshop): Webex
    {
        $today = Carbon::today();
        $start = Carbon::create($workshop->start_date);
        $end = Carbon::create($workshop->end_date);

        if ($today->isBetween($start, $end) && $end->greaterThanOrEqualTo($start)) {
            $workshop->status = 'ACTIVE';
        }
        if ($start->eq($today) && $end->eq($today)) {
            $workshop->status = 'ACTIVE';
        }
        if ($start->gt($today)) {
            $workshop->status = 'In' . ' ' . $start->diffInDays($today) . ' ' . 'DAY(S)';
        }

        elseif ($today->gt($end)) {
            $workshop->status = 'ENDED';
        }

        return $workshop;
    }







    ////////////////////////////////////////////////////////
        ////
        //Relationships
        ////
    public function trainers(){

        return $this->belongsToMany(Trainer::Class, 'trainer_webex');
    }
    public function clients(){

        return $this->belongsToMany(Client::Class, 'client_webex')->with('company');
    }


    public function company()
    {
        return $this->belongsTo(Company::Class);
    }
}
