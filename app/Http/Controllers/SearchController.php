<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Trainer;
use App\Models\Webex;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Workshop;

class SearchController extends Controller
{
    /**
     * Show Global Search Results
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearchResults(Request $request)
    {
        $workshops = [];
        $clients = [];
        $trainers = [];
        $webexes = [];
        $companies = [];

        if($request->has('q')){
            $search = $request->q;
            $workshops = Workshop::with('clients')->select("id", "title", "slug", "location", "start_date")
                ->where('title', 'LIKE', "%$search%")
                ->get();
            $webexes = Webex::select("id", "title", "slug", "start_date")
                ->where('title', 'LIKE', "%$search%")
                ->get();
            $clients = Client::with('company')->select("id", "last_name", "slug", "first_name", "company_id")
                ->where('last_name', 'LIKE', "%$search%")
                ->get();
            $trainers = Trainer::select("id", "last_name", "slug", "first_name")
                ->where('last_name', 'LIKE', "%$search%")
                ->get();
            $companies = Company::with('clients', 'workshops')->select("id", "name", "slug", "hr_last_name")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('hr_last_name', 'LIKE' ,"%$search%")
                ->get();
        }
        foreach ($clients as $client) {
            $client->baseUrl = '/clients/';
            $client->work = $client->company;
        }
        foreach ($workshops as $workshop) {
            $workshop->baseUrl = '/workshops/';
        }
        foreach ($webexes as $webex) {
            $webex->baseUrl = '/webex/';
        }
        foreach ($trainers as $trainer) {
            $trainer->baseUrl = '/trainers/';
        }
        foreach ($companies as $company) {
            $company->baseUrl = '/companies/';
        }

        $results = $clients->merge($workshops)->merge($trainers)->merge($companies)->merge($webexes);
        return response()->json($results);
    }
    //
}
