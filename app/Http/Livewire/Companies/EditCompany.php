<?php

namespace App\Http\Livewire\Companies;

use App\Http\Controllers\CompanyController;
use App\Models\Client;
use App\Models\Company;
use App\Models\Group;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use App\Models\Staff;

class EditCompany extends Component
{
use WithFileUploads;
    public $addedTags;
    public $addTag = '';
    public $company;
    public $search;
    public $newLogo;
    public $staff;
    public $newStaff= [];
    public $clients;
    public $addGroup = '';
    public $group;

    protected $listeners = ['addTag', 'createTag', 'refreshCompany' => '$refresh'];


    protected $rules = [

        'addedTags'                                         => '',
        'addTag'                                           => '',
        'newLogo'                                           => '',
        'company.name'                                      => 'string',
        'company.homepage'                                  => 'string',
        'company.info'                                      => 'string',
        'company.main_email'                             => 'email',
        'company.second_email'                           => 'email',
        'company.main_phone'                             => 'string',
        'company.second_phone'                           => 'string',
        'company.phone_office'                           => 'string',
        'company.managed_by'                             => 'string',
        'company.country'                                => 'string',
        'company.state'                                  => 'string',
        'company.street'                                 => 'string',
        'company.house_number'                           => 'string',
        'company.additional_address'                     => 'string',
        'company.zip'                                    => 'string',
        'company.payment_method'                         => '',
        'company.newsletter'                             => '',
        'company.address_origin'                         => 'string',
        'company.city'                                => 'string',
        'company.discount'                         => '',
        'company.discount_until'                             => '',

        'company.group_id'                                  => '',
        'staff.*.title'                                     => 'string',
        'staff.*.position'                                     => 'string',
        'staff.*.first_name'                                => 'string',
        'staff.*.last_name'                                 => 'string',
        'staff.*.email'                                     => 'email',
        'staff.*.second_email'                              => 'email',
        'staff.*.phone'                                     => 'string',
        'staff.*.second_phone'                              => 'string',
        'staff.*.info'                                      => 'string',
        'newStaff.*.title'                                     => 'string',
        'newStaff.*.first_name'                                => 'string',
        'newStaff.*.last_name'                                 => 'string',
        'newStaff.*.email'                                     => 'email',
        'newStaff.*.second_email'                              => 'email',
        'newStaff.*.phone'                                     => 'string',
        'newStaff.*.second_phone'                              => 'string',
        'newStaff.*.info'                                      => 'string',
        'group.name'                                        => '',
        'addGroup'                                       => ''



    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'newStaff.position.string'                                     => 'string',
        'newStaff.title.string'                                     => 'string',
        'newStaff.first_name.string'                                => 'string',
        'newStaff.last_name.string'                                 => 'string',
        'newStaff.email.email'                                     => 'email',
        'newStaff.second_email.email'                              => 'email',
        'newStaff.phone.string'                                     => 'string',
        'newStaff.second_phone.string'                              => 'string',
        'newStaff.info.string'                                      => 'string',

    ];

    public function mount( )
    {
        $this->managed = $this->company->managed_by;
        $addedTags = collect();
        $this->addedTags = $addedTags;
        $this->group = $this->company->group()->first();
        $this->staff = Staff::where('company_id',$this->company->id)->get();
        $this->newStaff[] = [
            'company_id' => '',
            'title' => '',
            'position' => '',
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'second_email' => '',
            'phone' => '',
            'second_phone' => '',
            'info' => '',
        ];
        $this->managed_by = [
            'Jana'              => 'Jana',
            'Thorsten'          => 'Thorsten',
            'Andrea'            => 'Andrea',
            'Cirsten'           => 'Cirsten',
            'Gerald'            => 'Gerald',
            'Annette'           => 'Annette'
        ];

    }
    public function addStaff()
    {
        $validatedData = $this->validate([

            'newStaff.position'                                  => 'string',
            'newStaff.title'                                     => 'string',
            'newStaff.first_name'                                => 'string',
            'newStaff.last_name'                                 => 'required|string',
            'newStaff.email'                                     => 'email|nullable',
            'newStaff.second_email'                              => 'email|nullable',
            'newStaff.phone'                                     => 'string',
            'newStaff.second_phone'                              => 'string',
            'newStaff.info'                                      => 'string',

        ]);
        foreach ($validatedData as $newData){
            $newStaff = Staff::create($newData);
            $newStaff->company_id = $this->company->id;
            $newStaff->save();
            $this->staff->add($newStaff);
            $this->newStaff = '';
        }
        $this->emit('refreshCompany');

    }

    public function removeStaff($id)
    {
        $removeStaff = Staff::findOrFail($id);
        $removeStaff->company_id = 1;
        $removeStaff->save();
        $this->staff = $this->company->staff;
        $this->emit('refreshCompany');
    }

    public function removeClient($id)
    {
       $client = Client::findOrFail($id);
       $client->company_id = 1;
       $client->save();
    }
    public function addTag($tag)
    {
        if ($this->company->tags->contains($tag['id'])){
            return;
        }
        $this->company->tags()->attach($tag['id']);
        $this->reset('addTag');
        $this->emit('refreshCompany');

}
    public function createTag()
    {
        $newTag = Tag::create(['name' => $this->addTag]);
        $this->company->tags()->attach($newTag->id);
        $this->reset('addTag');
        $this->emit('refreshCompany');

    }
    public function updateGroup($group)
    {
        $this->group = $group;
//        $this->company->group_id = $group['id'];
        $this->company->save();
        $this->company->group()->attach($group['id']);
        $this->update();
        $this->reset('addGroup');
    }

    public function createGroup()
    {
        $slug = SlugService::createSlug(Group::class, 'slug', $this->addGroup);
        $newCompanyGroup = Group::create(['name' => $this->addGroup, 'slug' => $slug]);
        $this->group = $newCompanyGroup;
        $this->company->group()->attach($newCompanyGroup->id);
        $this->update();
        $this->reset('addGroup');
    }

    public function removeTag($id)
    {
        $this->company->tags()->detach($id);
        $this->emit('refreshCompany');

    }
    public function update()
    {
        $this->company->save();
        foreach ($this->staff as $member){
            $member->save();
        }

        if ($this->newLogo){
            $this->setLogo($this->company->id);
        }
        $this->emit('refreshCompany');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmen gespeichert!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
   }

    public function confirmDelete()
    {
        $this->dispatchBrowserEvent('confirmIt', [
            'title' => 'Unternehmen löschen?',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

   }

    public function destroy()
    {
        $this->company->save();
        $this->company->destroy($this->company->id);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Unternehmen gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/companies');
   }
    public function backToCompanies()
    {
        $this->redirect('/companies');
   }

    public function setLogo($id)
    {
        $path = Storage::path('tmpLogos');
        $fileName = SlugService::createSlug(Company::class, 'slug', $this->company['name']).'.jpg';
        $this->newLogo[0]->storeAs('tmpLogos', $fileName);
        $fullPath = $path.'/'.$fileName;
        $setLogo = new CompanyController();
        $setLogo->storeLogo($id, $fullPath, $fileName);
    }


    public function render()
    {
        $results = [];
        if ($this->addTag !== ''){
            $searchTerm = '%'. $this->addTag. '%';
            $results = Tag::where('name', 'LIKE', $searchTerm)
                ->get();
        }
        $groupResults = [];
        if ($this->addGroup !== ''){
                $searchTerm = '%' . $this->addGroup . '%';
                $groupResults = Group::where('name', 'LIKE', $searchTerm)
                    ->get();

        }
        return view('livewire.companies.edit-company', compact('results', 'groupResults'));
    }
}
