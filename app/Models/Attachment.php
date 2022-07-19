<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Attachment extends Model
{
    use HasFactory;

    protected $casts = [
        'bodies' => 'array'
    ];


    protected $fillable = [
        'from',
        'to',
        'subject',
        'bodies',
        'user_id',
        'offer_id',
        'client_id',
        'staff_id'

    ];

    public function offers()
    {
        return $this->belongsTo(Offer::class);
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
