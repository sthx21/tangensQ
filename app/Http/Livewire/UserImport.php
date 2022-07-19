<?php

namespace App\Http\Livewire;

use App\Imports\OffersImport;
use App\Imports\StaffAttachCompanyImport;
use App\Models\Staff;
use App\Imports\CompaniesImport;
use App\Imports\CompanyTagsImport;
use App\Imports\StaffImport;
use App\Imports\StaffTagsImport;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UserImport extends Component
{
    use WithFileUploads;
    public $staffImport;
    public $staffTagsImport;
    public $companiesImport;
    public $offersImport;
    public $companyTagsImport;
    public $staffToCompanyImport;

    public function staffImport()
    {
        $path = Storage::path('tmpImport');
        $fileName = 'staffImport.xlsx';
        $this->staffImport[0]->storeAs('tmpImport', $fileName);
        $fullPath = $path.'/'.$fileName;

        Excel::import(new StaffImport(), $fullPath);
    }
    public function staffTagsImport()
    {
        $path = Storage::path('tmpImport');
        $fileName = 'staffTagsImport.xlsx';
        $this->staffTagsImport[0]->storeAs('tmpImport', $fileName);
        $fullPath = $path.'/'.$fileName;

        Excel::import(new StaffTagsImport(), $fullPath);

    }

    public function attachTagsToStaff()
    {
        $tags = Tag::all();
        foreach ($tags as $tag){

            $staff = Staff::where('old_id', $tag->old_id)->firstOrFail();
            $staff->tags()->attach($tag->id);
        }
    }
    public function companiesImport()
    {
        $path = Storage::path('tmpImport');
        $fileName = 'companiesImport.xlsx';
        $this->companiesImport[0]->storeAs('tmpImport', $fileName);
        $fullPath = $path.'/'.$fileName;

        Excel::import(new CompaniesImport(), $fullPath);
    }
    public function offersImport()
    {
        $path = Storage::path('tmpImport');
        $fileName = 'companiesImport.xlsx';
        $this->offersImport[0]->storeAs('tmpImport', $fileName);
        $fullPath = $path.'/'.$fileName;

        Excel::import(new OffersImport(), $fullPath);
    }
    public function companyTagsImport()
    {
        $path = Storage::path('tmpImport');
        $fileName = 'companyTagsImport.xlsx';
        $this->companyTagsImport[0]->storeAs('tmpImport', $fileName);
        $fullPath = $path.'/'.$fileName;

        Excel::import(new CompanyTagsImport(), $fullPath);
    }
    public function staffToCompanyImport()
    {
        $path = Storage::path('tmpImport');
        $fileName = 'staffToCompanyImport.xlsx';
        $this->staffToCompanyImport[0]->storeAs('tmpImport', $fileName);
        $fullPath = $path.'/'.$fileName;

        Excel::import(new StaffAttachCompanyImport(), $fullPath);
    }


    public function render()
    {
        return view('livewire.import-export.user-import');
    }
}
