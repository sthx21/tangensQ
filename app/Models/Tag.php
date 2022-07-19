<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;




    protected $fillable = [
        'name',
        'old_id'
    ];



    public function staff()
    {
        return $this->belongsToMany(Staff::class);
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot('company_id');
    }
}
