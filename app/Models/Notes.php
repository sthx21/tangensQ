<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notes extends Model
{
    use HasFactory;




    protected $fillable = [
        'title',
        'description',
        'user_id',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
