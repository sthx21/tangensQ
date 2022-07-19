<?php

namespace App\Http\Livewire\Staff;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Models\Activity;
use App\Models\CanceledWorkshop;
use App\Models\Client;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Workshop;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\WithFileUploads;

class EditStaff extends Component
{
    use WithFileUploads;
    public $addedTags;
    public $activity;
    public $addTag = '';
    public $staff;
    public $search;
    public $addCompany = '';
    public $addedCompany;
    public $workshopFilter = 'future';
    public $newLogo;
    public $sort = 'title';
    public $direction = 1;

    const STRNULL   = 'string|nullable';
    const EMLNULL   = 'email|nullable';
    const REQSTR    = 'required|string';

    public array $titles = [
        'Herr'                      => 'Herr',
        'Frau'                      => 'Frau',
        'Divers'                    => 'Divers'
    ];


    protected $listeners = ['addTag', 'createTag','refreshStaff' => '$refresh'];


    protected $rules = [

        'addedTags'                                      => '',
        'addTag'                                         => '',
        'newLogo'                                        => '',
        'staff.title'                                   => self::REQSTR,
        'staff.first_name'                              => self::STRNULL,
        'staff.last_name'                               => self::REQSTR,
        'staff.email'                                   => self::EMLNULL,
        'staff.phone'                                   => self::STRNULL,
        'staff.second_email'                            => self::EMLNULL,
        'staff.second_phone'                            => self::STRNULL,
        'staff.info'                                    => self::STRNULL,
        'staff.street'                                  => self::STRNULL,
        'staff.house_number'                            => self::STRNULL,
        'staff.additional_address'                      => self::STRNULL,
        'staff.zip'                                     => self::STRNULL,
        'staff.city'                                    => self::STRNULL,
        'staff.homepage'                                => self::STRNULL,
        'staff.fax_number'                              => self::STRNULL,
        'staff.company_id'                              => 'int|nullable',
        'staff.inactive_date'                           => 'nullable',
    ];

    public function mount(Staff $staff)
    {
        $this->activities = Activity::where('staff_id', $staff->id)->with('user')->latest()->get();
        $this->staff = $staff;
        $this->tags = $staff->tags;
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
        $this->staff->tags()->attach($tag['id']);
        $this->reset('addTag');
        $this->emit('refreshStaff');
}
    public function createTag()
    {
        $newTag = Tag::create(['name' => $this->addTag]);
        $this->staff->tags()->attach($newTag->id);
        $this->reset('addTag');
        $this->emit('refreshStaff');

    }
    public function removeTag($id)
    {
        $this->staff->tags()->detach($id);
        $this->emit('refreshStaff');

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
    public function setLogo($id)
    {
        $path = Storage::path('tmpLogos');
        $fileName = SlugService::createSlug(Staff::class, 'slug', $this->staff['first_name'].'_'.$this->staff['last_name']).'.jpg';
        $this->newLogo[0]->storeAs('tmpLogos', $fileName);
        $fullPath = $path.'/'.$fileName;
        $setLogo = new StaffController();
        $setLogo->storeLogo($id, $fullPath);
    }
    public function transferLogoToClient($id)
    {

        $setLogo = new ClientController();
        $setLogo->transferLogo($id, $this->staff->getFirstMediaUrl('staffLogo'));
    }
    public function update()
    {
        $this->validate();
        $this->staff->save();

        if ($this->newLogo){
            $this->setLogo($this->staff->id);
        }
        $this->emit('refreshStaff');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'HR Mitarbeiter bearbeitet!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->backToStaff();
   }
    public function destroy()
    {
        $this->staff->save();
        $this->staff->destroy($this->staff->id);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'HR erfolgreich gelöscht!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->redirect(route('staff'));
    }
    public function confirmTransferToClients()
    {
        $this->dispatchBrowserEvent('confirmTransfer', [
            'title' => 'HR wird zum TN..',
            'timer'=>3000,
            'icon'=>'warning',
            'toast'=>true,
            'position'=>'center'
        ]);
   }
    public function transferToClients()
    {
        $checkIfClientExists = Client::whereEmail($this->staff->email);
        if ($checkIfClientExists){
            $this->dispatchBrowserEvent('swal', [
                'title' => 'HR Mitarbeiter bereits TN!',
                'timer'=>3000,
                'icon'=>'warning',
                'toast'=>true,
                'position'=>'center'
            ]);
            return;
        }
        $staffToClient = new Client($this->staff->toArray());
        $staffToClient->save();
        $staffToClient->tags()->attach($this->staff->tags()->get());
//        $this->transferLogoToClient($staffToClient->id);

        //TODO Transfer Workshops and Activities
        $this->dispatchBrowserEvent('swal', [
            'title' => 'HR Mitarbeiter erfolgreich zu TN transferiert..!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
   }
    public function backToStaff()
    {
        $this->redirect(route('staff'));
    }

    public function toggleActive()
    {
        $this->staff->active = !$this->staff->active;

        if ($this->staff->active){
            $this->staff->inactive_date = '';
        }
        $this->staff->save();
    }
    public function getWorkshops($filter):void
    {
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
                foreach ($this->staff->workshops as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date < $this->today) {
                        $workshops[] = $workshop;
                    }
                }
                break;
                case('future'):
                foreach ($this->staff->workshops->sortBy($this->sort, SORT_NATURAL, $this->direction) as $workshop) {
                    $dt = Carbon::parse($workshop->start_date);
                    $workshop->start_date = $dt;
                    if ($workshop->start_date > $this->today) {
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


        return view('livewire.staff.edit-staff', compact('results', 'companies'));
    }
}
