<?php

namespace App\Http\Livewire\Helpers;

use App\Models\FileUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;


class DownloadButton extends Component
{
    public $fileDownload;
    public $fileId;

    public function fileDownload($id)
    {
        $pdf = FileUpload::whereId($id)->first();
        $downloadPath = storage_path('pdfUploads');
        $downloadFile = $pdf->file_name;
        $download = $downloadPath.$downloadFile;
        return Storage::disk('pdfUploads')->download($downloadFile);
    }

    public function render()
    {
        return <<<'blade'
            <div>
               <button class="downloadButton" wire:click.prevent="fileDownload({{$fileId}})">DOWNLOAD</button>
            </div>
        blade;
    }
}
