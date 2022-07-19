<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\MediaLibrary\HasMedia;


class Staff extends Model implements HasMedia
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use InteractsWithMedia;

    ////
    // Default $attributes Value for instantiation (for __construct)
    ////
    protected $attributes = [


    ];

    ////
    // Setting the types for the $attributes
    ////
    protected $casts = [

    ];

    protected $appends = ['full_name'];
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
        'position',
        'company_id',
        'title',
        'academic_title',
        'first_name',
        'last_name',
        'department',
        'lead_position',
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

    /**
     * Get Client Full Name
     *
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get Client Full Name With Title
     *
     *
     * @return string
     */
    public function getTitleFullNameAttribute(): string
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }
    ////
    //Relationships
    ////

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::Class)->withDefault([
            'name' => 'GELÖSCHT',
        ]);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('tag_id');
    }

    public function workshops()
    {
        return $this->belongsToMany(Workshop::Class)->with('clients')->withPivot('status');
    }
}
