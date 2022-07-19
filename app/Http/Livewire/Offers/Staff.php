<?php

namespace App\Http\Livewire\Offers;


use App\Models\Client;
use App\Models\Company;
use Livewire\Component;
use App\Models\Staff as StaffMember;

class Staff extends Component
{


    public $searchStaff = '';
    public $companyId = '';
    public $selectedStaff;

    protected $listeners = ['resetSearch', 'setCompanyId'];

    public function setCompanyId($id)
    {
        $this->companyId = $id;
    }
    public function resetSearch()
    {
        $this->searchStaff = '';
    }

    public function selectClient($client)
    {
        $this->selectedStaff  = $client;
        $this->emit('setClient', $client);
        $this->emit('resetSearch');


    }
    public function render()
    {
            $results = collect();
            $searchTerm = '%'. $this->searchStaff. '%';

            $clients = StaffMember::where('company_id', $this->companyId)
                ->where('last_name', 'LIKE', $searchTerm)
//                ->orWhere('first_name', 'LIKE', $searchTerm)
                ->get();
            $results->clients = collect($clients);


        return view('livewire.offers.staff', compact('results'));
    }
}
