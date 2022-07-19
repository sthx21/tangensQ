<?php

namespace App\Http\Livewire\Staff;

use App\Models\Activity;
use App\Models\Attachment;
use App\Models\CanceledWorkshop;
use App\Models\Client;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShowStaff extends Component
{
   public $client;
   public $activity;
    public $workshopFilter = 'all';
    public $sort = 'title';
    public $direction = 1;
    public $active;


    protected $listeners = ['refreshStaff' => '$refresh'];


    protected $rules = [
        'staff.active'            => '',
        'staff.inactive_date'     => 'date',
        'activity.title'            => '',
        'activity.description'      => ''

    ];

    public function mount(Staff $staff)
    {
      $this->staff = $staff;
      $this->activities = Activity::where('staff_id', $staff->id)->with('user')->latest()->get();
        $this->attachments = $staff->attachments->sortByDesc('created_at');


    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [

    ];

    public function toggleActive()
    {
        $this->staff->active = !$this->staff->active;
        if ($this->staff->active){
            $this->staff->inactive_date = '';
        }
        $this->staff->save();

    }
    public function setInactiveDate()
    {
        $this->staff->save();
    }
    public function toggleNewsletter()
    {
        $tempStaff = $this->staff;
        $tempStaff->newsletter = !$tempStaff->newsletter;
        $tempStaff->save();
        $this->staff = $tempStaff;
    }

    public function addActivity()
    {
        $clientId = null;
        $client = Client::whereEmail($this->staff->email)->first();
        if ($client){
            $clientId = $client->id;
        }

        $activity = new Activity();
        $activity->title = '';
        $activity->user_id = \Auth::id();
        $activity->description = $this->activity['description'];
        $activity->staff_id = $this->staff->id;
        $activity->client_id = $clientId;
        $activity->company_id = $this->staff->company_id;
        $activity->save();
        $this->activities->prepend($activity);
        $this->emit('refreshStaff');
        $this->activity = '';
    }
    public function removeActivity($id)
    {
        $activity = Activity::whereId($id)->first();
        $activity->destroy($id);
        $this->acttivities = Activity::where('staff_id', $this->staff->id)->with('user')->latest()->get();
        $this->emit('refreshStaff');
    }
    public function getWorkshops($filter):void
    {
        $today = Carbon::today();
        $this->workshopFilter = $filter;
        $workshops = [];

        switch ($filter){
            case('all'):
                foreach ($this->staff->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    $workshops[] = $workshop;
                }
                break;
                case('history'):
                foreach ($this->staff->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date < $today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
            case('future'):
                foreach ($this->staff->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date >= $today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
            case('canceled'):
                $canceledWorkshops = CanceledWorkshop::where('staff_id', $this->staff->id)->get('workshop_id');
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
        $this->emit('canceledByStaff', $toCancel['id'], $this->staff->id, $reason);
        $this->emit('refreshStaff');
        $this->getWorkshops($this->workshopFilter);
    }
    public function workshopReactivation($toReactivate)
    {
        $reason = 'Leer';
        $this->emit('reactivateCancelByStaff', $toReactivate['id'], $this->staff->id, $reason);
        $this->emit('refreshStaff');
        $this->getWorkshops($this->workshopFilter);
    }
    public function editStaff($staff)
    {
        $this->redirect('/staff/'.$staff['slug'].'/edit');
    }
    public function backToStaff()
    {
        $this->redirect('/staff');
    }
    public function render()
    {

        $this->getWorkshops($this->workshopFilter);
        return view('livewire.staff.show-staff');
    }
}
