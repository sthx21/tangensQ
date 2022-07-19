<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Collection;
use DataTables;
use PHPUnit\Util\Json;
use Spatie\Image\Image;
use Yajra\DataTables\Html\Button;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('companies.show-companies');
    }

    public function create(): View
    {
        return view('companies.create-company');
    }
        // DO Not Delete, livewire CreateCompany connected
    public function storeLogo($id, $logo, $fileName)
    {
//        dd($id, $logo);
        $company = Company::where('id', $id)->firstOrFail();
        $company->clearMediaCollection('companyLogo');
        $company->addMedia($logo)
                ->setFileName($fileName)
                ->toMediaCollection('companyLogo');
        $company->save();
    }
    /**
     * Display the specified resource.
     *
     * @param $slug
     *
     * @return View
     */
    public function show($slug)
    {
        try {
            $company = Company::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        return view('companies.show-company', compact('company'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  $slug
     *
     * @return View
     */
    public function edit($slug)
    {
        try {
            $company = Company::where('slug', $slug)->with('media')->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        return view('companies.edit-company', compact('company'));
    }
}
