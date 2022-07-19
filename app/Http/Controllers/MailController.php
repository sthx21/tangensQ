<?php

namespace App\Http\Controllers;
use App\Mail\NewWebexNotification;
use App\Models\Webex;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

use App\Http\Requests;
use App\Mail\faceToFaceMail;
use App\Mail\NewWorkshopNotification;
use App\Mail\NewWorkshopClientNotification;
use App\Mail\CanceledWorkshopTrainerNotification;
use App\Mail\CanceledWorkshopClientNotification;
use App\Models\Client;
use App\Models\Trainer;
use App\Models\Workshop;

class MailController extends Controller {

    /**
     * Send a notification Mail for new Workshops
     *
     * @param string $email
     * @param Workshop $workshops
     *
     * @return RedirectResponse
     */

    public function createdWorkshopNotification($email, Workshop $workshop): RedirectResponse
    {
        foreach ($workshop->trainers as $trainer){
            Mail::to($trainer->email)->send(new NewWorkshopNotification($workshop, $trainer));
        }

        if (count(Mail::failures()) > 0) {
            Session::flash('message', 'There seems to be a problem. Please try again in a while');
        } else {
            Session::flash('message', 'Thanks for your message. Please check your mail for more details!');
        }
        return redirect()->back();
    }

    /**
     * Send a notification Mail
     *
     * @param string $email
     * @param Workshop $workshop
     *
     * @return RedirectResponse
     */

    public function updatedWorkshopNotification(Workshop $workshop, $clients): RedirectResponse
    {
        foreach ($workshop->trainers as $trainer){
            Mail::to($trainer->email)->send(new NewWorkshopClientNotification($workshop, $clients, $trainer));
        }

        if (count(Mail::failures()) > 0) {
            Session::flash('message', 'There seems to be a problem. Please try again in a while');
        } else {
            Session::flash('message', 'Thanks for your message. Please check your mail for more details!');
        }
        return redirect()->back();
    }
    /**
     * Send a notification Mail
     *
     * @param string $email
     * @param Workshop $workshop
     *
     * @return RedirectResponse
     */

    public function canceledWorkshopNotification(Workshop $workshop): RedirectResponse
    {
        foreach ($workshop->trainers as $trainer){
            Mail::to($trainer->email)->send(new CanceledWorkshopTrainerNotification($workshop, $trainer));
        }
        foreach ($workshop->clients as $client){
            Mail::to($client->email)->send(new CanceledWorkshopClientNotification($workshop, $client));
        }

        if (count(Mail::failures()) > 0) {
            Session::flash('message', 'There seems to be a problem. Please try again in a while');
        } else {
            Session::flash('message', 'Thanks for your message. Please check your mail for more details!');
        }
        return redirect()->back();
    }
    /**
     * Send a notification Mail for new Workshops
     *
     * @param string $email
     * @param Webex $webex
     *
     * @return RedirectResponse
     */

    public function createdWebExNotification(Webex $webex, $id): RedirectResponse
    {
        $trainer  = Trainer::where('id', $id)->firstOrFail();
        Mail::to($trainer->email)->send(new NewWebexNotification($webex, $trainer));


        if (count(Mail::failures()) > 0) {
            Session::flash('message', 'There seems to be a problem. Please try again in a while');
        } else {
            Session::flash('message', 'Thanks for your message. Please check your mail for more details!');
        }
        return redirect()->back();
    }
    /**
     * Send a notification Mail
     *
     * @param string $email
     * @param Webex $webex
     *
     * @return RedirectResponse
     */

    public function updatedWebexNotification(Webex $webex, $clients): RedirectResponse
    {
        foreach ($webex->trainers as $trainer){
            Mail::to($trainer->email)->send(new NewWebexClientNotification($webex, $clients, $trainer));
        }

        if (count(Mail::failures()) > 0) {
            Session::flash('message', 'There seems to be a problem. Please try again in a while');
        } else {
            Session::flash('message', 'Thanks for your message. Please check your mail for more details!');
        }
        return redirect()->back();
    }
}
