<?php

namespace App\Http\Livewire\Offers;

use App;
use App\Models\Offer;
use Livewire\WithPagination;
use PDF;
use Livewire\Component;


class ShowOffers extends Component
{
    use WithPagination;
    public $offer;
    public $filter;
    public $sort = 'id';
    public $direction = 'desc';
    public $paginateNo = 50;
    public $lp;
    public $fp;

    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p' ],
        'sort' => ['except' => 'id','as' => 's' ],
        'direction' => ['except' => 1, 'as' => 'd' ],
    ];


    public function mount()
    {


    }


    public function showOffer($offer)
    {
        $this->redirect('Angebote/'.$offer['slug']);
    }
    public function editOffer($offer)
    {
        $this->redirect('Angebote/'.$offer['slug'].'/edit');
    }

    public function filterByFilter()
    {
        $searchTerm = '%' . $this->filter . '%';
        return Offer::with('companies')
            ->where('title', 'like', $searchTerm)
            ->orWhere('offer_number', 'like', $searchTerm)
            ->orWhereRelation('companies', 'name', 'like', $searchTerm)
            ->select(['title', 'amount', 'slug', 'id', 'status', 'target_date', 'offer_number'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
    }
    public function getPages($offers)
    {
        $firstPage  = $offers->currentPage()-10;
        if ($firstPage < 1){
            $firstPage = 1;
        }
        $lastPage = $offers->currentPage()+10;
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
        $offers = Offer::
            with('companies')
            ->select(['title', 'amount', 'slug', 'id', 'target_date', 'status', 'type', 'confirmation_date'])
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginateNo);
//        dd($offers);

        if ($this->filter){
            $offers = $this->filterByFilter();
        }
        $this->currentPage = $offers->currentPage();
        $this->lastPage = $offers->lastPage();
        $this->getPages($offers);
        return view('livewire.offers.show-offers', compact('offers'));
    }
}
