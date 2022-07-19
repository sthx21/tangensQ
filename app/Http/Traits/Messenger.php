<?php
namespace App\Http\Traits;
use App\Models\Workshop;
trait Messenger {


    public function index() {


        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
    }
}
