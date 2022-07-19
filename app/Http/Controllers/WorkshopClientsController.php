<?php

namespace App\Http\Controllers;


use App\Mail\faceToFaceMail;
use App\Models\Client;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mail;
use phpDocumentor\Reflection\Types\Collection;
use phpDocumentor\Reflection\Types\Void_;
use App\Mail\NewClient;


class WorkshopClientsController extends Controller

{
    /**
     * Set Client Collector with max.
     *
     * @param $counter
     * @return array
     */
    public function generateIterator($counter): array
    {

        $max = 13 - $counter;

        for ($i = 1; $i <= $max; $i++) {
            $collector[$i] = '';
        }
        return $collector;
    }

    public function update(Request $request, Workshop $workshop)
    {
        $input = collect(($request->input()))->except('_token', '_method')->filter()->values();

        ////No known Clients - No duplicate Check


        if($workshop->clients->count() < 1){
            foreach ($input as $key => $value){

                    $this->mailToNewClient($value);
            }
        }
        ////Determine New Clients
        ///
        ///
            foreach ($workshop->clients as $client){

               foreach ($input as $key => $value){
                   if (is_string($key)){
                       $this->mailToNewClient($value);
                   }
                   else{
                       $this->mailToNewClient($value);
                   }
               }
            }

        $workshop->clients()->sync($input);
        return redirect('workshops')->with('success', trans('workshops.updateSuccess'));
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
     * Grabbing Client Emails from Database
     *
     *
     * @param string $id
     *
     * @return void
     */

    public function mailToNewClient($id): void
    {
dd($id);
//        Mail::to(['collin@scholl.one'])->send(new NewClient);
    }
    /**
     * Sending A Welcome Email to a New Client After Adding to a Workshop
     *
     * @param string $email
     *
     * @return void
     */

    public function sendMail($email): void
    {
        Mail::to($email)->send(new FaceToFaceMail());

        if( count(Mail::failures()) > 0 ){
            Session::flash('message','There seems to be a problem. Please try again in a while');
        }else{
            Session::flash('message','Thanks for your message. Please check your mail for more details!');
        }

    }



}
