<?php

namespace App\Http\Livewire\Workshops;

use App\Models\CanceledWorkshop;
use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use App\Models\Trainer;
use App\Models\Workshop;
use Livewire\Component;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ReactivateWorkshop extends Component
{



    protected $listeners = ['reactivateCancelByTrainer', 'reactivateCancelByClient', 'reactivateCancelByCompany'];


    protected $rules = [


    ];

    public function mount()
    {

    }

    protected $messages = [
        'invoice_recipient.title.required' => 'Es muss eine Anrede gewählt werden.',

    ];

    public function reactivateCancelByTrainer( $workshopId, $trainerId, $reason)
    {
        $trainer = Trainer::where('id',$trainerId)->with('workshops')->firstOrFail();

        $trainer->workshops()->attach($workshopId);

        $trainerCanceled = CanceledWorkshop::where('workshop_id',$workshopId)->where('trainer_id', $trainerId)->firstOrFail();
        $trainerCanceled->delete();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Trainer wieder zum Workshop hinzugefügt.',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emit('refreshTrainer');
    }
    public function reactivateCancelByClient($workshopId, $clientId, $reason)
    {
        $client = Client::where('id',$clientId)->with('workshops')->firstOrFail();
        $client->workshops()->attach($workshopId);
        $clientCanceled = CanceledWorkshop::where('workshop_id',$workshopId)->where('client_id', $clientId)->firstOrFail();
        $clientCanceled->delete();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Teilnehmer aus Seminar entfernt.',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
        $this->emit('refreshClient');
    }
    public function reactivateCancelByCompany( $workshopId, $companyId, $reason)
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
