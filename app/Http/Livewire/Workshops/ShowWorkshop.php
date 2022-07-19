<?php

namespace App\Http\Livewire\Workshops;


use App\Models\Activity;
use App\Models\Workshop;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ShowWorkshop extends Component
{
use WithPagination;
    public $staff;
    public $activity;

    protected $listeners = ['changeStatus', 'workshopRefresh' => '$refresh'];

    protected $rules = [

       'status'             => '',


    ];

    public function mount(Workshop $workshop)
    {
        $this->today = Carbon::today();
        $this->workshop = $workshop;
        $this->activities = Activity::where('workshop_id', $workshop->id)->with('user')->latest()->get();
        $this->status = [
            'Reserviert'    => 'Reserviert',
            'Gebucht'    => 'Gebucht',
            'Storno'    => 'Storno',
        ];

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function setStatus()
    {
        $this->workshop->canceled = !$this->workshop->canceled;
        $this->workshop->save();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Seminar Status geändert!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right'
        ]);
    }
    public function editWorkshop($workshop)
    {
        $this->redirect('/workshops/'.$workshop['slug'].'/edit');
    }
    public function backToWorkshops()
    {
        $this->redirect(route('workshops'));
    }
    public function changeStatus($client, $changedStatus)
    {
        if ($changedStatus === 'Storno'){
            $this->confirmClientRemoval($client);
        }
        $this->workshop->clients()->updateExistingPivot($client['id'], ['status' => $changedStatus]);
        $this->emit('workshopRefresh');

    }
    public function confirmClientRemoval($client)
    {
        $this->dispatchBrowserEvent('confirmClientRemove', [
            'title' => 'Teilnehmer '.$client['last_name'].', '.$client['first_name'].' entfernen?',
            'timer'=>3000,
            'id' => $client['id'],
            'icon'=>'warning',
            'toast'=>true,
            'position'=>'top-right'
        ]);

    }
    public function removeClient($id)
    {
        $this->workshop->clients()->detach($id);
        $reason = 'Leer';
        $this->emit('canceledByClient', $this->workshop->id, $id, $reason);
        $this->emit('refreshStaff');
        $this->emit('refreshWorkshop');
    }
    public function render()
    {
        $this->workshop->linked = Workshop::whereIn('id', $this->workshop->series)->get();

        return view('livewire.workshops.show-workshop');
    }
}
