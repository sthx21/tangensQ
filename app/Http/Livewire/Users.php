<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent as Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    public $roles, $role, $name, $email, $password, $password_confirmation;
    public $userId;
    public $editMode = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:password_confirmation',
        'password_confirmation' => 'required|same:password',
        'roles' => 'required'
    ];
    public function mount()
    {
        $this->roles = Role::all();
    }
    public function render()
    {
        $this->users = User::all();

        return view('livewire.users');
    }

    private function clearForm()
    {
        $this->name = '';
        $this->email = '';
    }

    public function store()
    {
        $this->validate();
        $user = new User();
        $user->fill((array)$this);
        $user->password = Hash::make($this->password);
        $user->assignRole($this->role);
        $user->save();
        session()->flash('message', 'Users Created Successfully.');

        $this->clearForm();
    }

    public function edit($id)
    {
        $user = User::firstOrFail($id);

        $this->editMode = true;
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function cancel()
    {
        $this->editMode = false;
        $this->clearForm();
    }

    public function update()
    {
        $this->validate();

        $user = User::firstOrFail($this->user_id);

        $user->update(array($this));

        $this->editMode = false;
        $this->clearForm();

        session()->flash('message', 'Users Updated Successfully.');
    }

    public function delete($id)
    {
        User::firstOrFail($id)->delete();

        session()->flash('message', 'Users Deleted Successfully.');
    }
}
