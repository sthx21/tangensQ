<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Workshop;

class Dropdown extends Component
{
    public $selectWorkshop = '';
    public  $workshops = '';
//    protected $rules = [
//
//        'workshop.title' => 'string|min:3',
//
//
//    ];

    public function mount()
    {
        $this->workshops = Workshop::with('clients')->get();
    }


    public function render()
    {
        return view('livewire.dropdown')->extends('layouts.app');
    }
}
