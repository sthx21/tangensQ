<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent as Component;
use Spatie\Permission\Models\Role;
use App\Models\User;


class CreateUser extends Component
{
    public $roles;
    public $role;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public User $user;


    public function mount()
    {
        $this->roles = Role::all();
    }
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:password_confirmation|min:6',
        'password_confirmation' => 'required|same:password',
        'roles' => 'required'
    ];
    public function updated($propertyName)

    {

        $this->validateOnly($propertyName);

    }
    protected $messages = [

        'email.required' => 'Es muss eine Email Adresse angegeben werden.',
        'email.email' => 'Dies ist keine gültige Email.',
        'email.unique' => 'Diese Email isst schon in Benutzung.',
        'name.required' => 'Das Feld Name kann nicht leer sein.',
        'name.min' => 'Der Name ist zu kurz.',
        'password.same' => 'Passwort und Passwort wiederholen stimmen nicht überein.',
        'password.min' => 'Das Passwort ist zu kurz.(mind. 6 Zeichen)',

    ];
    /**
     * Store a newly created User in storage.
     *
     *
     */
    public function submit()
    {
        $this->validate();
        $user = new User();
        $user->fill((array)$this);
        $user->password = Hash::make($this->password);
        $user->assignRole($this->role);
        $user->save();
    }
    public function update()
    {
        $this->validate();
        if(!empty($this->password)){
            $this->password = Hash::make($this->password);
//        }else{
//            $input = Arr::except($input,array('password'));
//        }
        $this->user->update(array($this));
    }}

    public function render()
    {
        return view('livewire.create-user');
    }
}
