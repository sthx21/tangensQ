<?php

namespace App\Models;

use Database\Factories\WorkshopFactory;
use DateTimeInterface;
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
use Kyslik\ColumnSortable\Sortable;
use PhpMyAdmin\Controllers\ChangeLogController;


class Workshop extends Model

{
    use Notifiable;
    use Sluggable;
    use SoftDeletes;
    use HasFactory;
    use Sortable;

    public $sortable = [
        'title',
        'start_date',
        'status',
        'cancellation_date',
        'location'
    ];

    ////
    // Default $attributes Value for instantiation (for __construct) only if Model::make/create is used
    // Not applicable with new Model;
    ////
    protected $attributes = [];
//    protected $appends = ['reserved_clients_count'];
    ////
    // Setting the types for the $attributes
    ////
    protected $casts = [
        //$this->phone => 'int',
        'topic_coreQuestions' => 'array',
        'series' => 'array',
//        'start_date' => 'date:d.m.y',
//        'end_date' => 'date:d.m.y',
//        'cancellation_date' => 'date:d.m.y',

    ];
    protected $with = ['clients'];

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

        'title',
        'detail',
        'location',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'price',
        'targets',
        'misc',
        'user_id',
        'series',
        'misc_link',
        'process_flow',
        'additional_title',
        'topic_coreQuestions',
        'webex_id',
        'webex_link',
        'webex_chatroom',
        'webex_invite_date',
        'cancellation_date',
        'region',
        'status'


    ];
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d.m.Y');
    }
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
                'source' => ['title', 'location','start_date']
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
     * @return Workshop
     */
    public function setStatus($workshop): Workshop
    {
        // TODO If $workshop->status != null Set Status
        $today = Carbon::today();
        $seen = 'In' . ' ' . $workshop->start_date->diffInDays($today) . ' ' . 'DAY(S)';



        if ($today->isBetween($workshop->start_date, $workshop->end_date) && $workshop->end_date->greaterThanOrEqualTo($workshop->start_date)) {
            $workshop->status = [
                'colour' => '#0f4bac',
                'seen' => 'ACTIVE',

            ];
        }
        if ($workshop->start_date->eq($today) && $workshop->end_date->eq($today)) {
            $workshop->status = [
                'colour' => '#0f4bac',
                'seen' => 'ACTIVE',

            ];
        }
        if ($workshop->start_date->gt($today)) {
            $workshop->status = [
                'colour' => '#9f191f',
                'seen' => $seen,
                'days' => $workshop->start_date->diffInDays($today),
            ];
        }
        elseif ($today->gt($workshop->end_date)) {
            $workshop->status = [
                'colour' => '#5ac45e',
                'seen' => 'ENDED',
            ];
        }
        $workshop = $workshop->setIndexDate($workshop);
        return $workshop;
    }
    /**
     * Set the Status on Index
     *
     * @param $workshop
     * @return Workshop
     */
    public function setIndexDate($workshop): Workshop
    {
        $today = Carbon::today();
        $ended = trans('workshops.index.ended').' '.$workshop->end_date->format('d.m.y');
        $onlyToday = trans('workshops.index.onlyToday');
        $until = trans('workshops.index.until').' '.$workshop->end_date->format('d.m.y');
        $upcoming = $workshop->start_date->format('d.m.y'). ' - ' . $workshop->end_date->format('d.m.y');
        if ($today->lt($workshop->start_date)) {
            $workshop->indexDate = [
                'colour' => '#9f191f',
                'dateValue' => $upcoming,
            ];
        }
        if ($workshop->start_date->eq($today) && $workshop->end_date->eq($today)) {
            $workshop->indexDate = [
                'colour' => '#0f4bac',
                'dateValue' => $onlyToday,
            ];
        }
        if ($today->greaterThanOrEqualTo($workshop->start_date) && $today->lessThanOrEqualTo($workshop->end_date) && $workshop->start_date != $workshop->end_date) {
            $workshop->indexDate = [
                'colour' => '#0f4bac',
                'dateValue' => $until,
            ];
        }
        if ($today->gt($workshop->end_date)) {
            $workshop->indexDate = [
                'colour' => '#5ac45e',
                'dateValue' => $ended,
            ];
        }
        return $workshop;
    }
    ////////////////////////////////////////////////////////
        ////
        //Relationships
        ////
    public function trainers(){

        return $this->belongsToMany(Trainer::Class, 'trainer_workshop')->withPivot('canceled');
    }
    public function clients(){

        return $this->belongsToMany(Client::class)->with('company')->withPivot('status');
    }

    public function staff(){

        return $this->belongsToMany(Staff::Class)->with('company')->withPivot('status');
    }

    public function locations(){

        return $this->belongsToMany(Location::Class, 'location_workshop');
    }
    public function companies(){

        return $this->belongsToMany(Company::Class);
    }
//    public function company()
//    {
//        return $this->belongsToMany('App\Models\Company', 'company_workshop', 'company_id', 'wworkshop_id');
//    }
}
