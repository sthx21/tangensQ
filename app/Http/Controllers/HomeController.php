<?php

namespace App\Http\Controllers;


use App\Mail\faceToFaceMail;
use App\Mail\NewWorkshopNotification;
use App\Models\Client;
use App\Models\Company;
use App\Models\Trainer;
use App\Models\Workshop;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;


class HomeController extends Controller

{
    function shortenTitle($text, $maxchar, $end = '...')
    {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i = 0;
            while (1) {
                $length = strlen($output) + strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } else {
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
    {        $today = Carbon::today();

        $companies = Company::take(5)->get()->reverse();
        $clients = Client::with('workshops')->take(5)->get()->reverse();
        $allWorkshops = Workshop::whereCanceled(0)
            ->where('cancellation_date', '>', $today)
            ->where('cancellation_date', '<', $today->copy()->addDays(46))
            ->get();
        $dashboardCollection = $this->setWorkshops($allWorkshops);
//dd($dashboardCollection->urgentWorkshops->take(5));
        return view('dashboard', compact( 'clients', 'companies', 'dashboardCollection'));
    }

    public function setWorkshops($allWorkshops): Collection
    {
        $today = Carbon::today();
        $collection = collect();
        $urgentWorkshops = collect();
        $upcomingWorkshops = collect();

        foreach ($allWorkshops as $workshop) {
            if (!isset($workshop->end_date)) {
                $workshop->end_date = $workshop->start_date;
            }
            $workshop->reserved = $workshop
                ->clients()
                ->wherePivot('status' , '=', 'Reserviert')
                ->get()
                ->count();
            $workshop->booked = $workshop->clients()->wherePivot('status' , '=', 'Gebucht')->get()->count();
            $workshop->title = $this->shortenTitle($workshop->title, 50);
            $workshop->start_date = Carbon::create($workshop->start_date);
            $workshop->end_date = Carbon::create($workshop->end_date);
            $workshop->cancellation_date = Carbon::create($workshop->cancellation_date);
            $workshop->cancel_days = $today->diffInDays($workshop->cancellation_date);

            if ($workshop->start_date->isBetween($today, $today->copy()->addDays(48))) {
                $upcomingWorkshops->add($workshop);
            }
        }
        $collection->latestWorkshops = $allWorkshops->take(5)->reverse();
        $collection->urgentWorkshops = $allWorkshops;
//        lessThan carbon
        $collection->upcomingWorkshops = $upcomingWorkshops;
        return $collection;
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
