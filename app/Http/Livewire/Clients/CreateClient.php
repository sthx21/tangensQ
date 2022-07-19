<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Workshop;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CreateClient extends Component
{
    public $addedTags;
    public $addTag = '';
    public $client;
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


    protected $listeners = ['addTag', 'createTag'];


    protected $rules = [

        'addedTags'                                         => '',
        'addTag'                                            => '',
        'client.title'                                   => 'string',
        'client.first_name'                              => 'string',
        'client.last_name'                               => 'string',
        'email'                                           => 'required|unique:clients|email',
        'second_email'                                    => 'unique:clients|email',

        'client.phone'                                   => 'string',
        'client.second_phone'                                   => 'string',
        'client.fax_number'                                     => 'string',

        'client.info'                                    => 'string',
        'client.street'                                  => 'string',
        'client.house_number'                            => 'string',
        'client.additional_address'                      => 'string',
        'client.zip'                                     => 'string',
        'client.payment_method'                          => '',
        'client.origin'                                  => '',
        'client.company_id'                              => 'int',
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
        'invoice_recipient.title.required' => 'Es muss eine Anrede gewählt werden.',
        'invoice_recipient.email.required' => 'Es muss eine Email Adresse angegeben werden.',
        'invoice_recipient.email.email' => 'Dies ist keine gültige Email.',
        'invoice_recipient.email.unique' => 'Diese Email ist schon in Benutzung.',
        'invoice_recipient.last_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'invoice_recipient.last_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',
        'invoice_recipient.first_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'invoice_recipient.first_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',


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

        $client = new Client($this->client);
        $client->company_id = $this->addedCompany['id']  ?? '1';
        $client->email = $this->email;
        $client->second_email = $this->second_email;

        $client->save();
        if ($this->addedWorkshop){
            $client->workshops()->attach($this->addedWorkshop->id);
        }
        $tagIds = [];
        foreach ($this->addedTags as $tag){
            $tagIds[] = $tag['id'];
        }
        $client->tags()->attach($tagIds);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Teilnehmer erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/clients');
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

        return view('livewire.clients.create-client', compact('tags', 'companies', 'workshops'));
    }
}
