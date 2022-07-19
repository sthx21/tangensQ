<?php

namespace App\Http\Livewire\Events;

use App\Models\Client;
use App\Models\Company;
use App\Models\Event;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Carbon\Carbon;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CreateEvent extends Component
{
    public $event;
    public $attributes;

    protected $listeners = ['createEventFromOffer', 'createEventFromWorkshop'];


    protected $rules = [

        'event.title'                                     => 'required|string',
        'event.start'                                => 'string',
        'event.end'                                 => 'required|string',
        'event.first_trainer'                                     => 'string',
        'event.location'                                      => 'unique:trainers|email',
        'event.second_trainer'                              => 'string',
        'event.company_id'                                      => 'string',
        'event.offer_id'                                    => 'string',
    ];

    public function mount()
    {
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

    public function createEventFromOffer($attributes, $company)
    {
        foreach ($attributes['events'] as $event){
            $secondTrainer = Trainer::whereId($event['second_trainer'])->first();
            $firstTrainer = Trainer::whereId($event['first_trainer'])->first();
            $newEvent = new Event();
            $newEvent->offer_number = $attributes['offer_number'] ?? 999;
            $newEvent->title  =  $attributes['title'];
            $newEvent->type = $attributes['type'];
            $newEvent->start = Carbon::create($event['start_date'])->setTimeFromTimeString($event['start_time']);
            $newEvent->end = Carbon::create($event['end_date'])->setTimeFromTimeString($event['end_time']) ?: null;
            $newEvent->user_id = \Auth::id();
            $newEvent->company = $company['name'] ?? 1;
            $newEvent->location = $event['location'] ?? '';

            if ($newEvent->start === $newEvent->end){
                $event['allDay'] = 1;
            }
            $newEvent->allDay = $event['allDay'] ?? 0;
            $newEvent->groupId = $event['groupId'] ?? 1;
            $newEvent->first_trainer_name = $firstTrainer->last_name ?? '';
            $newEvent->second_trainer_name = $secondTrainer->last_name ?? '';
            $newEvent->save();

            $trainerIds = [$firstTrainer->id, $secondTrainer->id];
            $newEvent->trainers()->attach($trainerIds);
            $newEvent->companies()->attach($company['id']);
        }
    }
    public function createEventFromWorkshop($workshop, $trainers)
    {
            $firstTrainer = $trainers[0]['last_name'] ?? '';
            $secondTrainer = $trainers[1]['last_name'] ?? '';

            $newEvent = new Event();
            $newEvent->title = $workshop['title'].' im '.$workshop['location'];
            $newEvent->type = 'workshop';
            $newEvent->start = Carbon::create($workshop['start_date'])->setTimeFromTimeString($workshop['start_time']);
            $newEvent->end = Carbon::create($workshop['end_date'])->setTimeFromTimeString($workshop['end_time']) ?: null;
            $newEvent->user_id = \Auth::id();
            $newEvent->location = $workshop['location'] ?? '';

            if ($newEvent->start === $newEvent->end){
                $workshop['allDay'] = 1;
            }
            $newEvent->allDay = $workshop['allDay'] ?? 0;
            $newEvent->groupId = $workshop['groupId'] ?? 1;
            $newEvent->first_trainer_name = $firstTrainer;
            $newEvent->second_trainer_name = $secondTrainer;
            $newEvent->save();

            $newEvent->trainers()->attach($trainers);

    }
    public function store()
    {
        $this->event->save();


        $this->dispatchBrowserEvent('swal', [
            'title' => 'Event erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/Angebote');
   }

    public function render()
    {


        return view('empty');
    }
}
