<?php

namespace App\Http\Controllers;



use App\Models\Trainer;
use App\Models\Webex;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Collection;
use App\Http\Requests\StoreWebexRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use Illuminate\Support\Facades\Http;
use DataTables;
use Yajra\DataTables\Html\Button;
use App\Http\Controllers\MailController as Mailer;



class WebexController extends Controller

{
    function shortenTitle($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                }
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        }
        else {
            $output = $text;
        }
        return $output;
    }




    /**
     * Show all Workshops.
     *
     * @return View
     */
    public function index(): View
    {

        return view('webexes.show-webexes');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return View
     */
    public function create(): View
    {
        $trainers = Trainer::all();

        return view('webexes.create-webex', compact('trainers'))->with('success');
    }

    /**
     * Store a newly created Workshop in Storage.
     *
     * @param StoreWebexRequest $request
     * @return RedirectResponse
     */
    public function store(StoreWebexRequest $request)
    {
        $trainer = $request->validated()['trainer'];
//        dd($request->validated());

        $attributes = collect($request->validated())->except(['trainer_one', 'trainer_two'])->toArray();
        $webex = new Webex($attributes);
        $online = $this->createWebex($attributes, $trainer);
        if(isset($online['message']))
        {
        foreach ($online['errors'] as $error) {
            foreach ($error as $text){
            dd($text);
            }
        }
    }
        $webex->fill($online);
        $webex->webex_id = $online['id'];
        $webex->start = substr($online['start'], 11, 5);
        $webex->end = substr($online['end'], 11, 5);
        $webex->save();
        $webex->trainers()->attach($trainer);
        $notification = new Mailer();
        $notification->createdWebExNotification($webex, $trainer);

        return redirect('webex')->with('success', trans('workshops.createSuccess'));
    }

    public function createWebex($attr)
    {
        $response = Http::withToken(env('TOKEN'))->post('https://webexapis.com/v1/meetings',
            [
                'enabledAutoRecordMeeting'              => $attr['enabledAutoRecordMeeting'],
                'allowAnyUserToBeCoHost'                => $attr['allowAnyUserToBeCoHost'],
                'enabledJoinBeforeHost'                 => $attr['enabledJoinBeforeHost'],
                'enableConnectAudioBeforeHost'          => $attr['enableConnectAudioBeforeHost'],
                'excludePassword'                       => $attr['excludePassword'],
                'publicMeeting'                         => $attr['publicMeeting'],
                'enableAutomaticLock'                   => $attr['enableAutomaticLock'],
                'allowFirstUserToBeCoHost'              => $attr['allowFirstUserToBeCoHost'],
                'allowAuthenticatedDevices'             => $attr['allowAuthenticatedDevices'],

                'sendEmail'                             => $attr['sendEmail'],
                'title'                                 => $attr['title'],
                'agenda'                                => $attr['additional_title'],
                'password'                              => $attr['password'],
                'start'                                 => $attr['start_date'].'T'.$attr['start_time'],
                'end'                                   => $attr['start_date'].'T'.$attr['end_time'],
                'timezone'                              => 'Europe/Berlin',
//                'hostEmail'                             => $attr['hostEmail']
            ]);
//dd($response);
        return json_decode($response->body(), true);
        }

    /**
     * Remove Workshop from Storage.
     *
     * @param Webex $webex
     *
     * @return RedirectResponse
     */
    public function destroy(Webex $webex)
    {

        $response = Http::withToken(env('TOKEN'))->delete('https://webexapis.com/v1/meetings/'.$webex->webex_id,
            [

                'hostEmail'                => $webex->hostEmail,
                'sendEmail'                 => true,


            ]);

        $webex->save();
        $webex->delete();
        return redirect('webex')->with('success', trans('workshops.deleteSuccess'));
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
        $today = Carbon::today();
        $webex = Webex::where('slug', $slug)->firstOrFail();
        if (empty($webex->end_date)){
            $webex->end_date = $webex->start_date;
        }
        $webex->start_date = Carbon::create($webex->start_date);

        $webex->end_date = Carbon::create($webex->end_date);
        if ($webex->series_two != null) {
            $webex->series_two = Webex::where('id', $webex->series_two)->firstOrFail();
            $webex->series_two->start_date = Carbon::create($webex->series_two->start_date);
        }
        if ($webex->series_three != null) {
            $webex->series_three = Webex::where('id', $webex->series_three)->firstOrFail();
            $webex->series_three->start_date = Carbon::create($webex->series_three->start_date);
        }


        return view('webexes.show-webex', compact('webex', 'today'));
    }

    /**
     * Remove null
     *
     * @param $input
     * @return array
     */
    public function removeNull($input)
    {
        foreach ($input as $key => $value) {
            if ($value == null) {
                unset($input[$key]);
            }
        }
        return $input;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkshopRequest $request
     * @param Webex $webex
     *
     * @return RedirectResponse
     */
    public function update(UpdateWorkshopRequest $request, Webex $webex)
    {
        $trainers = collect($request->validated())->only(['trainer_one', 'trainer_two'])->filter()->values();
        $update = $request->validated();

        $addClients = collect(($request->input('addClients')))->filter()->values();
        $removeClients = collect(($request->input('removeClients')))->filter()->values();
        $webex->fill($update)->save();
        $webex->trainers()->sync($trainers);
        $webex->clients()->attach($addClients);
        $webex->clients()->detach($removeClients);
        foreach ($addClients as $id){
            $this->newInviteeNotification($webex, $id);
        }

        return back()->with('success', trans('workshops.updateSuccess'));
    }

    /**
     * Add a New Invitee
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function newInviteeNotification($webex, $id)
    {
//        dd($webex, $id);
            $newInvitee = Client::where('id', $id)->firstOrFail();
//        dd($newInvitee->email);
        $response = Http::withToken(env('TOKEN'))->post('https://webexapis.com/v1/meetingInvitees',
            [

                'coHost'                            => true,
                'sendEmail'                         => true,
                'meetingId'                         => $webex->webex_id,
                'email'                             => $newInvitee->email,
                'displayName'                       => $newInvitee->last_name,

            ]);

        return json_decode($response->body(), true);
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
            $webex = Webex::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $allTrainers = Trainer::pluck('last_name', 'id');
        $attachedTrainers = $webex->trainers->pluck('last_name', 'id');
        $webex->attachableTrainers = $allTrainers->diffKeys($attachedTrainers);
        $webex->trainer_one = $webex->trainers->first();
        $webex->trainer_two = '';
        if (count($webex->trainers) > 1) {
            $webex->trainer_two = $webex->trainers->last();
        }
        return view('webexes.edit-webex',
            compact('webex'));
    }
    /**
     * Query Workshops for DataTables
     *
     * @param int $type
     *
     *
     */
    public function getWebexes(Request $request)
    {

        if ($request->ajax()) {
            $data = Webex::with('clients')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('booked', function (Webex $webex) {
                    return $webex->clients->count();
                })
                ->addColumn('action', function(Webex $webex){
                    return  '<a href="/webex/'. $webex->slug .'/edit" class="btn btn-sm btn-warning">'. 'Ändern' .'</a>
                                    <a href="/webex/'. $webex->slug.'" class="btn btn-sm btn-primary">'. 'Details' .'</a>
                                     <a href="/webex/'. $webex->slug.'/cancel" class="btn btn-sm btn-danger" method="PUT">'. 'Storno' .'</a>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('workshop_search_box');
        $searchRules = [
            'workshop_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'workshop_search_box.required' => 'Search term is required',
            'workshop_search_box.string' => 'Search term has invalid characters',
            'workshop_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Workshop::where('id', 'like', $searchTerm . '%')
            ->orWhere('name', 'like', $searchTerm . '%')
            ->orWhere('email', 'like', $searchTerm . '%')->get();


        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
