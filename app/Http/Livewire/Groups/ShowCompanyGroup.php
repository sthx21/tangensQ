<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use LivewireUI\Modal\ModalComponent as Component;

class ShowCompanyGroup extends Component
{
    public $group;
    public $groupId;

    protected $listeners = [];


    protected $rules = [


        'group.name'                                        => '',
        'group.discount'                                        => '',
        'group.discount_until'                                        => '',
        'addMember'                                       => ''



    ];

    public function mount()
    {
        $this->group = Group::whereId($this->groupId)->first();
        $this->members = $this->group->companies;

    }



    public function render()
    {
        return view('livewire.groups.show-company-group');
    }
}
