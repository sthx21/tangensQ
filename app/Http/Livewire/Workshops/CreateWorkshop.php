<?php

namespace App\Http\Livewire\Workshops;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MailController as Mailer;
use App\Http\Livewire\Offers\Staff;
use App\Imports\CompaniesImport;
use App\Imports\CompanyTagsImport;
use App\Models\Company;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateWorkshop extends Component
{
use WithFileUploads;
    public $addedTags;
    public $addTag = '';
    public $newWorkshop;
    public $search;
    public $module = false;

    public $topic_coreQuestions = [];
    public $events = [];


    protected $listeners = ['addTag', 'createTag'];


    protected $rules = [

        'addedTags'                                                 => '',
        'addTag'                                                    => '',
        'newWorkshop.title'                                         => 'required|string',
        'newWorkshop.additional_title'                              => 'string',
        'newWorkshop.price'                                         => 'string',
        'newWorkshop.topic_coreQuestions'                           => '',
        'newWorkshop.detail'                                        => '',
        'newWorkshop.process_flow'                                  => 'string',
        'newWorkshop.targets'                                       => 'string',
        'newWorkshop.misc'                                          => 'string',
        'newWorkshop.region'                                        => '',


        'events.*.first_trainer' => 'required',
        'events.*.second_trainer' => '',
        'events.*.start_date'    => 'required',
        'events.*.end_date'      => '',
        'events.*.start_time'    => '',
        'events.*.end_time'      => '',
        'events.*.location'      => '',
        'events.*.cancel_days'   => 'required|int'



    ];

    public function mount()
    {
        $this->trainers = Trainer::all();
        $addedTags = collect();
        $this->addedTags = $addedTags;

        $group = collect();
        $this->group = $group;

        $this->topic_coreQuestions[] = [
            'topic' => '',
        ];

        $this->events[] = [
            'first_trainer' => '',
            'second_trainer' => '',
            'start_date'    => '',
            'end_date'      => '',
            'start_time'    => '',
            'end_time'      => '',
            'location'      => '',
            'cancel_days'   => ''
        ];
        $this->regions = [
            'Nord'  => 'Nord',
            'Süd'   => 'Süd',
            'West'  => 'West',
            'Ost'   => 'Ost',
            'Mitte' => 'Mitte',
        ];

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'newWorkshop.title.required'                                   => 'Wie lautet der Titel?',

        'events.*.first_trainer.required' => 'Bitte gebe einen Titel ein.',
        'events.*.start_date.required'    => 'Startdatum fehlt.',

        'events.*.cancel_days.required'   => 'Stornofrist fehlt.'


    ];


    public function addTopic()
    {
        $this->topic_coreQuestions[] = [
            'title' => '',
        ];
    }
    public function removeTopic($key)
    {
        $topics = collect($this->topic_coreQuestions)->forget($key);
        $this->topic_coreQuestions = $topics;
    }
    public function addEvent()
    {
        $this->events[] = [
            'first_trainer' => '',
            'second_trainer' => '',
            'start_date'    => '',
            'end_date'      => '',
            'start_time'    => '',
            'end_time'      => '',
            'location'      => '',
            'cancel_days'   => ''
        ];
    }
    public function removeEvent($key)
    {
        $events = collect($this->events)->forget($key);
        $this->events = $events;
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


    public function store()
    {
        $this->validate();

        $workshopSeriesIds = [];
        foreach ($this->events as $event){
            if ($event['first_trainer']){
                $trainers = [$event['first_trainer']];
            }
            if ($event['second_trainer']){
                $trainers = [$event['first_trainer'],$event['second_trainer']];
            }
            $workshop  = new Workshop($this->newWorkshop);

            $workshop->start_date = $event['start_date'];
            $workshop->end_date = $event['end_date'];
            $workshop->start_time = $event['start_time'];
            $workshop->end_time = $event['end_time'];
            $workshop->location = $event['location'];
            $workshop->region = $event['region'];

            $workshop->cancellation_date = createDate($event['start_date'])->copy()->subDays($event['cancel_days'])->format('Y-m-d');
            $workshop->topic_coreQuestions = $this->topic_coreQuestions;
            $workshop->user_id = \Auth::id();
            $workshop->save();
            $this->createWorkshopEvents($workshop, $trainers);
            $workshopSeriesIds[] = $workshop->id;
            $workshop->trainers()->attach($trainers);
//            $notification = new Mailer();
//            $notification->createdWorkshopNotification('new@workshop.com', $workshop);
        }
        foreach ($workshopSeriesIds as $key => $seriesId){
            $workshopLink = Workshop::find($seriesId);

            unset($workshopSeriesIds[$key]);
            $series = collect($workshopSeriesIds);
            $workshopLink->series = $series->values();
            $workshopLink->save();
            $workshopSeriesIds[] = $seriesId;
        }

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar/Seminare erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
   }
    public function createWorkshopEvents($workshop, $trainers)
    {
        $this->emit('createEventFromWorkshop', $workshop, $trainers);
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


    public function render()
    {
        $results = [];
        if ($this->addTag !== ''){
            $searchTerm = '%'. $this->addTag. '%';
            $results = Tag::where('name', 'LIKE', $searchTerm)
                ->get();
        }

        return view('livewire.workshops.create-workshop', compact('results'));
    }
}
