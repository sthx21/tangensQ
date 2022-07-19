<?php

namespace App\Http\Livewire\Staff;

use App\Models\Client;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Workshop;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CreateStaff extends Component
{
    public $addedTags;
    public $addTag = '';
    public $staff;
    public $search;
    public $addCompany = '';
    public $addedCompany;
    public $addWorkshop = '';
    public $addedWorkshop;
    public $email;
    public $second_email;

    public array $titles = [
        'Herr'                      => 'Herr',
        'Frau'                      => 'Frau',
        'Divers'                    => 'Divers'
    ];
    public array $origins = [
        'Laufkundschaft'            => 'Laufkundschaft',
        'Messe'                     => 'Messe',
        'Kaltakquise'               => 'Kaltakquise',
        'Marketing'                 => 'Marketing',
        'Altkunde reaktiviert'      => 'Altkunde reaktiviert'
    ];

    public array $states = [
                    'Baden-Württemberg'                 => 'Baden-Württemberg',
                    'Bayern'                            => 'Bayern',
                    'Berlin'                            => 'Berlin',
                    'Brandenburg'                       => 'Brandenburg',
                    'Bremen'                            => 'Bremen',
                    'Hamburg'                           => 'Hamburg',
                    'Hessen'                            => 'Hessen',
                    'Mecklenburg-Vorpommern'            => 'Mecklenburg-Vorpommern',
                    'Niedersachsen'                     => 'Niedersachsen',
                    'Nordrhein-Westfalen'               => 'Nordrhein-Westfalen',
                    'Rheinland-Pfalz'                   => 'Rheinland-Pfalz',
                    'Saarland'                          => 'Saarland',
                    'Sachsen'                           => 'Sachsen',
                    'Sachsen-Anhalt'                    => 'Sachsen-Anhalt',
                    'Schleswig-Holstein'                => 'Schleswig-Holstein',
                    'Thüringen'                         => 'Thüringen',

    ];


    protected $listeners = ['addTag', 'createTag'];


    protected $rules = [

        'addedTags'                                         => '',
        'addTag'                                            => '',

        'email'                                           => 'required|unique:staff|email',
        'second_email'                                    => 'unique:staff|email',

        'staff.position'                                 => '',
        'staff.title'                                   => '',
        'staff.academic_title'                                 => '',
        'staff.first_name'                                  => '',
        'staff.last_name'                                  => '',
        'staff.department'                                  => '',
        'staff.lead_position'                                 => '',
        'staff.street'                                  => '',
        'staff.additional_address'                                  => '',
        'staff.house_number'                                 => '',
        'staff.zip'                                 => '',
        'staff.city'                                 => '',
        'staff.state'                                   => '',
        'staff.country'                                 => '',
        'staff.address_origin'                                  => '',
        'staff.street_office'                                   => '',
        'staff.house_number_office'                                 => '',
        'staff.additional_address_office'                                   => '',
        'staff.zip_office'                                  => '',
        'staff.city_office'                                 => '',
        'staff.state_office'                                 => '',
        'staff.country_office'                                  => '',
        'staff.email_office'                                 => '',
        'staff.phone'                                   => '',
        'staff.phone_office'                                 => '',
        'staff.fax_number'                                 => '',
        'staff.newsletter'                                  => '',
        'staff.about'                                   => '',
        'staff.revenue'                                 => '',
        'staff.last_note'                                   => '',
        'staff.sex'                                 => '',
        'staff.responsible'                                 => '',
        'staff.function'                                 => '',
        'staff.active'                                  => '',
    ];

    public function mount()
    {
        $addedTags = collect();
        $this->addedTags = $addedTags;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'email.required' => 'Es muss eine Email Adresse angegeben werden.',
        'email.unique' => 'Email schon vergeben.',
        'second_email.unique' => 'Email schon vergeben.',
    ];

    public function addCompany($company)
    {
        $this->addedCompany = $company;
        $this->reset('addCompany');
    }
//section Tags
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
        $slug = SlugService::createSlug(Tag::class, 'slug', $this->addTag);
        $newTag = Tag::create(['name' => $this->addTag, 'slug' => $slug]);
        $this->addedTags->prepend($newTag);
        $this->reset('addTag');

    }
    public function addWorkshop($workshop)
    {
        $this->addedWorkshop = $workshop;
        $this->reset('addWorkshop');
    }
//section store
    public function store()
    {

        $staff = new Staff($this->staff);
        $staff->company_id = $this->addedCompany['id']  ?? '1';
        $staff->email = $this->email;
        $staff->second_email = $this->second_email;

        $staff->save();
        if ($this->addedWorkshop){
            $staff->workshops()->attach($this->addedWorkshop->id);
        }
        $tagIds = [];
        foreach ($this->addedTags as $tag){
            $tagIds[] = $tag['id'];
        }
        $staff->tags()->attach($tagIds);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Mitarbeiter erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/staff');
   }

    public function render()
    {
        $tags = [];
        $companies = [];
        $workshops = [];

        if ($this->addTag !== ''){
            $searchTerm = '%'. $this->addTag. '%';
            $tags = Tag::where('name', 'LIKE', $searchTerm)
                ->get();
        }
        if ($this->addCompany !== ''){
            $searchCompany = '%'. $this->addCompany. '%';
            $companies = Company::where('name', 'LIKE', $searchCompany)
                ->get();
        }
        if ($this->addWorkshop !== ''){
            $searchWorkshop = '%'. $this->addWorkshop. '%';
            $workshops = Workshop::where('title', 'LIKE', $searchWorkshop)
                ->get();
        }

        return view('livewire.staff.create-staff', compact('tags', 'companies', 'workshops'));
    }
}
