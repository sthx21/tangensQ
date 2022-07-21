<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


class Offer extends Model
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    ////
    // Default $attributes Value for instantiation (for __construct)
    ////
    protected $attributes = [


    ];

    ////
    // Setting the types for the $attributes
    ////
    protected $casts = [
        //$this->phone => 'int',
        'positions' => 'array',
        'clientMembers' => 'array',
        'events'=> 'array',
        'staffMembers'=> 'array',
        'history'   => 'array'
    ];

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
    //Mass assignable - has to be set if using Model::create, else not able to store
    ////
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'offer_number',
        'offer_date',
        'invoice_id',
        'valid_until',
        'due_date',
        'target_date',
        'confirmation_date',
        'completion_date',
        'amount',
        'about',
        'discount',
        'positions',
        'status',
        'type',
        'user_id',
        'clientMembers',
        'staffMembers',
        'events',
        'special_agreement',
        'history'

    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    ///////////////////////////////////////////////

    ////
    //Functions / Methods
    ////


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
    //Make the Model sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['offer_number']
            ]
        ];
    }
    public function companies()
    {
        return $this->belongsToMany(Company::Class)->with('clients');
    }
    public function workshops()
    {
        return $this->belongsToMany(Workshop::Class);
    }
    public function webexes()
    {
        return $this->belongsToMany(Webex::Class);
    }

    public function attachments()
    {
        return $this->belongsToMany(Attachment::Class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function clients()
    {
        return $this->belongsToMany(Client::Class);
    }
}
