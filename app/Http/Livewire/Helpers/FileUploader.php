<?php

namespace App\Http\Livewire\Helpers;


use App\Models\FileUpload;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent as Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Offer;
use App\Models\Staff;
use App\Models\Company;

class FileUploader extends Component
{
    use WithFileUploads;
    public $file;
    public $modelType = '';
    public $uploadType = '';
    public $model;


    public function mount($id)
    {
       if ($this->modelType === 'offer'){
           $this->model = Offer::with('companies')->whereId($id)->first();
           $this->uploadType = 'uploadPdf';
       }
    }

    public function upload()
    {
        $upType = $this->uploadType;
        $this->$upType();
    }
    public function uploadPdf()
    {
        $today = Carbon::now()->timezone('Europe/Berlin')->format('d.m.y-h:i:s');
        $fileName = $this->model->offer_number.'-'.$today.'.pdf';
        $this->file->storeAs('pdfUploads', $fileName);
        $this->file = '';
        $fileUpload = new FileUpload();
        $fileUpload->offer_id = $this->model->id;
        $fileUpload->company_id = $this->model->companies()->first()->id;
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
    public function render()
    {
        return view('livewire.helpers.file-uploader');
    }
}
