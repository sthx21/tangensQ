<?php

namespace App\Http\Livewire\Offers;


use App\Models\Client;
use App\Models\Company;
use Livewire\Component;

class Companies extends Component
{

    public $search = '';

    protected $listeners = ['resetSearch'];

    public function resetSearch()
    {
        $this->search = '';
    }
    public function render()
    {
        if ($this->search !== ''){
            $results = collect();
            $searchTerm = '%'. $this->search. '%';
            $companies = Company::where('name', 'LIKE', $searchTerm)
                ->get();
            $clients = Client::where('last_name', 'LIKE', $searchTerm)
                ->orWhere('first_name', 'LIKE', $searchTerm)
                ->get();

            $results->companies = collect($companies);
            $results->clients = collect($clients);
        }
        else{
            $results = [];
        }

        return view('livewire.offers.companies', compact('results'));
    }
}
