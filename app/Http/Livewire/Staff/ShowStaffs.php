<?php

namespace App\Http\Livewire\Staff;

use App\Exports\CompaniesExport;
use App\Exports\CompaniesNewsletterExport;
use App\Exports\StaffExport;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowStaffs extends Component
{
use WithPagination;

//TODO Filter Trait
    public $filter;
    public $advancedFilter = false;
    public $advancedTags;
    public $advancedNotTags;
    public $whereFilter;
    public $whereNotFilter;
    public $whereIds = [];
    public $whereNotIds = [];
    public $whereTags;
    public $whereNotTags;
//    public $staffs;
    public $tagFilter;
    public $tagFilterName = '';
    public $postalCodeFilter;
    public $filtered;
    public $newsletterFilter = false;
    public $staffIds = [];
    //TODO Pagination Trait
    public $sort = 'id';
    public $direction = 'asc';
    public $paginateNo = 50;
    public $lp;
    public $fp;


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
        $assignedTagIds = DB::table('staff_tag')->get('tag_id')->unique();
        $assignedTags = [];
        foreach ($assignedTagIds as $id){
            $assignedTags[] = Tag::whereId($id->tag_id)->first();
        }
        $this->assignedTags = $assignedTags;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showStaff($staff)
    {
        $this->redirect('staff/'.$staff['slug']);
    }
    public function editStaff($staff)
    {
        $this->redirect('staff/'.$staff['slug'].'/edit');
    }

    public function getPages($tagFilteredStaffs)
    {
        $firstPage  = $tagFilteredStaffs->currentPage()-10;
        if ($firstPage < 1){
            $firstPage = 1;
        }
        $lastPage = $tagFilteredStaffs->currentPage()+10;
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
        $this->tagFilterStaffs = null;
        $this->advancedFilter = false;
        $this->whereIds = [];
        $this->whereNotIds = [];
    }

    public function filterByFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Staff::where('last_name', 'like', $searchTerm)
            ->orWhere('first_name', 'LIKE', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate($this->paginateNo);
    }

    public function filterByTag()
    {
        return Tag::whereId($this->tagFilter['id'])->with('staff')->firstOrFail()->staff->paginate($this->paginateNo);
    }

    public function filterByTagAndFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Staff::whereRelation('tags', 'id', 'like', $this->tagFilter['id'])
            ->where('first_name', 'like', $searchTerm)
            ->orWhere('last_name', 'like', $searchTerm)
            ->paginate($this->paginateNo);

    }

    public function filterByPostalCode()
    {
        $searchTerm = '%' . $this->postalCodeFilter . '%';
        return Staff::where('zip', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate($this->paginateNo);
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
        $staff = $this->filtered;
        $export = new StaffExport([
            $staff
        ]);
            return Excel::download($export, 'Export_gefilterte_Personen.xlsx');
        }
    //TODO ExportToPdf
    public function exportToPdf()
    {
        $tagFilteredCompanies = $this->filtered;
        $export = new CompaniesExport([
            $tagFilteredCompanies
        ]);

        return Excel::download($export, 'Export_Unternehmen.xlsx');
    }
    public function setAdvancedFilterIds($type, $id)
    {
        $whereIds = $this->whereIds;
        $whereNotIds = $this->whereNotIds;
      if ($type === 'where'){
          $whereIds[] = $id;
      }
      $this->whereTags = Tag::whereIn('id', $whereIds)->get();
      $this->whereFilter = '';
        if ($type === 'whereNot'){
            $whereNotIds[] = $id;
        }
        $this->whereNotTags = Tag::whereIn('id', $whereNotIds)->get();
        $this->whereNotIds = $whereNotIds;
        $this->whereIds = $whereIds;
        $this->whereNotFilter = '';
      $this->advancedTags = '';
        $this->advancedNotTags = '';
        $this->paginators = ['page' => 1];
    }
    public function setAdvancedFilter()
    {
        if (!$this->whereIds){
            return;
        }
        $this->advancedFilter = !$this->advancedFilter;
    }
    public function advancedTagFilter()
    {
        $whereIds = $this->whereIds;
        $whereNotIds = $this->whereNotIds;
        $query = Staff::with('tags');
        $query->whereHas('tags', function ($q) use ($whereIds)
        {
            return $q->whereIn('id', $whereIds);
        })->whereDoesntHave('tags', function ($q) use ($whereNotIds)
        {
            return $q->whereIn('id', $whereNotIds);
        });
        return  $query->paginate($this->paginateNo);
    }

    public function render()
    {
        $tagFilteredStaffs = Staff::with('tags')->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);

        if ($this->whereFilter){
            $searchTerm = '%' . $this->whereFilter . '%';
            $this->advancedTags = Tag::where('name', 'like', $searchTerm)->get();
        }
        if ($this->whereNotFilter){
            $searchTerm = '%' . $this->whereNotFilter . '%';
            $this->advancedNotTags = Tag::where('name', 'like', $searchTerm)->get();
        }
        if ($this->postalCodeFilter){
            $tagFilteredStaffs = $this->filterByPostalCode();
        }
        if ($this->filter){
            $tagFilteredStaffs = $this->filterByFilter();
        }
        if ($this->tagFilter){
            $tagFilteredStaffs = $this->filterByTag();
        }
        if ($this->filter && $this->tagFilter) {
            $tagFilteredStaffs = $this->filterByTagAndFilter();
        }
        if ($this->advancedFilter){
            $tagFilteredStaffs = $this->advancedTagFilter();
        }

        $this->currentPage = $tagFilteredStaffs->currentPage();
        $this->lastPage = $tagFilteredStaffs->lastPage();
        $this->getPages($tagFilteredStaffs);
        $this->filtered = $tagFilteredStaffs->toArray();
        return view('livewire.staff.show-staffs', compact('tagFilteredStaffs'));
    }
}
