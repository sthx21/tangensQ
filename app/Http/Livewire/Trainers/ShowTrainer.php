<?php

namespace App\Http\Livewire\Trainers;

use App\Models\Activity;
use App\Models\CanceledWorkshop;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShowTrainer extends Component
{
   public $trainer;
   public $staff;
   public $activity;
    public $workshopFilter = 'future';
    public $sort = 'title';
    public $direction = 1;


    protected $listeners = ['refreshTrainer' => '$refresh'];


    protected $rules = [
        'activity.title'            => '',
        'activity.description'      => '',
         'trainer.inactive_date'                              => 'nullable',

    ];

    public function mount(Trainer $trainer)
    {
      $this->trainer = $trainer;
      $this->activities = Activity::where('trainer_id', $trainer->id)->with('user')->latest()->get();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [

    ];

    public function toggleActive()
    {
        $this->trainer->active = !$this->trainer->active;

        if ($this->trainer->active){
            $this->trainer->inactive_date = '';
        }
        $this->trainer->save();
    }

    public function setInactiveDate()
    {
        $this->trainer->save();
    }
    public function toggleNewsletter($key)
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
        $activity->trainer_id = $this->trainer->id;
        $activity->save();
        $this->activities->prepend($activity);
        $this->emit('refreshTrainer');
        $this->activity = '';
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
    public function editTrainer($trainer)
    {
        $this->redirect('/trainers/'.$trainer['slug'].'/edit');
    }
    public function backToTrainers()
    {
        $this->redirect('/trainers');
    }
    public function render()
    {
        $this->today = Carbon::today();
        $this->getWorkshops($this->workshopFilter);
        return view('livewire.trainers.show-trainer');
    }
}
