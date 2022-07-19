<?php

namespace App\Http\Livewire\Clients;

use App\Exports\ClientsExport;
use App\Exports\ClientsNewsletterExport;
use App\Exports\CompaniesExport;
use App\Models\Client;
use App\Models\Company;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\TagFilter;

class ShowClients extends Component
{
use WithPagination;
use TagFilter;
    public $filter;
    public $clients;
    public $tagFilter;
    public $postalCodeFilter;
    public $clientIds = [];
    public $sort = 'id';
    public $direction = 'asc';
    public $paginateNo = 22;
    public $filtered;
    public $newsletterFilter = false;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p' ],
        'filter' => ['except' => '', 'as' => 'f' ]
    ];



    protected $listeners = ['addTag', 'createTag', 'nextPage'];

    protected $rules = [
        'filter'                => ''
    ];

    public function mount()
    {
//        dd($this);
        $tagIds = [];
        $tags = DB::table('client_tag')->get('tag_id');
        foreach ($tags as $tag){
            $tagIds[] = $tag->tag_id;
        }
        $this->assignedTags = Tag::findMany($tagIds);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showClient($client)
    {
        $this->redirect('clients/'.$client['slug']);
    }
    public function editClient($client)
    {
        $this->redirect('clients/'.$client['slug'].'/edit');
    }


    public function paginationPage($page)
    {
        $this->paginators = ['page' => $page];
    }
    public function previousPage()
    {
        $page = $this->page-1;
        $this->paginationPage($page);
    }
    public function nextPage()
    {
        if ($this->page)
        $page = $this->page+1;
        $this->paginationPage($page);
    }

    public function setTagFilter($tag)
    {
        $this->clientIds = [];
        $this->tagFilter = $tag;
        $this->filterByTag = DB::table('client_tag')
            ->where('tag_id', $this->tagFilter['id'])
            ->get('client_id');
        foreach ($this->filterByTag as $client){
            $this->clientIds[] = $client->client_id;
        }
        $this->paginators = ['page' => 1];
    }
    public function unsetTagFilter()
    {
        $this->tagFilter = null;
        $this->filter = '';
        $this->tagFilterClients = null;

    }

    public function filterByFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Client::where('last_name', 'like', $searchTerm)
            ->orWhere('first_name', 'LIKE', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function filterByTag()
    {
        return Client::whereIn('id', $this->clientIds)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function filterByTagAndFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Client::whereIn('id', $this->clientIds)
            ->where('last_name', 'like', $searchTerm)
            ->orWhere('first_name', 'LIKE', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function filterByPostalCode()
    {
        $searchTerm = '%' . $this->postalCodeFilter . '%';
        return Client::where('zip', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function sorting($sort)
    {
        if ($this->sort === $sort){
            if($this->direction === 'asc'){
                $this->direction = 'desc';
            }
            else{
                $this->direction = 'asc';
            }
        }
        $this->sort = $sort;
    }

    public function exportToExcel()
    {
        if ($this->newsletterFilter){
            $export = new ClientsNewsletterExport([
                $this->filtered['data']
            ]);

            return Excel::download($export, 'Export_Teilnehmer.xlsx');
        }
        if (!$this->newsletterFilter){
            $export = new ClientsExport([
                $this->filtered['data']
            ]);

            return Excel::download($export, 'Export_Teilnehmer.xlsx');
        }

    }

    //TODO ExportToPdf
    public function exportToPdf()
    {
        $searchTerm = '%' . $this->filter . '%';
        $tagFilteredCompanies = Company::with('staff')->whereIn('id', $this->companyIds)
            ->where('name', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)->get();
        $export = new CompaniesExport([
            $tagFilteredCompanies->toArray()
        ]);

        return Excel::download($export, 'Export_Unternehmen.xlsx');
    }

    public function render()
    {
        $tagFilteredClients = Client::orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);

        if ($this->postalCodeFilter){
            $tagFilteredClients = $this->filterByPostalCode();
        }
        if ($this->filter){
            $tagFilteredClients = $this->filterByFilter();
        }
        if ($this->tagFilter){
            $tagFilteredClients = $this->filterByTag();
        }
        if ($this->filter && $this->tagFilter) {
            $tagFilteredClients = $this->filterByTagAndFilter();
        }
        $lastPage = $tagFilteredClients->lastPage();
        $lastPage = ++$lastPage;
        $this->filtered = $tagFilteredClients->toArray();
        return view('livewire.clients.show-clients', compact('tagFilteredClients', 'lastPage'));
    }
}
