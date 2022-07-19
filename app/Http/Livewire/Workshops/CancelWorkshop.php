<?php

namespace App\Http\Livewire\Workshops;

use App\Models\Staff;
use App\Models\CanceledWorkshop;
use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CancelWorkshop extends Component
{



    protected $listeners = ['canceledByTrainer', 'canceledByStaff',  'canceledByClient', 'canceledByCompany'];


    protected $rules = [


    ];

    public function mount()
    {
        $addedTags = collect();
        $this->addedTags = $addedTags;
    }

    protected $messages = [
        'invoice_recipient.title.required' => 'Es muss eine Anrede gewählt werden.',

    ];

    public function canceledByTrainer( $workshopId, $trainerId, $reason)
    {
        $trainer = Trainer::where('id',$trainerId)->with('workshops')->firstOrFail();

        $trainer->workshops()->detach($workshopId);

        $trainerCanceled = new CanceledWorkshop([
            'name'              => '',
            'trainer_id'        => $trainer->id,
            'workshop_id'       => $workshopId,
            'reason'            => $reason
        ]);
        $trainerCanceled->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Trainer aus Seminar entfernt.',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emit('refreshTrainer');
    }
    public function canceledByClient($workshopId, $clientId, $reason)
    {
        $client = Client::where('id',$clientId)->with('workshops')->firstOrFail();
        $client->workshops()->detach($workshopId);
        $clientCanceled = new CanceledWorkshop([
            'name'              => '',
            'client_id'        => $client->id,
            'workshop_id'       => $workshopId,
            'reason'            => $reason
        ]);
        $clientCanceled->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Teilnehmer aus Seminar entfernt.',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emit('refreshClient');
    }
    public function canceledByStaff($workshopId, $staffId, $reason)
    {
        $staff = Staff::where('id',$staffId)->with('workshops')->firstOrFail();
        $staff->workshops()->detach($workshopId);
        $staffCanceled = new CanceledWorkshop([
            'name'              => '',
            'staff_id'        => $staff->id,
            'workshop_id'       => $workshopId,
            'reason'            => $reason
        ]);
        $staffCanceled->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Teilnehmer aus Seminar entfernt.',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emit('refreshStaff');
    }
    public function canceledByCompany( $workshopId, $companyId, $reason)
    {
        $company = Company::where('id',$companyId)->with('workshops')->firstOrFail();
        $company->workshops()->detach($workshopId);

        $companyCanceled = new CanceledWorkshop([
            'name'              => '',
            'company_id'        => $company->id,
            'workshop_id'       => $workshopId,
            'reason'            => $reason
        ]);
        $companyCanceled->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar storniert.',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emit('refreshCompany');
    }

    public function render()
    {


        return view('empty');
    }
}
