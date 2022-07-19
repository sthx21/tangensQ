<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Trix extends Component
{
    public const EVENT_VALUE_UPDATED = 'trix_value_updated';

    public $value;
    public $trixId;
    public $trixx;
    protected $rules = [
        'value'             => ''
];
    public function mount($value = ''){
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updatedValue($value){
//        dd($value);
//        $this->emit(self::EVENT_VALUE_UPDATED, $value);
        $this->emit('trixEditor', $value);
    }
    public function render()
    {
        return view('livewire.trix');
    }
}
