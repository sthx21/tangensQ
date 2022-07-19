<?php

namespace App\Http\Livewire\Workshops;

use App\Exports\CompaniesExport;
use App\Exports\CompaniesNewsletterExport;
use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Workshop;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowWorkshops extends Component
{
use WithPagination;
    public $filter;
    public $regionFilter;
    public $companies;
    public $tagFilter;
    public $tagFilterName = '';
    public $postalCodeFilter;
    public $sort = 'start_date';
    public $direction = 'asc';
    public $paginateNo = 50;
    public $filtered;
    public $newsletterFilter = false;
    public $lp;
    public $fp;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p' ],
        'filter' => ['except' => '', 'as' => 'f' ]
    ];

    public $taggFilteredWorkshops;
    protected $listeners = ['addTag', 'createTag', 'nextPage'];

    protected $rules = [
        'filter'                => ''
    ];

    public function mount()
    {
        $this->regions = [
            'Nord'  => 'Nord',
            'Süd'   => 'Süd',
            'West'  => 'West',
            'Ost'   => 'Ost',
            'Mitte' => 'Mitte',
        ];
      //
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showWorkshop($workshop)
    {
        $this->redirect('workshops/'.$workshop['slug']);
    }
    public function editWorkshop($workshop)
    {
        $this->redirect('workshops/'.$workshop['slug'].'/edit');
    }

    public function getPages($workshops)
    {
        $firstPage  = $workshops->currentPage()-10;
        if ($firstPage < 1){
            $firstPage = 1;
        }
        $lastPage = $workshops->currentPage()+10;
        if ($lastPage > $this->lastPage){
            $lastPage = $this->lastPage;
        }
        $this->fp = $firstPage;
        $this->lp = $lastPage;
    }

    public function gotToPage($page)
    {
        $this->paginators = ['page' => $page];
    }
    public function previousPage()
    {
        $page = $this->page-1;
        if ($page < 1){
            $page = 1;
        }
        $this->gotToPage($page);
    }
    public function nextPage()
    {
        $page = $this->page+1;
        if ($page > $this->lastPage){
            $page = $this->lastPage;
        }
        $this->gotToPage($page);
    }
    public function filterByFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Workshop::with('trainers')->
            where('title', 'like', $searchTerm)
            ->select(['title', 'start_date', 'end_date', 'slug', 'id', 'location', 'region', 'canceled'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
    }
    public function filterByRegion()
    {
//        $searchTerm = '%' . $this->regionFilter . '%';
        return Workshop::with('trainers')->
        where('region', 'like', $this->regionFilter)
            ->select(['title', 'start_date', 'end_date', 'slug', 'id', 'location', 'region', 'canceled'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
    }
    public function filterByPostalCode()
    {
        $searchTerm = $this->postalCodeFilter . '%';
        return Workshop::where('zip', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
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


    public function render()
    {
        $tagFilteredWorkshops = Workshop::with('clients', 'trainers')
            ->select(['title', 'start_date', 'end_date', 'slug', 'id', 'location', 'region', 'canceled'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);

        if ($this->postalCodeFilter){
            $tagFilteredWorkshops = $this->filterByPostalCode();
        }
        if ($this->filter){
            $tagFilteredWorkshops = $this->filterByFilter();
        }
        if ($this->regionFilter){
            $tagFilteredWorkshops = $this->filterByRegion();
        }

        $this->currentPage = $tagFilteredWorkshops->currentPage();
        $this->lastPage = $tagFilteredWorkshops->lastPage();
        $this->getPages($tagFilteredWorkshops);
        $this->filtered = $tagFilteredWorkshops->toArray();
        return view('livewire.workshops.show-workshops', compact('tagFilteredWorkshops'));
    }
}
