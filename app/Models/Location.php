<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;



class Location extends Model
{
    use Notifiable;
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

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
        'street_address',
        'house_number',
        'zip',
        'email',
        'phone',
        'contact_first_name',
        'contact_last_name',
        'contact_info',
        'contact_phone',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    ////
    //Relationships
    ////

    public function workshops()
    {
        return $this->hasMany(Workshop::Class);
    }
}
