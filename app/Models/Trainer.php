<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Trainer extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use InteractsWithMedia;
    ///////////////////////////////////////////////

    ////
    //Functions / Methods
    ////

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'second_email',
        'phone',
        'second_phone',
        'zip',
        'street',
        'city',
        'house_number',
        'fax_number',
        'info',
        'title',
        'company_id',
        'company_name',
        'state',
        'country',
        'homepage',
        'user_id',
        'coaching_fee_per_hour',
        'training_fee_per_day',
        'consulting_fee_per_day'

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
     * Get Trainer Full Name
     *
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    /**
     * Get Trainer Full Name With Title
     *
     *
     * @return string
     */
    public function getTitleFullNameAttribute(): string
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }
    /**
     * Convert Uploaded Image
     *
     *
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10)
            ->keepOriginalImageFormat();
    }
    ////
    //Relationships
    ////

    public function workshops()
    {
       return $this->belongsToMany(Workshop::Class)->with('clients')->withPivot('canceled');
    }
    public function company()
    {
        return $this->belongsTo(Company::Class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot(['status', 'canceled']);
    }
}
