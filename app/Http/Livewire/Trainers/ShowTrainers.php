<?php

namespace App\Http\Livewire\Trainers;

use App\Exports\CompaniesExport;
use App\Exports\CompaniesNewsletterExport;
use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Staff;
use App\Models\Tag;
use App\Models\Trainer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowTrainers extends Component
{
use WithPagination;
    public $filter;
    public $trainers;
    public $tagFilter;
    public $postalCodeFilter;
    public $trainerIds = [];
    public $sort = 'id';
    public $direction = 'asc';
    public $paginateNo = 22;
    public $filtered;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p' ],
    ];

    public $taggFilteredTrainers;

    protected $listeners = ['addTag', 'createTag', 'nextPage'];

    protected $rules = [
        'filter'                => ''
    ];

    public function mount()
    {
        $tagIds = [];
        $tags = DB::table('tag_trainer')->get('tag_id');
        foreach ($tags as $tag){
            $tagIds[] = $tag->tag_id;
        }
        $this->assignedTags = Tag::findMany($tagIds);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showTrainer($trainer)
    {
        $this->redirect('trainers/'.$trainer['slug']);
    }
    public function editTrainer($trainer)
    {
        $this->redirect('trainers/'.$trainer['slug'].'/edit');
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
        $this->trainerIds = [];
        $this->tagFilter = $tag;
        $this->filterByTag = DB::table('tag_trainer')
            ->where('tag_id', $this->tagFilter['id'])
            ->get('trainer_id');
        foreach ($this->filterByTag as $trainer){
            $this->trainerIds[] = $trainer->trainer_id;
        }
        $this->paginators = ['page' => 1];
    }
    public function unsetTagFilter()
    {
        $this->tagFilter = null;
        $this->tagFilterTrainers = null;

    }

    public function filterByFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Trainer::where('last_name', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function filterByTag()
    {
        return Trainer::whereIn('id', $this->trainerIds)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function filterByTagAndFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Trainer::whereIn('id', $this->trainerIds)
            ->where('last_name', 'like', $searchTerm)
            ->orderBy($this->sort, $this->direction)->paginate(25);
    }

    public function filterByPostalCode()
    {
        $searchTerm = '%' . $this->postalCodeFilter . '%';
        return Trainer::where('zip', 'like', $searchTerm)
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
        $tagFilteredTrainers = Trainer::orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);

        if ($this->postalCodeFilter){
            $tagFilteredTrainers = $this->filterByPostalCode();
        }
        if ($this->filter){
            $tagFilteredTrainers = $this->filterByFilter();
        }
        if ($this->tagFilter){
            $tagFilteredTrainers = $this->filterByTag();
        }
        if ($this->filter && $this->tagFilter) {
            $tagFilteredTrainers = $this->filterByTagAndFilter();
        }
        $lastPage = $tagFilteredTrainers->lastPage();
        $lastPage = ++$lastPage;
        $this->filtered = $tagFilteredTrainers->toArray();
        return view('livewire.trainers.show-trainers', compact('tagFilteredTrainers', 'lastPage'));
    }
}
