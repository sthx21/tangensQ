<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent as Component;
use Spatie\Permission\Models\Role;
use App\Models\User;



class ModalUser extends Component
{
    public $roles;
    public $role;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public User $user;



    public function render()
    {
        return view('livewire.modal-user');
    }
}
