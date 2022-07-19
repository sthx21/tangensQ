<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Event extends Model

{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'starTime',
        'end',
        'endTime',
        'allDay',
        'first_trainer_name',
        'second_trainer_name',
        'location',
        'company',
        'offer_number',
        'groupId',
    ];
}
