<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;
use App\Models\Tag;


class Group extends Model implements HasMedia
{
    use Notifiable;
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    use InteractsWithMedia;
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
                'source' => ['name']
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'info',
        'discount',
        'discount_until'
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
    /**
     * Get Hr Full Name
     *
     *
     * @return string
     */
    public function getHrFullNameAttribute(): string
    {
        return "{$this->hr_first_name} {$this->hr_last_name}";
    }
    /**
     * Get Hr Full Name With Title
     *
     *
     * @return string
     */
    public function getHrTitleFullNameAttribute(): string
    {
        return "{$this->hr_title} {$this->hr_first_name} {$this->hr_last_name}";
    }
    /**
     * Get ContactPerson Full Name
     *
     *
     * @return string
     */
    public function getCpFullNameAttribute(): string
    {
        return "{$this->cp_first_name} {$this->cp_last_name}";
    }
    /**
     * Get ContactPerson Full Name With Title
     *
     *
     * @return string
     */
    public function getCpTitleFullNameAttribute(): string
    {
        return "{$this->cp_title} {$this->cp_first_name} {$this->cp_last_name}";
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
    //Relations
    ////

    public function clients()
    {
        return $this->hasMany(Client::Class)->with('workshops');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
