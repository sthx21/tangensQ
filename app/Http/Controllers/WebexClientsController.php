<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\Types\Collection;
use App\Models\Webex;


class WebexClientsController extends Controller

{
    /**
     * Set Client Collector with max.
     *
     * @param Collection $collector
     *
     * @return Collection
     */
    public function generateIterator($counter)
    {

        $max = 15 - $counter;

        for ($i = 1; $i <= $max; $i++) {
            $collector[$i] = '';
        }
        return $collector;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create($webex, $newInvitee)
    {
        $response = Http::withToken(env('TOKEN'))->post('https://webexapis.com/v1/meetingInvitees',
            [
//                {
//  "coHost": false,
//  "sendEmail": true,
//  "meetingId": "82208c0a8d6a40c5bff22bf775af960b",
//  "email": "collin@sscholl.one",
//  "displayName": "coos",
//  "hostEmail": "sthb21@live.com"
//}


                'coHost'                            => false,
                'sendEmail'                         => true,
                'meetingId'                         => $webex['webex_id'],
                'email'                             => $newInvitee['email'],
                'displayName'                       => $newInvitee['last_name'],
//                'hostEmail'                         => $attr['publicMeeting'],

            ]);

        return json_decode($response->body(), true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Workshop $workshop
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {

    }




    /**
     * Display the specified resource.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

    }

    /**
     * Add and Remove Clients from Workshop
     *
     * @param \Illuminate\Http\Request $request
     * @param Workshop $workshop
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Workshop $workshop)
    {
        $input = collect(($request->input()))->except('_token', '_method')->filter()->values();

        // Remove Clients marked with 'delete' -> substituted by ->filter()
        //$input = $this->removeClients($input);


        $workshop->clients()->sync($input);

        return back()->with('success', trans('workshops.updateSuccess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $slug
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($slug)
    {
        try {
            $workshop = Workshop::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $allClients = Client::pluck('id', 'last_name')->flip();
        $attachedClients = $workshop->clients->pluck('id', 'last_name')->flip()->toArray();

        // Count BookedClients and set as loop max
        $addClients = $this->generateIterator(count($attachedClients));
        // Remove Attached Clients from DropDown List
        $attachableClients = $allClients->diffKeys($attachedClients);

        return view('workshops.edit-clients-workshop',
            compact('workshop', 'attachableClients', 'attachedClients', 'allClients', 'addClients'));
    }


    /**
     * Collect and Clean Input
     *
     * @param Collection $updatedClients
     *
     * @return array
     */
    public function removeClients($input)
    {
        foreach ($input as $key => $value) {
            if ($value == 'delete') {
                unset($input[$key]);
            }
        }
        $output = $input;

        return $output;
    }



}
