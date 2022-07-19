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


class Company extends Model implements HasMedia
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
    protected $with = ['workshops', 'offers'];
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
                'source' => ['name', 'old_id']
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'old_id',
        'name'     ,
        'street'   ,
        'zip'   ,
        'city'     ,
        'state'     ,
        'country'  ,
        'address_origin',
        'homepage' ,
        'main_email'  ,
        'newsletter'  ,
        'second_email'  ,
        'phone' ,
        'phone_office'   ,
        'second_phone'  ,
        'info',
        'revenue' ,
        'last_note'  ,
        'managed_by'   ,
        'slug'

    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
//    /**
//     * Get Hr Full Name
//     *
//     *
//     * @return string
//     */
//    public function getFullNameAttribute($id): string
//    {
//        $staff  = Staff::where('id', $id)->firstOrFail();
//        return "{$staff->first_name} {$staff->last_name}";
//    }


//    /**
//     * Convert Uploaded Image
//     *
//     *
//     */
//    public function registerMediaConversions(Media $media = null): void
//    {
//        $this->addMediaConversion('thumb')
//            ->width(100)
//            ->height(100)
//            ->sharpen(10)
//            ->keepOriginalImageFormat();
//    }
    ////
    //Relations
    ////

    public function clients()
    {
        return $this->hasMany(Client::Class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('tag_id');
    }
    public function workshops()
    {
        return $this->belongsToMany(Workshop::class);
    }
    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }
    public function staff()
    {
        return $this->hasMany(Staff::class)->with('workshops')->orderByDesc('position')->orderBy('last_name');
    }
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    public function group()
    {
        return $this->belongsToMany(Group::Class);
    }

    public function responseable()
    {
        return $this->belongsTo(User::class);
    }
}
