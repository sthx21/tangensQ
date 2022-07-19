<?php

namespace App\Http\Livewire\Clients;

use App\Http\Controllers\ClientController;
use App\Models\CanceledWorkshop;
use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Workshop;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;

class EditClient extends Component
{
    use WithFileUploads;
    public $addedTags;
    public $addTag = '';
    public $client;
    public $search;
    public $addCompany = '';
    public $addedCompany;
    public $workshopFilter = 'future';
    public $newLogo;
    public $sort = 'title';
    public $direction = 1;

    const STRNULL   = 'string|nullable';
    const EMLNULL   = 'email|nullable';
    const REQSTR    = 'required|string';

    public array $titles = [
        'Herr'                      => 'Herr',
        'Frau'                      => 'Frau',
        'Divers'                    => 'Divers'
    ];


    protected $listeners = ['addTag', 'createTag','refreshClient' => '$refresh'];


    protected $rules = [

        'addedTags'                                      => '',
        'addTag'                                         => '',
        'newLogo'                                        => '',
        'client.title'                                   => self::REQSTR,
        'client.first_name'                              => self::STRNULL,
        'client.last_name'                               => self::REQSTR,
        'client.email'                                   => self::EMLNULL,
        'client.phone'                                   => self::STRNULL,
        'client.second_email'                            => self::EMLNULL,
        'client.second_phone'                            => self::STRNULL,
        'client.info'                                    => self::STRNULL,
        'client.street'                                  => self::STRNULL,
        'client.house_number'                            => self::STRNULL,
        'client.additional_address'                      => self::STRNULL,
        'client.zip'                                     => self::STRNULL,
        'client.city'                                    => self::STRNULL,
        'client.homepage'                                => self::STRNULL,
        'client.fax_number'                              => self::STRNULL,
        'client.company_id'                              => 'int|nullable',
        'client.inactive_date'                           => 'nullable',
    ];

    public function mount(Client $client)
    {

        $this->client = $client;
        $this->tags = $client->tags;
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
    public function addTag($tag)
    {
        if ($this->tags->contains($tag)){
            return;
        }
        $this->client->tags()->attach($tag['id']);
        $this->reset('addTag');
        $this->emit('refreshClient');
}
    public function createTag()
    {
        $slug = SlugService::createSlug(Tag::class, 'slug', $this->addTag);
        $newTag = Tag::create(['name' => $this->addTag, 'slug' => $slug]);
        $this->client->tags()->attach($newTag->id);
        $this->reset('addTag');
        $this->emit('refreshClient');

    }
    public function removeTag($id)
    {
        $this->client->tags()->detach($id);
        $this->emit('refreshClient');

    }
    public function setLogo($id)
    {
        $path = Storage::path('tmpLogos');
        $fileName = SlugService::createSlug(Client::class, 'slug', $this->client['first_name'].'_'.$this->client['last_name']).'.jpg';
        $this->newLogo[0]->storeAs('tmpLogos', $fileName);
        $fullPath = $path.'/'.$fileName;
        $setLogo = new ClientController();
        $setLogo->storeLogo($id, $fullPath);
    }
    public function update()
    {
        $this->validate();
        $this->client->save();

        if ($this->newLogo){
            $this->setLogo($this->client->id);
        }
        $this->emit('refreshTrainer');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Teilnehmer bearbeitet!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/clients');
   }
    public function destroy()
    {
        $this->client->save();
        $this->client->destroy($this->client->id);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'TN gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/clients');
    }
    public function backToClients()
    {
        $this->redirect('/clients');
    }

    public function toggleActive()
    {
        $this->client->active = !$this->client->active;

        if ($this->client->active){
            $this->client->inactive_date = '';
        }
        $this->client->save();
    }
    public function getWorkshops($filter):void
    {
        $this->workshopFilter = $filter;
        $workshops = [];

        switch ($filter){
            case('all'):
                foreach ($this->client->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    $workshops[] = $workshop;
                }
                break;
            case('history'):
                foreach ($this->client->workshops as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date < $this->today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
                case('future'):
                foreach ($this->client->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date > $this->today) {
                        $workshops[] = $workshop;
                    }
                }
                    break;
                case('canceled'):
                    $canceledWorkshops = CanceledWorkshop::where('client_id', $this->client->id)->get('workshop_id');
                    foreach ($canceledWorkshops as $canceledWorkshop){
                        $workshop = Workshop::where('id', $canceledWorkshop->workshop_id)->firstOrFail();
                        $dt = Carbon::parse($workshop->start_date);
                        $workshop->start_date = $dt;
                        $workshops[] = $workshop;
                    }
                break;
            default:
        }
        $this->workshops = collect($workshops)->all();
}
    public function sorting($sort)
    {
        if ($this->sort === $sort){
            if($this->direction === 1){
                $this->direction = 0;
            }
            else{
                $this->direction = 1;
            }
        }
        $this->sort = $sort;
    }

    public function cancelWorkshop($toCancel)
    {
        $reason = 'Leer';
        $this->emit('canceledByClient', $toCancel['id'], $this->client->id, $reason);
        $this->emit('refreshClient');
        $this->getWorkshops($this->workshopFilter);
    }
    public function workshopReactivation($toReactivate)
    {
        $reason = 'Leer';
        $this->emit('reactivateCancelByClient', $toReactivate['id'], $this->client->id, $reason);
        $this->emit('refreshClient');
        $this->getWorkshops($this->workshopFilter);
    }
    public function render()
    {
        $this->today = Carbon::today();
        $results = [];
        $companies = [];

        if ($this->addTag !== ''){
            $searchTerm = '%'. $this->addTag. '%';
            $results = Tag::where('name', 'LIKE', $searchTerm)
                ->get();
        }
        if ($this->addCompany !== ''){
            $searchCompany = '%'. $this->addCompany. '%';
            $companies = Company::where('name', 'LIKE', $searchCompany)
                ->get();
        }
        $this->getWorkshops($this->workshopFilter);


        return view('livewire.clients.edit-client', compact('results', 'companies'));
    }
}
