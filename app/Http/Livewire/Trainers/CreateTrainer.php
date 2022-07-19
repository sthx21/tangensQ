<?php

namespace App\Http\Livewire\Trainers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CreateTrainer extends Component
{
    public $addedTags;
    public $addTag = '';
    public $trainer;
    public $search;
    public $addCompany = '';
    public $addedCompany;
    public $email;
    public $second_email;



    public array $titles = [
        'Herr'                      => 'Herr',
        'Frau'                      => 'Frau',
        'Divers'                    => 'Divers'
    ];


    protected $listeners = ['addTag', 'createTag'];


    protected $rules = [

        'addedTags'                                         => '',
        'addTag'                                            => '',
        'trainer.title'                                     => 'required|string',
        'trainer.first_name'                                => 'string',
        'trainer.last_name'                                 => 'required|string',
        'email'                                             => 'required|unique:trainers|email',
        'trainer.phone'                                     => 'string',
        'second_email'                                      => 'unique:trainers|email',
        'trainer.second_phone'                              => 'string',
        'trainer.info'                                      => 'string',
        'trainer.street'                                    => 'string',
        'trainer.house_number'                              => 'string',
        'trainer.additional_address'                        => 'string',
        'trainer.city'                                      => 'string',
        'trainer.state'                                     => 'string',
        'trainer.company_name'                              => 'string',
        'trainer.country'                                   => 'string',
        'trainer.zip'                                       => 'string',
        'trainer.fax_number'                                => 'string',
        'trainer.company_id'                                => 'int',
        'trainer.coaching_fee_per_hour'                     => '',
        'trainer.training_fee_per_day'                      => '',
        'trainer.consulting_fee_per_day'                    => ''
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
        'trainer.title.required' => 'Es muss eine Anrede gewählt werden.',
        'trainer.email.required' => 'Es muss eine Email Adresse angegeben werden.',
        'trainer.email.email' => 'Dies ist keine gültige Email.',
        'trainer.email.unique' => 'Diese Email ist schon in Benutzung.',
        'trainer.second_email.email' => 'Dies ist keine gültige Email.',
        'trainer.second_email.unique' => 'Diese Email ist schon in Benutzung.',
        'trainer.last_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'trainer.last_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',
        'trainer.first_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'trainer.first_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',


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

    public function store()
    {
        $this->addedCompany['id'] = 1;
        $trainer = new Trainer($this->trainer);
        $trainer->email = $this->email;
        $trainer->second_email = $this->second_email;
        if($this->addedCompany){
            $trainer->company_id = $this->addedCompany['id'];
        }

        $trainer->save();

        $tagIds = [];
        foreach ($this->addedTags as $tag){
            $tagIds[] = $tag['id'];
        }
        $trainer->tags()->attach($tagIds);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Trainer erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/trainers');
   }

    public function render()
    {
        $tags = [];
        $companies = [];

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

        return view('livewire.trainers.create-trainer', compact('tags', 'companies'));
    }
}
