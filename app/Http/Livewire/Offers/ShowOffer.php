<?php

namespace App\Http\Livewire\Offers;

use App;
use App\Models\Activity;
use App\Models\FileUpload;
use App\Models\Offer;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use PDF;
use Livewire\Component;


class ShowOffer extends Component
{
    use WithFileUploads;
    public $offer;
    public $groupDiscount;
    public $pdfUpload;
    public $uploadedPdfs;
    public $activity;


    protected $rules = [

        'pdfUpload'                                   =>  '',
        'activity.title'            => '',
        'activity.description'      => ''

    ];

    protected $listeners = ['refreshOffer' => '$refresh'];


    public function mount($slug)
    {
        $this->offer = Offer::where('slug', $slug)->with('companies')->first();
        $this->events = $this->offer->events ?? [];
        $this->staffMembers = $this->offer->staffMembers ?? [];
        $this->clientMembers = $this->offer->clientMembers ?? [];
        $this->trainers = Trainer::all();
        $this->total = $this->offer->amount/100*(100-$this->offer->discount);
        $this->activities = Activity::where('offer_id', $this->offer->id)->with('user')->latest()->get();
        $this->uploadedPdfs = FileUpload::whereOfferId($this->offer->id)->get();
//        dd($this->uploadedPdfs);
        $this->author = $this->offer->user;
        if ($this->offer->accepted_date) {
            $this->offer->accepted_date = Carbon::create($this->offer->accepted_date)->format('d.m.y');
        }
    }

    public function uploadPdf()
    {
        $today = Carbon::now()->format('d.m.y-h:i:s');
        $fileName = $this->offer->offer_number.'-'.$today.'.pdf';
        $this->pdfUpload->storeAs('pdfUploads', $fileName);
        $this->pdfUpload = '';
        $fileUpload = new App\Models\FileUpload();
        $fileUpload->offer_id = $this->offer->id;
        $fileUpload->company_id = $this->offer->companies()->first()->id;
        $fileUpload->file_name = $fileName;
        $fileUpload->file_path = 'pdfUploads';
        $fileUpload->user_id = \Auth::id();
        $fileUpload->save();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'PDF erfolgreich angehängt!',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'center'
        ]);
        $this->redirect('/accounting');
    }
    public function addActivity()
    {
        $activity = new Activity();
        $activity->title = '';
        $activity->user_id = \Auth::id();
        $activity->description = $this->activity['description'];
        $activity->offer_id = $this->offer->id;
        $activity->save();
        $this->activities->prepend($activity);
        $this->activity = '';
    }
    public function removeActivity($id)
    {
        $activity = Activity::whereId($id)->first();
        $activity->destroy($id);
        $this->acttivities = Activity::where('offer_id', $this->offer->id)->with('user')->latest()->get();
        $this->emit('refreshOffer');
    }
    public function pdfDownload($id)
    {
//        dd($this);
        $pdf = FileUpload::whereId($id)->first();
        $downloadPath = storage_path('pdfUploads');
        $downloadFile = $pdf->file_name;
        $download = $downloadPath.$downloadFile;

        return Storage::disk('pdfUploads')->download($downloadFile);
    }
    public function render()
    {
        return view('livewire.offers.show-offer');
    }
}
