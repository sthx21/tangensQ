<?php

namespace App\Http\Livewire\Offers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Trainer;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Staff;

class EditOffer extends Component
{
    public $offer;
    public $recipient;
    public $addPerson;
    public $addedClients;
    public $addedStaff;
    public $selectCompany =  '';
    public $selectClient  =  '';
    public $recipientName =  '';
    public $discount;
    public $groupDiscount;
    public $companyDiscount;
    public $highestDiscount;
    public $newEvent = false;
    public $events = [];
    public $total;
    public $updater;


    protected $rules = [

        'offer.title'                                   =>  '',
        'offer.about'                                   =>  '',
        'offer.discount'                                =>  '',
        'offer.offer_date'                              =>  '',
        'offer.confirmation_date'                       =>  '',
        'offer.target_date'                             =>  '',
        'offer.due_date'                             =>  '',
        'offer.valid_until'                             =>  '',
        'offer.amount'                                  =>  '',
        'offer.status'                                  =>  '',
        'offer.offer_number'                            =>  '',
        'offer.type'                                    =>  '',
        'offer.clientMembers'                           => '',
        'companyDiscount'                               =>  '',
        'groupDiscount'                                 =>  '',
        'highestDiscount'                               =>  '',
        'author.first_name'                             =>  '',
        'events.*.first_trainer' => '',
        'events.*.second_trainer' => '',
        'events.*.start_date'    => '',
        'events.*.end_date'      => '',
        'events.*.start_time'    => '',
        'events.*.end_time'      => '',
        'events.*.location'      => '',

    ];

    public function mount($slug)
    {
        $this->offer = Offer::where('slug', $slug)->with('companies')->first();
        $this->company = $this->offer->companies->first();
        $this->events = $this->offer->events ?? [];
        $this->trainers = Trainer::all();
        $this->total = $this->offer->amount/100*(100-$this->offer->discount);

        $this->recipientName = $this->company->name ?? '';

        $this->author = $this->offer->user;
        $this->type = $this->offer->type;
        $this->types = [
            'Flatrate'                  => 'Flatrate',
            'Paket'                     => 'Paket',
            'Rahmenvereinbarung'        => 'Rahmenvereinbarung',
            'Inhouse'                   => 'Inhouse',
            'Seminar'                   => 'Seminar',
            'Webex'                     => 'Webex',
        ];
        $this->status = [
            'open'                      => 'open',
            '25'                        => '25',
            '50'                        => '50',
            '75'                        => '75',
            'won'                       => 'won',
            'lost'                      => 'lost',
        ];
    }
    public function updated($name, $value)
    {

        $this->validateOnly($name);
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
    public function addClient($type, $id)
    {
        if ($type === 'staff'){
            $staff = Staff::whereId($id)->first();
            $this->addedStaff->prepend($staff);
        }
        if ($type === 'client'){
            $client = Client::whereId($id)->first();
            $updatedClients = $this->offer->clientMembers;
            $updatedClients[] = $client->toArray();
            $this->offer->clientMembers = $updatedClients;
        }
        $this->selectClient = '';
    }
    public function removeClient($type, $key)
    {
        if ($type === 'staff'){
            $staff = $this->offer->staffMembers;
            unset($staff[$key]);
            $this->offer->staffMembers = $staff;
                }


        if ($type === 'client'){
            $clients = $this->offer->clientMembers;
            unset($clients[$key]);
            $this->offer->clientMembers = $clients;
        }
    }
    public function addEvent(): void
    {
        $this->newEvent = true;
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
    public function updating($name, $value)

    {
        $this->updater = $value;
        //

    }
    public function update()
    {
//        dd($this->updater);
        if ($this->offer->status !== 'won'){
            $this->offer->events = $this->events;
            $this->offer->save();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Angebot gespeichert!',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right'
            ]);
            $this->redirect('/Angebote');
        }
        if ($this->offer->status === 'won'){
            $this->offer->confirmation_date = Carbon::today();
            $this->offer->save();
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Glückwunsch!',
                'timer'=>3000,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'center'
            ]);
            $this->redirect('/Angebote');
        }
    }

    public function render()
    {

        $peopleResults = collect();
        $peopleResults->staff = collect();
        $peopleResults->clients = collect();
        if ($this->selectClient !== ''&& strlen($this->selectClient) >= 3){
            $searchTerm = '%'. $this->selectClient. '%';
            $staff = Staff::where('company_id', '=', $this->company->id)
                ->where('last_name', 'LIKE', $searchTerm)
                ->orWhere('first_name', 'LIKE', $searchTerm)
                ->get();
            $clients = Client::where('company_id', '=', $this->company->id)
                ->where('last_name', 'LIKE', $searchTerm)
                ->orWhere('first_name', 'LIKE', $searchTerm)
                ->get();
            $peopleResults->staff = $staff;
            $peopleResults->clients = $clients;
        }

        if ($this->offer->companies->first() && $this->offer->companies->first()->discount){
            $this->companyDiscount = $this->offer->companies->first()->discount;
            $this->highestDiscount = max(
                $this->companyDiscount,
                $this->offer->discount);
        }
        if ($this->offer->companies->first() && $this->offer->companies->first()->group){
            $this->groupDiscount = $this->offer->companies->first()->group[0]['discount'] ?? 0;
            $this->highestDiscount = max(
                $this->companyDiscount,
                $this->groupDiscount);
        }
        return view('livewire.offers.edit-offer', compact( 'peopleResults'));
    }
}
