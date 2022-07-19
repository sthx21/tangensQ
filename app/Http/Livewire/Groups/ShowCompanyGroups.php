<?php

namespace App\Http\Livewire\Groups;

use App\Exports\CompaniesExport;
use App\Exports\CompaniesNewsletterExport;
use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowCompanyGroups extends Component
{
use WithPagination;
    public $filter;
    public $companies;
    public $sort = 'id';
    public $direction = 'asc';
    public $paginateNo = 50;
    public $filtered;
    public $lp;
    public $fp;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p' ],
    ];

    protected $listeners = ['addTag', 'refreshGroups' => '$refresh', 'nextPage'];

    protected $rules = [
        'filter'                => ''
    ];

    public function mount()
    {

        $assignedTags = Tag::whereHas('companies')->get();
        $this->assignedTags = $assignedTags;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showCompany($company)
    {
        $this->redirect('companies/'.$company['slug']);
    }
    public function editCompany($company)
    {
        $this->redirect('companies/'.$company['slug'].'/edit');
    }


    public function getPages($groups)
    {
        $firstPage  = $groups->currentPage()-10;
        if ($firstPage < 1){
            $firstPage = 1;
        }
        $lastPage = $groups->currentPage()+10;
        if ($lastPage > $this->lastPage){
            $lastPage = $this->lastPage;
        }
        $this->fp = $firstPage;
        $this->lp = $lastPage;
    }

    public function gotToPage($page)
    {
////        for ($i = 1; $i < $lastPage; $i++)
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
        return Group::with('companies')->where('name', 'like', $searchTerm)
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


    public function render()
    {
        $groups = Group::with('companies')->select(['name', 'slug', 'id'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);

        if ($this->filter){
            $groups = $this->filterByFilter();
        }

        return view('livewire.groups.show-groups', compact('groups'));
    }
}
