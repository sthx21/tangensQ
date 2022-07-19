<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Location;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;



class LocationController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {

            $companies = Location::all();


        //return response()->json(['message'=>null,'data'=>$companies],200);
        return view('companies.show-companies',compact('companies'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function create(Request $request)
    {
        $title = ['Mr.', 'Mrs'];


        return view('companies.create-company', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCompanyRequest  $request
     * @return View
     */
    public function store(StoreCompanyRequest $request)
    {
        $attributes = collect($request->validated())->toArray();
        $company = new Company($attributes);
        $company->save();

        return back()->with('success', trans('companies.createSuccess'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     *
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
            $company->save();
            $company->delete();
            return redirect('companies')->with('success', trans('companies.deleteSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company                     $company
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $update = $request->validated();



        $company->fill($update)->save();

        return back()->with('success', trans('companies.updateSuccess'));
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
            $company = Company::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $title = ['Mr.','Mrs.'];

            $titles = collect($title);
            $titles->values();
//        dd($titles);
//        dd($company->hr_title);


        return view('companies.edit-company', compact('company', 'titles'));
    }


}
