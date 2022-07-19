<?php

namespace App\Http\Livewire\Workshops;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MailController as Mailer;

use App\Models\Activity;
use App\Models\Client;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditWorkshop extends Component
{
use WithFileUploads;
    public $addedClients;
    public $addClientLastName = '';
    public $addClientFirstName = '';

    public $workshop;
    public $search;

    public $events = [];
    public $first_trainer, $second_trainer;


    protected $listeners = ['addTag', 'createTag', 'refreshWorkshop' => '$refresh'];


    protected $rules = [

        'addedTags'                                         => '',
        'addClientLastName'                                           => '',
        'addClientFirstName'                                           => '',
        'workshop.title'                                   => 'string',
        'workshop.additional_title'                               => 'string',
        'workshop.price'                                   => 'string',
        'workshop.topic_coreQuestions.*.topic'              => '',
        'workshop.detail'                           => 'string',
        'workshop.process_flow'                             => 'string',
        'workshop.targets'                           => 'string',
        'workshop.misc'                           => 'string',
        'workshop.region'                           => '',
        'workshop.status'                           => '',
        'workshop.start_date'    => '',
        'workshop.end_date'      => '',
        'workshop.start_time'    => '',
        'workshop.end_time'      => '',
        'workshop.location'      => '',
        'workshop.cancellation_date'   => '',
        'first_trainer'             => '',
        'second_trainer'            => '',



    ];

    public function mount()
    {
        $this->trainers = Trainer::all();
        $this->first_trainer = $this->workshop->trainers->first()->id;
        $this->second_trainer = $this->workshop->trainers->last()->id;

        $this->staff = $this->workshop->staff;
        $this->clients = $this->workshop->clients;

        $addedTags = collect();
        $this->addedTags = $addedTags;


        $this->regions = [
            'Nord'  => 'Nord',
            'Süd'   => 'Süd',
            'West'  => 'West',
            'Ost'   => 'Ost',
            'Mitte' => 'Mitte',
        ];
        $this->status = [
            'Aktiv'  => 'Aktiv',
            'Inaktiv'   => 'Inaktiv',
            'Online'  => 'Online',
            'Storniert'   => 'Storniert'
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

        $topics = $this->workshop->topic_coreQuestions;
        $topics[] = ['topic' => ''];
        $this->workshop->topic_coreQuestions = $topics;
    }
    public function removeTopic($key)
    {
        $topics = collect($this->workshop->topic_coreQuestions)->forget($key);
        $this->workshop->topic_coreQuestions = $topics;
        $this->update();
    }


    public function addStaff($staff)
    {
        $client = $this->transferToClients($staff);
        $this->addClient($client);
}

    public function addClient($client)
    {
        if ($this->clients->contains($client['id'])){

            $this->dispatchBrowserEvent('swal', [
                'title' => 'TN bereits vorhanden!',
                'timer'=>1500,
                'icon'=>'warning',
                'toast'=>true,
                'position'=>'top-center'
            ]);
            return;
        }
        $this->workshop->clients()->attach($client['id']);
        $this->workshop->clients()->updateExistingPivot($client['id'], ['status' => 'Reserviert']);

        $this->reset('addClientLastName');
        $this->reset('addClientFirstName');

        $this->emit('refreshWorkshop');

    }
    public function transferToClients($staff)
    {
        $oldStaff = Staff::whereId($staff['id'])->first();
        $newClient = collect($staff)->except('company')->toArray();
        $client = Client::where('email', $newClient['email'])->first();
        if (!$client){
            $client =  Client::create($newClient);
            $client->tags()->attach($oldStaff->tags()->get());
            $client->workshops()->attach($oldStaff->workshops()->get());
            $staffActivities = Activity::whereStaffId($staff['id'])->get();
            foreach ($staffActivities as $clientActivity){
                $clientActivity->client_id = $client->id;
                $clientActivity->save();
            }
        }
        $client->save();

        //TODO Transfer Activities
        $this->dispatchBrowserEvent('swal', [
            'title' => 'TN erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        return $client;
    }
    public function transferLogoToClient($id)
    {

        $setLogo = new ClientController();
        $setLogo->transferLogo($id, $this->staff->getFirstMediaUrl('staffLogo'));
    }
    public function confirmClientRemoval($client)
    {
        $this->dispatchBrowserEvent('confirmClientRemove', [
            'title' => 'Teilnehmer '.$client['last_name'].', '.$client['first_name'].' entfernen?',
            'timer'=>3000,
            'id' => $client['id'],
            'icon'=>'warning',
            'toast'=>true,
            'position'=>'top-right'
        ]);

    }
    public function removeClient($id)
    {
        $this->workshop->clients()->detach($id);
        $this->update();
        $reason = 'Leer';
        $this->emit('canceledByClient', $this->workshop->id, $id, $reason);
        $this->emit('refreshStaff');
        $this->emit('refreshWorkshop');
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


    public function changeFirstTrainer($id)
    {
        $this->first_trainer = Trainer::whereId($id)->first();
    }
    public function update()
    {
        if ($this->workshop->canceled){

            $this->dispatchBrowserEvent('swal', [
                'title' => 'Seminar storniert und kann nicht mehr bearbeitet werden!',
                'timer'=>3000,
                'icon'=>'warning',
                'toast'=>true,
                'position'=>'top-center'
            ]);
            return;
        }

        $this->workshop->trainers()->sync([$this->first_trainer,$this->second_trainer]);
//        $this->validate();
            $this->workshop->save();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar gespeichert!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
   }
    public function showWorkshop($workshop)
    {
        $this->redirect('/workshops/'.$workshop['slug']);
    }
    public function backToWorkshops()
    {
        $this->redirect(route('workshops'));
    }
    public function confirmDelete()
    {
        $this->dispatchBrowserEvent('confirmIt', [
            'title' => 'Seminar löschen?',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

    }


    public function destroy()
    {
        $this->workshop->save();
        $this->workshop->destroy($this->workshop->id);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect(route('workshops'));
    }

    public function setStatus()
    {
        $this->workshop->canceled = !$this->workshop->canceled;
        $this->workshop->save();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar Status geändert!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
    }

    public function render()
    {
        $this->clients = $this->workshop->clients;
        $this->staff = $this->workshop->staff;
        $clientResults = [];
        $clientResults['staff'] = [];
        $clientResults['clients'] = [];
        if ($this->addClientLastName !== '' && strlen($this->addClientLastName) >= 3){
            $searchTermFirstName = '%';
            $searchTermLastName = '%'. $this->addClientLastName. '%';
            if ($this->addClientFirstName !== ''){
                $searchTermFirstName  = '%'. $this->addClientFirstName. '%';
            }
            $clientResults['staff'] = Staff::with('company')
                ->where('last_name', 'LIKE', $searchTermLastName)
                ->where('first_name' , 'like', $searchTermFirstName)
                ->orderBy('first_name', 'asc')
                ->get();
            $clientResults['clients'] = Client::with('company')
                ->where('last_name', 'LIKE', $searchTermLastName)
                ->where('first_name' , 'like', $searchTermFirstName)
                ->orderBy('first_name', 'asc')
                ->get();
        }

        return view('livewire.workshops.edit-workshop', compact('clientResults'));
    }
}
