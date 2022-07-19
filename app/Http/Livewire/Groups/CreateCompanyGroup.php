<?php

namespace App\Http\Livewire\Groups;

use App\Models\Company;
use App\Models\Group;
use LivewireUI\Modal\ModalComponent as Component;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CreateCompanyGroup extends Component
{
    public $groupMembers;
    public $group;

    protected $listeners = ['addTag', 'createTag'];


    protected $rules = [


        'group.name'                                        => 'unique:groups,name|string',
        'group.discount'                                    => 'int',
        'group.discount_until'                              => 'date'



    ];

    public function mount()
    {
       // $availableMembers = Company::whereNot('group_id');

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'group.name.unique' => 'Gruppe schon vorhanden.',
        'group.discount.integer' => 'Für die Berechnung bitte nur Ganzzahlen eingeben.',
        'group.discount_until.date' => 'Datum bitte.',

    ];



    public function createGroup()
    {
        $slug = SlugService::createSlug(Group::class, 'slug', $this->group['name']);
        $newGroup = Group::create([
            'name' => $this->group['name'],
            'slug' => $slug,
            'discount' => $this->group['discount'] ?? 0,
            'discount_until' => $this->group['discount_until'] ?? '',
        ]);
        $this->newGroup = $newGroup;
        $this->reset('group');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmensgruppe erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->closeModal();
//        $this->redirect('/companies');

    }

    public function store()
    {
        $company = new Company($this->newCompany);
        $company->managed_by = \Auth::id();

        $company->save();
        if ($this->group){
            $company->company_group_id = $this->group->id;
        }
        if ($this->newLogo){
            $this->setLogo($company->id);
        }

        $tagIds = [];
        foreach ($this->addedTags as $tag){
            $tagIds[] = $tag['id'];
        }
        $this->addStaffMember($company->id);
        $company->tags()->attach($tagIds);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmen erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/companies');
   }

    public function setLogo($id)
    {
        $path = Storage::path('tmpLogos');
        $fileName = SlugService::createSlug(Company::class, 'slug', $this->newCompany['name']).'.jpg';
        $this->newLogo[0]->storeAs('tmpLogos', $fileName);
        $fullPath = $path.'/'.$fileName;
        $setLogo = new CompanyController();
        $setLogo->storeLogo($id, $fullPath);
    }

    public function addStaffMember($id)
    {

        foreach ($this->staff as $member){
            if ($member['last_name']) {
                $staffMember = new \App\Models\Staff($member);
                $staffMember['company_id'] = $id;
                $staffMember->save();
            }
        }
    }
    public function render()
    {

        return view('livewire.groups.create-company-group');
    }
}
