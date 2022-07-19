<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'company_id',
        'trainer_id',
        'webex_id',
        'workshop_id',
        'inhouse_id',
        'offer_id',
        'client_id',
        'staff_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function webex()
    {
        return $this->belongsTo(Webex::class);
    }
}
