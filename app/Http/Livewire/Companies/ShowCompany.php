<?php

namespace App\Http\Livewire\Companies;

use App\Models\Activity;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Workshop;
use Carbon\Carbon;

use Livewire\Component;

class ShowCompany extends Component
{
//   public Company $company;
   public $staff;
   public $activity;
//   public $activities;
    public $active = [];
    public $history = [];

    protected $listeners = ['refreshCompany' => '$refresh'];


    protected $rules = [
        'staff.*.active'            => '',
        'staff.*.inactive_date'     => 'date',
//        'staff.*.newsletter'        => 'boolean',
        'activity.title'            => '',
        'activity.description'      => ''

    ];

    public function mount(Company $company)
    {
        $this->company = $company;
//        dd($company);

      $this->companyGroup = $this->company->group->first();
      if ($this->companyGroup){
          $this->companyGroup->discount_until = Carbon::create($this->companyGroup->discount_until);
      }
      if ($this->company->discount_until){
          $this->company->discount_until = Carbon::create($this->company->discount_until);
      }
      $this->staff = $this->company->staff;
      $this->allActivities = Activity::where('company_id', $company->id)
          ->with('user')
          ->with('staff')
          ->latest()
          ->get();
      $this->activities = $this->allActivities->take(5);
        $this->clients = $this->company->clients;

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $messages = [

    ];

    public function toggleActive($key)
    {
        $tempStaff = $this->staff[$key];
        $tempStaff->active = !$tempStaff->active;
        $tempStaff->save();
        $this->staff[$key] = $tempStaff;


    }
    public function toggleNewsletter($key)
    {
        $tempStaff = $this->staff[$key];
        $tempStaff->newsletter = !$tempStaff->newsletter;
        $tempStaff->save();
        $this->staff[$key] = $tempStaff;
    }
    public function setInactiveDate($key)
    {
        $tempStaff = $this->staff[$key];
        $tempStaff->save();
    }

    public function addActivity()
    {
        $activity = new Activity();
        $activity->title = '';
        $activity->user_id = \Auth::id();
        $activity->description = $this->activity['description'];
        $activity->company_id = $this->company->id;
        $activity->save();
        $this->activities->prepend($activity);
        $this->activity = '';
    }
    public function removeActivity($id)
    {
        $activity = Activity::whereId($id)->first();
        $activity->destroy($id);
        $this->acttivities = Activity::where('company_id', $this->company->id)->with('user')->latest()->get();
        $this->emit('refreshCompany');
    }
    public function getWorkshopHistory():void
    {
        $activeWorkshops = [];
        $workshopHistory = [];

        foreach ($this->clients as $client){
            foreach ($client->workshops as $workshop){
                if ($workshop->start_date > Carbon::today()){
                    $activeWorkshops[] = $workshop;
                }
                else{
                    $workshopHistory[] = $workshop;
                }
            }
        }
        $this->active = collect($activeWorkshops);
        $this->history = collect($workshopHistory);
    }


    public function editCompany($company)
    {
        $this->redirect('/companies/'.$company['slug'].'/edit');


    }
    public function backToCompanies()
    {
        $this->redirect('/companies');
    }
    public function render()
    {
//        if ($this->companyGroup){
//            $this->companyGroup->discount_until = Carbon::create($this->companyGroup->discount_until);
//        }
//        if ($this->company->discount_until){
//            $this->company->discount_until = Carbon::create($this->company->discount_until);
//        }
//        $this->getWorkshopHistory();
        return view('livewire.companies.show-company');
    }
}
