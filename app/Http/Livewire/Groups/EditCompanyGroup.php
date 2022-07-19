<?php

namespace App\Http\Livewire\Groups;


use App\Models\Company;
use App\Models\Group;

use LivewireUI\Modal\ModalComponent as Component;

use App\Models\Staff;

class EditCompanyGroup extends Component
{

    public $group;
    public $groupId;
    public $addMember = '';

    protected $listeners = ['addTag', 'createTag', 'refreshCompany' => '$refresh'];


    protected $rules = [


        'group.name'                                        => 'required',
        'group.discount'                                        => 'int',
        'group.discount_until'                                        => '',
        'addMember'                                       => ''



    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'group.discount.integer'                                     => 'Bitte nur Zahlen eingeben.',
        'group.name.required'                                     => 'Ohne Name geht es nicht.',



    ];

    public function mount()
    {
        $this->group = Group::whereId($this->groupId)->first();
        $this->members = $this->group->companies;

    }
    public function addMember($id)
    {

        if (!$this->members->contains($id)){
            $this->group->companies()->attach($id);
        }
        $this->members = $this->group->companies;

        $this->emit('refreshGroups');
        $this->closeModal();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmen erfolgreich hinzugefügt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
    }

    public function removeMember($id)
    {
        if ($this->members->contains($id)){
            $this->group->companies()->detach($id);
        }
        $this->members = $this->group->companies;
        $this->emit('refreshGroups');
        $this->closeModal();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmen erfolgreich entfernt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
    }


    public function update()
    {
        $this->validate();
        if ($this->group->discount === ''){
            $this->group->discount = 0;
        }
        $this->group->save();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmensgruppe erfolgreich bearbeitet!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->closeModal();

   }

    public function confirmDelete()
    {
        $this->dispatchBrowserEvent('confirmIt', [
            'title' => 'Gruppe löschen?',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

    }

    public function destroy()
    {
        $this->group->save();
        $this->group->destroy($this->group->id);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Gruppe gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/groups');
    }



    public function render()
    {
        $allMembers = [];
        if ($this->addMember !== ''){
            $searchTerm = '%'. $this->addMember. '%';
            $allMembers = Company::where('name', 'LIKE', $searchTerm)
                ->get();
        }

        return view('livewire.groups.edit-company-group', compact('allMembers'));
    }
}
