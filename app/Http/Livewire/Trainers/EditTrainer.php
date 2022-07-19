<?php

namespace App\Http\Livewire\Trainers;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TrainerController;
use App\Models\CanceledWorkshop;
use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;

class EditTrainer extends Component
{
    use WithFileUploads;
    public $addedTags;
    public $addTag = '';
    public $trainer;
    public $search;
    public $addCompany = '';
    public $addedCompany;
    public $workshopFilter = 'future';
    public $newLogo;
    public $sort = 'title';
    public $direction = 1;



    public array $titles = [
        'Herr'                      => 'Herr',
        'Frau'                      => 'Frau',
        'Divers'                    => 'Divers'
    ];


    protected $listeners = ['addTag', 'createTag','refreshTrainer' => '$refresh'];


    protected $rules = [

        'addedTags'                                          => '',
        'addTag'                                             => '',
        'newLogo'                                           => '',
        'trainer.title'                                   => 'required|string',
        'trainer.first_name'                              => 'string|nullable',
        'trainer.last_name'                               => 'required|string',
        'trainer.email'                                           => 'email|nullable',
        'trainer.phone'                                   => 'string|nullable',
        'trainer.second_email'                                    => 'email|nullable',
        'trainer.second_phone'                            => 'string|nullable',
        'trainer.info'                                    => 'string|nullable',
        'trainer.street'                                  => 'string|nullable',
        'trainer.house_number'                            => 'string|nullable',
        'trainer.additional_address'                      => 'string|nullable',
        'trainer.zip'                                     => 'string|nullable',
        'trainer.city'                                  => 'string|nullable',
        'trainer.state'                                     => 'string|nullable',
        'trainer.country'                                  => 'string|nullable',
        'trainer.company_name'                                     => 'string|nullable',
        'trainer.homepage'                                  => 'string|nullable',
        'trainer.fax_number'                                     => 'string|nullable',
        'trainer.company_id'                              => 'int|nullable',
        'trainer.inactive_date'                              => 'nullable',
        'trainer.coaching_fee_per_hour'                     => 'nullable',
        'trainer.training_fee_per_day'                      => 'nullable',
        'trainer.consulting_fee_per_day'                    => 'nullable'
    ];

    public function mount(Trainer $trainer)
    {

        $this->trainer = $trainer;
        $this->tags = $trainer->tags;
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
        $this->trainer->tags()->attach($tag['id']);
        $this->reset('addTag');
        $this->emit('refreshTrainer');
}
    public function createTag()
    {
        $slug = SlugService::createSlug(Tag::class, 'slug', $this->addTag);
        $newTag = Tag::create(['name' => $this->addTag, 'slug' => $slug]);
        $this->trainer->tags()->attach($newTag->id);
        $this->reset('addTag');
        $this->emit('refreshTrainer');

    }
    public function removeTag($id)
    {
        $this->trainer->tags()->detach($id);
        $this->emit('refreshTrainer');

    }
    public function confirmDelete()
    {
        $this->dispatchBrowserEvent('confirmIt', [
            'title' => 'Trainer löschen?',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

    }

    public function destroy()
    {
        $this->trainer->save();
        $this->trainer->destroy($this->trainer->id);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Trainer gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/trainers');
    }
    public function setLogo($id)
    {
        $path = Storage::path('tmpLogos');
        $fileName = SlugService::createSlug(Trainer::class, 'slug', $this->trainer['first_name'].'_'.$this->trainer['last_name']).'.jpg';
        $this->newLogo[0]->storeAs('tmpLogos', $fileName);
        $fullPath = $path.'/'.$fileName;
        $setLogo = new TrainerController();
        $setLogo->storeLogo($id, $fullPath);
    }
    public function update()
    {
        $this->validate();
        $this->trainer->save();

        if ($this->newLogo){
            $this->setLogo($this->trainer->id);
        }
        $this->emit('refreshTrainer');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Trainer bearbeitet!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/trainers');
   }
    public function backToTrainers()
    {
        $this->redirect('/trainers');
    }

    public function toggleActive()
    {
        $this->trainer->active = !$this->trainer->active;

        if ($this->trainer->active){
            $this->trainer->inactive_date = '';
        }
        $this->trainer->save();
    }
    public function getWorkshops($filter):void
    {
        $this->workshopFilter = $filter;
        $workshops = [];

        switch ($filter){
            case('all'):
                foreach ($this->trainer->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    $workshops[] = $workshop;
                }
                break;
            case('history'):
                foreach ($this->trainer->workshops as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date < $this->today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
                case('future'):
                foreach ($this->trainer->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date > $this->today) {
                        $workshops[] = $workshop;
                    }
                }
                    break;
                case('canceled'):
                    $canceledWorkshops = CanceledWorkshop::where('trainer_id', $this->trainer->id)->get('workshop_id');
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
        $this->emit('canceledByTrainer', $toCancel['id'], $this->trainer->id, $reason);
        $this->emit('refreshTrainer');
        $this->getWorkshops($this->workshopFilter);
    }
    public function workshopReactivation($toReactivate)
    {
        $reason = 'Leer';
        $this->emit('reactivateCancelByTrainer', $toReactivate['id'], $this->trainer->id, $reason);
        $this->emit('refreshTrainer');
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


        return view('livewire.trainers.edit-trainer', compact('results', 'companies'));
    }
}
