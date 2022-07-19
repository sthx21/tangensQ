<?php

namespace App\Http\Livewire\Companies;

use App\Http\Controllers\CompanyController;
use App\Http\Livewire\Offers\Staff;
use App\Imports\CompaniesImport;
use App\Imports\CompanyTagsImport;
use App\Models\Company;
use App\Models\Group;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateCompany extends Component
{
use WithFileUploads;
    public $addedTags;
    public $addTag = '';
    public $newCompany;
    public $company;
    public $search;
    public $newLogo;
    public $staff = [];
    public $addGroup = '';
    public $group;

    protected $listeners = ['addTag', 'createTag'];


    protected $rules = [

        'addedTags'                                         => '',
        'addTag'                                           => '',
        'newLogo'                                           => '',
        'newCompany.name'                                   => 'required|string',
        'newCompany.homepage'                               => 'string',
        'newCompany.info'                                   => 'string',
        'newCompany.main_email'                             => 'email',
        'newCompany.second_email'                           => 'email',
        'newCompany.main_phone'                             => 'string',
        'newCompany.second_phone'                           => 'string',
        'newCompany.phone_office'                           => 'string',
        'newCompany.managed_by'                             => 'string',
        'newCompany.country'                                => 'string',
        'newCompany.city'                                => 'string',
        'newCompany.state'                                  => 'string',
        'newCompany.street'                                 => 'string',
        'newCompany.house_number'                           => 'string',
        'newCompany.additional_address'                     => 'string',
        'newCompany.zip'                                    => 'string',
        'newCompany.payment_method'                         => '',
        'newCompany.newsletter'                             => '',
        'newCompany.address_origin'                         => 'string',
        'newCompany.discount'                         => '',
        'newCompany.discount_until'                             => '',
        'staff.*.title'                                     => 'string',
        'staff.*.first_name'                                => 'string',
        'staff.*.last_name'                                 => 'string',
        'staff.*.email'                                     => 'email',
        'staff.*.second_email'                              => 'email',
        'staff.*.phone'                                     => 'string',
        'staff.*.second_phone'                              => 'string',
        'staff.*.info'                                      => 'string',
        'group.name'                                        => 'string'


    ];

    public function mount()
    {
        $addedTags = collect();
        $this->addedTags = $addedTags;



        $this->staff[] = [
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

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'newCompany.name.required' => 'Es muss eine Name gewählt werden.',
        'invoice_recipient.email.required' => 'Es muss eine Email Adresse angegeben werden.',
        'invoice_recipient.email.email' => 'Dies ist keine gültige Email.',
        'invoice_recipient.email.unique' => 'Diese Email ist schon in Benutzung.',
        'invoice_recipient.last_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'invoice_recipient.last_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',
        'invoice_recipient.first_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'invoice_recipient.first_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',

    ];


    public function addStaff()
    {
        $this->staff[] = [
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
    }

    public function addTag($tag)
    {
        if ($this->addedTags->contains($tag)){
            return;
        }
        $this->addedTags->prepend($tag);
        $this->reset('addTag');
}
    public function createTag()
    {
        $newTag = Tag::create(['name' => $this->addTag]);
        $this->addedTags->prepend($newTag);
        $this->reset('addTag');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Tag erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
    }

    public function addGroup($group)
    {

        $this->group = $group;
        $this->reset('addGroup');
    }

    public function createGroup()
    {
        $slug = SlugService::createSlug(Group::class, 'slug', $this->addGroup);
        $newCompanyGroup = Group::create(['name' => $this->addGroup, 'slug' => $slug]);
        $this->group = $newCompanyGroup;
        $this->reset('addGroup');

    }

    public function store()
    {
        $this->validate();
        $company = new Company($this->newCompany);
        $company->managed_by = \Auth::id();

        $company->save();
        if (collect($this->group)->has('id')){

            ///////ATTACH
            $company->group()->attach($this->group['id']);
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
        $results = [];
        if ($this->addTag !== ''){
            $searchTerm = '%'. $this->addTag. '%';
            $results = Tag::where('name', 'LIKE', $searchTerm)
                ->get();
        }
        $groups = [];
        if ($this->addGroup !== ''){
            $searchTerm = '%'. $this->addGroup. '%';
            $groups = Group::where('name', 'LIKE', $searchTerm)
                ->get();
        }
        return view('livewire.companies.create-company', compact('results', 'groups'));
    }
}
