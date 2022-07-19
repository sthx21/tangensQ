<?php

namespace App\Http\Livewire\Companies;

use App\Exports\CompaniesExport;
use App\Exports\CompaniesNewsletterExport;
use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowCompanies extends Component
{
use WithPagination;
    public $filter;
    public $companies;
    public $tagFilter;
    public $tagFilterName = '';
    public $postalCodeFilter;
    public $companyIds = [];
    public $sort = 'id';
    public $direction = 'asc';
    public $filtered;
    public $newsletterFilter = false;
    public $paginateNo = 50;
    public $lp;
    public $fp;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p' ],
        'filter' => ['except' => '', 'as' => 'f' ]
    ];

    public $taggFilteredCompanies;
    protected $listeners = ['addTag', 'createTag', 'nextPage'];

    protected $rules = [
        'filter'                => ''
    ];

    public function mount()
    {

        $assignedTags = Tag::whereHas('companies')->orderBy('name', 'asc')->get();
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

    public function setTagFilter($tag)
    {

        $tag = Tag::whereId($tag)->first();

        $this->tagFilter = $tag;
        $this->tagFilterName = $this->tagFilter->name;
        $this->paginators = ['page' => 1];
    }
    public function unsetTagFilter()
    {
        $this->tagFilter = null;
        $this->filter = '';
        $this->tagFilterCompanies = null;

    }
    public function getPages($tagFilteredCompanies)
    {
        $firstPage  = $tagFilteredCompanies->currentPage()-10;
        if ($firstPage < 1){
            $firstPage = 1;
        }
        $lastPage = $tagFilteredCompanies->currentPage()+10;
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
        return Company::with('group')
            ->where('name', 'like', $searchTerm)
            ->select(['name', 'main_email', 'slug', 'id', 'group_id', 'zip'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
    }

    public function filterByTag()
    {
    $companyTagIds = DB::table('company_tag')
        ->where('tag_id', 'like', $this->tagFilter['id'])
        ->get('company_id');
    $companyIds = [];
        foreach ($companyTagIds as $tagId){
        $companyIds[] = $tagId->company_id;
    }
    return Company::whereIn('id', $companyIds)
        ->select(['name', 'main_email', 'slug', 'id', 'group_id', 'zip'])
        ->orderBy($this->sort, $this->direction)
        ->paginate($this->paginateNo);

    }

    public function filterByTagAndFilter()
    {
        $companyTagIds = DB::table('company_tag')
            ->where('tag_id', 'like', $this->tagFilter['id'])
            ->get('company_id');
        $companyIds = [];
        foreach ($companyTagIds as $tagId){
            $companyIds[] = $tagId->company_id;
        }
        $searchTerm = '%' . $this->filter . '%';
        return Company::with('staff')
            ->whereIn('id', $companyIds)
            ->where('name', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
    }

    public function filterByPostalCode()
    {
        $searchTerm = $this->postalCodeFilter . '%';
        return Company::with('staff')
            ->where('zip', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
    }

    public function filterByTagAndPostalCode()
    { $companyTagIds = DB::table('company_tag')
        ->where('tag_id', 'like', $this->tagFilter['id'])
        ->get('company_id');
        $companyIds = [];
        foreach ($companyTagIds as $tagId){
            $companyIds[] = $tagId->company_id;
        }
        $searchTerm = $this->postalCodeFilter . '%';
        return Company::with('staff')
            ->whereIn('id', $companyIds)
            ->where('zip', 'like', $searchTerm)
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

    public function exportToExcel()
    {
        if ($this->newsletterFilter){
            $export = new CompaniesNewsletterExport([
                $this->filtered['data']
            ]);

            return Excel::download($export, 'Export_Unternehmen.xlsx');
        }
        if (!$this->newsletterFilter){
            $export = new CompaniesExport([
                $this->filtered['data']
            ]);

            return Excel::download($export, 'Export_Unternehmen.xlsx');
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
        $tagFilteredCompanies = Company::with('group')->select(['name', 'main_email', 'slug', 'id', 'group_id'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);

        if ($this->postalCodeFilter){
            $tagFilteredCompanies = $this->filterByPostalCode();
        }
        if ($this->filter){
           $tagFilteredCompanies = $this->filterByFilter();
        }
        if ($this->tagFilter){
            $tagFilteredCompanies = $this->filterByTag();
        }
        if ($this->filter && $this->tagFilter) {
            $tagFilteredCompanies = $this->filterByTagAndFilter();
        }
        if ($this->postalCodeFilter && $this->tagFilter) {
            $tagFilteredCompanies = $this->filterByTagAndPostalCode();
        }
        $this->currentPage = $tagFilteredCompanies->currentPage();
        $this->lastPage = $tagFilteredCompanies->lastPage();
        $this->getPages($tagFilteredCompanies);
        $this->filtered = $tagFilteredCompanies->toArray();
        return view('livewire.companies.show-companies', compact('tagFilteredCompanies'));
    }
}
