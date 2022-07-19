<?php

namespace App\Http\Controllers;


use App\Models\Trainer;
use App\Models\Company;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class TrainerController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('trainers.show-trainers');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return View
     */
    public function create(): View
    {
        return view('trainers.create-trainer');
    }
    // DO Not Delete, livewire CreateTrainer connected
    public function storeLogo($id, $logo)
    {
        $trainer = Trainer::where('id', $id)->firstOrFail();
        $trainer->clearMediaCollection('trainerLogo');
        $trainer->addMedia($logo)
            ->setFileName($trainer->last_name.'_'.$trainer->first_name.'.jpg')
            ->toMediaCollection('trainerLogo');
        $trainer->save();
    }
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        $attributes = collect($request->all())->toArray();
//        $trainer = new Trainer($attributes);
//      if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
//            $trainer->addMedia($request->file('avatar'))
//                ->setFileName($trainer->first_name.$trainer->last_name.'.jpg')
//                ->toMediaCollection('avatar', 'avatars');
//        }
//        $trainer->save();
//
//        return redirect('trainers')->with('success', trans('trainers.createSuccess'));
//    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param Trainer $trainer
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Request $request, Trainer $trainer)
//    {
//        if ($request->ajax()) {
//            $trainer->save();
//            $trainer->delete();
//
//        }
//    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $trainerId
     *
     * @return mixed
     */
    public function getTrainerById($trainerId)
    {
        return trainer::where('id', $trainerId)->firstOrFail();
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param $trainerId
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $trainer = Trainer::where('slug', $slug)->with('media')->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
//        $trainer->bookedWorkshops = $trainer->workshops->diff(Workshop::where('status' , 'Beendet')
//            ->orWhere('status', 'Storniert')
//            ->get()
//        );
//        foreach ($trainer->bookedWorkshops as $booked){
//            $booked->start_date = Carbon::create($booked->start_date)->format('d.m.y');
//        }
//        $trainer->workshopsHistory = $trainer->workshops->diff(Workshop::where('status' , 'Aktiv')
//            ->orWhere('status', 'Inaktiv')
//            ->get());
//        foreach ($trainer->workshopsHistory as $history){
//            $history->start_date = Carbon::create($history->start_date)->format('d.m.y');
//        }
        return view('trainers.show-trainer', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param trainer $trainer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $update = collect(($request->input()))
            ->except('bookedWorkshops', 'addWorkshop')->filter()->toArray();
        $addWorkshop = collect(($request->input()))
            ->only('addWorkshop')->filter()->values();
        $removeWorkshops = collect(($request->input()))
            ->except('bookedWorkshops', 'addWorkshop', 'company_id', 'phone','info', 'first_name' , 'last_name', 'title', 'email', '_method', '_token')->values();

        $trainer->fill($update)->save();
        $trainer->workshops()->attach($addWorkshop);
        $trainer->workshops()->detach($removeWorkshops);

        if ($trainer->media && $request->hasFile('avatar')) {

            $trainer->clearMediaCollection('avatar');
            $trainer->addMediaFromRequest('avatar')->toMediaCollection('avatar', 'avatars');
        }
        return back()->with('success', trans('trainers.updateSuccess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        try {
            $trainer = Trainer::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return view('trainers.edit-trainer', compact('trainer'));
    }
}
