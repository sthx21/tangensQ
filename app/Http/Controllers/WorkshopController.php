<?php

namespace App\Http\Controllers;


use App\Mail\faceToFaceMail;
use App\Mail\NewWorkshopNotification;
use App\Mail\NewWorkshopClientNotification;
use App\Mail\CanceledWorkshopTrainerNotification;
use App\Mail\CanceledWorkshopClientNotification;
use App\Http\Controllers\MailController as Mailer;
use App\Models\Client;
use App\Models\Trainer;
use App\Models\Workshop;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use DataTables;
use Illuminate\Support\Collection;
use Yajra\DataTables\Html\Button;
use RealRashid\SweetAlert\Facades\Alert;

class WorkshopController extends Controller

{


public function setStatusEnded(): void
{
    $today = Carbon::today();
    $allActiveWorkshops = Workshop::where('status', 'Aktiv')->orWhere('status', 'Inaktiv')->get();
    foreach ($allActiveWorkshops as $workshop)
    {
        if ($workshop->start_date  < $today ){
            $workshop->status = 'Beendet';
            $workshop->save();
        }
    }
}

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return View
     */
    public function create(): View
    {

        return view('workshops.create-workshop');
    }


    /**
     * Remove Workshop from Storage.
     *
     * @param Workshop $workshop
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request, Workshop $workshop)
    {
//        dd($workshop);
        if ($request->ajax()) {
            $workshop->save();
            $workshop->delete();

        }
//        $workshop->save();
//        $workshop->delete();
        return redirect('workshops')->with('success', trans('workshops.deleteSuccess'));
    }

    /**
     * Show all active Workshops
     *
     * @param $slug
     *
     * @return View
     */
    public function show($slug)
    {
        $workshop = Workshop::where('slug', $slug)->firstOrFail();
//        if (empty($workshop->end_date)) {
//            $workshop->end_date = $workshop->start_date;
//        }
//        $workshop->start_date = createDate($workshop->start_date);
//        $workshop->end_date = createDate($workshop->end_date);
//        $workshop->cancellation_date = createDate($workshop->cancellation_date);
//
//        if (count($workshop->clients) > 0) {
//            $workshop->occupancyRate = count($workshop->clients);
//        } else {
//            $workshop->occupancyRate = 0;
//        }
        return view('workshops.show-workshop', compact('workshop'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkshopRequest $request
     * @param Workshop $workshop
     *
     * @return RedirectResponse
     */
    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {

        //update workshop and save
        $workshop->fill($request->validated())->save();
        //get trainers and sync
        $workshop->trainers()->sync($request->validated()['trainer']);
        //add / remove clients
        $workshop->clients()->attach(collect(($request->input('addClients')))->filter()->values());
        $workshop->clients()->detach(collect(($request->input('removeClients')))->filter()->values());
        //send mail to trainers with updated client list
        $notification  = new Mailer();
        $notification->updatedWorkshopNotification($workshop, $workshop->clients);

        return redirect('/workshops/'.$workshop->slug)->with('success', trans('workshops.updateSuccess'));
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
            $workshop = Workshop::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }


        return view('workshops.edit-workshop',
            compact('workshop'));
    }

    /**
    //     * Displaying Clients with DataTables.
    //     *
    //     * @return View
    //     */
    public function index(){


        return view('workshops.show-workshops');
    }


    public function addMorePost(Request $request)
    {
        $rules = [];
        foreach($request->input('topic_coreQuestions') as $key => $value) {
            $rules["topic_coreQuestions.{$key}"] = 'required';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            foreach($request->input('topic_coreQuestions') as $key => $value) {
                Workshop::create(['topic_coreQuestions'=>$value]);
            }
            return response()->json(['success'=>'done']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }


//TODO make cancelWorkshops / uncancelWorkshop OR Set $workshop->status = Storno/Inaktiv
    /**
     * Cancel Workshop
     *
     * @param $input
     *
     * @return RedirectResponse
     */
    public function cancelWorkshop($input): RedirectResponse
    {
        $workshop = Workshop::where('slug', $input)->firstOrFail();
        $workshop->status = 'Storniert';
        $workshop->save();
        $notification = new Mailer();
        $notification->canceledWorkshopNotification($workshop);

        return redirect('workshops')->with('success', trans('workshops.cancelSuccess'));
    }

    /**
     * Undo Workshop cancelation
     *
     * @param $input
     *
     * @return RedirectResponse
     */
    public function uncancelWorkshop($input): RedirectResponse
    {
        $workshop = Workshop::where('slug', $input)->firstOrFail();
        $workshop->status = 'Inaktiv';
        $workshop->save();
        // Send notification Mails...

        return redirect('workshops')->with('success', trans('workshops.uncancelSuccess'));
    }
}
