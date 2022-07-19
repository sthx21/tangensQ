<?php

namespace App\Http\Livewire\Clients;

use App\Models\Activity;
use App\Models\CanceledWorkshop;
use App\Models\Client;

use App\Models\Workshop;
use Carbon\Carbon;
use Livewire\Component;

class ShowClient extends Component
{
   public $client;
   public $activity;
    public $workshopFilter = 'all';
    public $sort = 'title';
    public $direction = 1;
    public $active;


    protected $listeners = ['refreshClient' => '$refresh'];


    protected $rules = [
        'client.active'            => '',
        'client.inactive_date'     => 'date',
        'activity.title'            => '',
        'activity.description'      => ''

    ];

    public function mount($slug)
    {
      $this->client = Client::whereSlug($slug)->with('company')->first();
      $this->activities = Activity::where('client_id', $this->client->id)->with('user')->latest()->get();



    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [

    ];

    public function toggleActive()
    {
        $this->client->active = !$this->client->active;
        if ($this->client->active){
            $this->client->inactive_date = '';
        }
        $this->client->save();

    }
    public function setInactiveDate()
    {
        $this->client->save();
    }
    public function toggleNewsletter()
    {
        $tempStaff = $this->staff[$key];
        $tempStaff->newsletter = !$tempStaff->newsletter;
        $tempStaff->save();
        $this->staff[$key] = $tempStaff;
    }

    public function addActivity()
    {
        $activity = new Activity();
        $activity->title = '';
        $activity->user_id = \Auth::id();
        $activity->description = $this->activity['description'];
        $activity->client_id = $this->client->id;
        $activity->save();
        $this->activities->prepend($activity);
        $this->emit('refreshClient');
        $this->activity = '';
    }
//TODO REFACTOR
    public function getWorkshops($filter):void
    {
        $today = Carbon::today();
        $this->workshopFilter = $filter;
        $workshops = [];
        $allCanceledWorkshops = [];

        switch ($filter){
            case('all'):
                foreach ($this->client->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    $workshops[] = $workshop;
                }
                $canceledWorkshops = CanceledWorkshop::where('client_id', $this->client->id)->get('workshop_id');

                foreach ($canceledWorkshops as $canceledWorkshop){
                    $cWorkshop = Workshop::with('clients')->where('id', $canceledWorkshop->workshop_id)->firstOrFail();
                    $dt = Carbon::parse($cWorkshop->start_date);
                    $cWorkshop->start_date = $dt;
                    $cWorkshop->tn_canceled  = 'TN  STORNO';
                    $allCanceledWorkshops [] = $cWorkshop;
                }
                break;
                case('history'):
                foreach ($this->client->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date < $today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
            case('future'):
                foreach ($this->client->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date >= $today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
            case('canceled'):
                $canceledWorkshops = CanceledWorkshop::where('client_id', $this->client->id)->get('workshop_id');
                foreach ($canceledWorkshops as $canceledWorkshop){
                    $workshop = Workshop::with('clients')->where('id', $canceledWorkshop->workshop_id)->firstOrFail();
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    $workshop->tn_canceled  = 'TN  STORNO';
                    $workshops[] = $workshop;
                }
                break;
            default:
        }
        $this->workshops = collect($workshops)->all();
        $this->allCanceledWorkshops = $allCanceledWorkshops;
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
    public function editClient($client)
    {
        $this->redirect('/clients/'.$client['slug'].'/edit');
    }
    public function backToClients()
    {
        $this->redirect('/clients');
    }
    public function render()
    {

        $this->getWorkshops($this->workshopFilter);
        return view('livewire.clients.show-client');
    }
}
