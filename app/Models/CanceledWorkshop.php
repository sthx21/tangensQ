<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CanceledWorkshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reason',
        'trainer_id',
        'client_id',
        'staff_id',
        'user_id',
        'company_id',
        'workshop_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
