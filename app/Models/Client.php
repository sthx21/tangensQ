<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;




class Client extends Model
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
//    protected $with = ['company'];

    ////
    // Setting the types for the $attributes
    ////
    protected $casts = [
        //$this->phone => 'int',

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
        'origin',
        'company_id',
        'position',
        'title',
        'academic_title',
        'first_name',
        'last_name',
        'department',
        'street',
        'additional_address',
        'house_number',
        'zip',
        'city',
        'state',
        'country',
        'address_origin',
        'street_office',
        'house_number_office',
        'additional_address_office',
        'zip_office',
        'city_office',
        'state_office',
        'country_office',
        'email_office',
        'phone',
        'phone_office',
        'fax_number',
        'email',
        'second_email',
        'newsletter',
        'about',
        'revenue',
        'last_note',
        'sex',
        'responsible',
        'function',
        'active',
        'inactive_date',
        'homepage',
        'slug',
        'old_id'
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
                'source' => ['first_name', 'last_name']
            ]
        ];
    }
//    /**
//     * Get Client Full Name
//     *
//     *
//     * @return string
//     */
//    public function getFullNameAttribute(): string
//    {
//        return "{$this->first_name} {$this->last_name}";
//    }
//    /**
//     * Get Client Full Name With Title
//     *
//     *
//     * @return string
//     */
//    public function getTitleFullNameAttribute(): string
//    {
//        return "{$this->title} {$this->first_name} {$this->last_name}";
//    }
    ////
    //Relationships
    ////

    public function workshops()
    {
        return $this->belongsToMany(Workshop::Class);
    }

    public function company()
    {
        return $this->belongsTo(Company::Class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
