<?php

namespace App\Http\Livewire\Offers;

use App\Models\Activity;
use App\Models\Reminder;
use App\Models\Staff;
use App\Models\Client;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Trainer;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent as Component;

class CreateOffer extends Component
{
    public $newOffer;
    public $recipient;
    public $addCompany;
    public $addPerson;
    public $addedClients;
    public $addedStaff;
    public $selectCompany =  '';
    public $selectClient =  '';
    public $recipientName = 'Bitte wählen..';
    public $discount;
    public $groupDiscount;
    public $companyDiscount;
    public $highestDiscount;
    public $events = [];



    protected $listeners = [];

    protected $rules = [

        'newOffer.title'                                 =>  'required|min:3',
        'newOffer.valid_until'                        =>  '',
        'newOffer.target_date'                        =>  '',
        'newOffer.due_date'                        =>  '',
        'newOffer.amount'                        =>  '',
        'newOffer.about'                        =>  '',
        'newOffer.discount'                     => '',
        'groupDiscount'                        =>  '',
        'companyDiscount'                        =>  '',
        'highestDiscount'                      => '',
        'newOffer.positions'                        =>  '',
        'newOffer.events'                        =>  '',
        'newOffer.type'                        =>  '',
        'selectCompany'                         => '',
        'recipient'                         => '',

        'events.*.first_trainer' => '',
        'events.*.second_trainer' => '',
        'events.*.start_date'    => '',
        'events.*.end_date'      => '',
        'events.*.start_time'    => '',
        'events.*.end_time'      => '',
        'events.*.location'      => '',


    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [
        'newOffer.title.required' => 'Gib dem Baby einen Namen....',
        'recipient.required' => 'Wähle..',
        'newOffer.title.min' => '3 Zeichen minimum.',
        'newOffer.email.email' => 'Dies ist keine gültige Email.',
        'newOffer.last_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'newOffer.last_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',
        'newOffer.first_name.required' => 'Das Feld Nachname kann nicht leer sein.',
        'newOffer.first_name.min' => 'Der Name ist zu kurz.(mind. 3 Zeichen)',


    ];

    public function mount()
    {
        $this->trainers = Trainer::all();
        $this->newOffer = collect();
        $this->addedClients = collect();
        $this->addedStaff = collect();
        $this->types = [
            'Flatrate'                  => 'Flatrate',
            'Paket'                     => 'Paket',
            'Rahmenvereinbarung'        => 'Rahmenvereinbarung',
            'Inhouse'                   => 'Inhouse',
            'Seminar'                   => 'Seminar',
            'Webex'                     => 'Webex',
        ];

    }
    public function selectCompany($companyId)
    {
        $company = Company::whereId($companyId)->with('group')->first();
        $this->recipient  = $company;
        $this->recipientName = $this->recipient->name;
        $this->recipientGroup = $this->recipient->group;
        $this->selectCompany = '';
        $this->dispatchBrowserEvent('swal', [
            'title' => $this->recipient->name.' '.'für ein Angebot ausgewählt!'.'<br>'.'TN sind jetzt nach Unternehmen gefiltert!',
            'timer'=>5000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'center'
        ]);
    }

    public function addClient($type, $id)
    {
        if ($type === 'staff'){
            $staff = Staff::whereId($id)->first();
            $this->addedStaff->prepend($staff);
        }
        if ($type === 'client'){
            $client = Client::whereId($id)->first();
            $this->addedClients->prepend($client);
        }
        $this->selectClient = '';
        $this->dispatchBrowserEvent('swal', [
            'title' => 'TN/HR hinzugefügt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);

    }

    public function removeClient($type, $id)
    {
        if ($type === 'staff'){
            $addedStaff  = $this->addedStaff;
            foreach ($addedStaff as $key => $stRemove){
                if ($stRemove['id'] === $id){
                    $addedStaff->forget($key);
                }
            }
            $this->addedStaff = $addedStaff;
        }
        if ($type === 'client'){
            $addedClients = $this->addedClients;
            foreach ($addedClients as $key => $clRemove){
                if ($clRemove['id'] === $id){
                    $addedClients->forget($key);
                }
            }            $this->addedClients = $addedClients;
        }
    }

    public function addEvent(): void
    {
        $this->events[] = [
            'first_trainer' => '',
            'second_trainer' => '',
            'location' => '',
            'start_date' => '',
            'end_date' => '',
            'start_time' => '',
            'end_time' => '',
        ];
    }
    public function removeEvent($key): void
    {
        $events = collect($this->events)->forget($key);
        $this->events = $events;
    }
    public function store()
    {
        $this->validate();
        $offer_number = 2200001;
        if (Offer::count() > 0){
            $latestOffer = Offer::latest()->firstOrFail();
           $offer_number = ++$latestOffer->offer_number;
        }
        if (!$this->discount ){
                $this->discount = $this->highestDiscount;
        }
        $offer = new Offer($this->newOffer->toArray());
        $offer->offer_number = $offer_number;
        $offer->clientMembers = $this->addedClients;
        $offer->staffMembers = $this->addedStaff;
        $offer->events =  $this->events;
        $offer->discount = $this->discount;
        $offer->user_id = \Auth::id();
        $offer->offer_date = Carbon::today();
        $offer->status = trans('accounting.labels.status_created');
        $this->createEvents($offer);
        $offer->save();

        $offer->companies()->attach($this->recipient['id']);
        $this->addActivity($offer->title, $offer->offer_number);
        $this->addReminder($offer->title, $offer->valid_until, $offer->offer_number, $offer->id);


        $this->dispatchBrowserEvent('swal', [
            'title' => 'Angebot erstellt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect('/accounting');
    }

    public function createEvents($offer)
    {

        $this->emit('createEventFromOffer', $offer, $this->recipient);


    }
    public function addActivity($title, $offerNumber)
    {
        $activity = new Activity();
        $activity->title = $title;
        $activity->user_id = \Auth::id();
        $activity->description = $offerNumber;
        $activity->company_id = $this->recipient['id'];
        $activity->save();

    }

    public function addReminder($title, $date, $offerNumber, $offerId)
    {
        $reminder  = new Reminder();
        $reminder->user_id = \Auth::id();
        $reminder->title = 'ANGEBOT: '.$offerNumber;
        $reminder->due_date = Carbon::create($date)->subWeeks(4)->format('d.m.y');
        $reminder->description = $title;
        $reminder->offer_id = $offerId;
        $reminder->save();
    }


    public function render()
    {

        if (!isset($this->newOffer->discount)){
            $this->newOffer->discount = 0;
        }
        $results = [];
        if ($this->selectCompany !== ''){
            $searchTerm = '%'. $this->selectCompany. '%';
            $results = Company::where('name', 'LIKE', $searchTerm)
                ->get();
        }

        $peopleResults = collect();
        $peopleResults->staff = collect();
        $peopleResults->clients = collect();
        if (($this->selectClient !== '' && strlen($this->selectClient) >= 3) || $this->recipient){
            $searchTerm = '%'. $this->selectClient. '%';
            $staff = Staff::where('company_id', '=', $this->recipient->id)
                ->where('last_name', 'LIKE', $searchTerm)
                ->get();
            $clients = Client::where('company_id', '=', $this->recipient->id)
                ->where('last_name', 'LIKE', $searchTerm)
                ->get();
            $peopleResults->staff = $staff;
            $peopleResults->clients = $clients;
        }

        if ($this->recipient && $this->recipient->discount){
                $this->companyDiscount = $this->recipient->discount;
                $this->highestDiscount = max(
                    $this->companyDiscount,
                    $this->newOffer->discount);
            }
        if ($this->recipient && $this->recipient->group){
            $this->groupDiscount = $this->recipient->group[0]['discount'] ?? 0;
            $this->highestDiscount = max(
                $this->companyDiscount,
                $this->groupDiscount);
        }

        return view('livewire.offers.create-offer', compact('results', 'peopleResults'));
    }
}
