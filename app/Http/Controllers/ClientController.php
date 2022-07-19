<?php

namespace App\Http\Controllers;


use App\Http\Controllers\MailController as Mailer;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Company;
use App\Models\Client;
use App\Models\Tag;
use App\Models\Workshop;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\DataTables\ClientsDataTable;
use Yajra\DataTables\Html\Button;


class ClientController extends Controller

{
    /**
     * Store a newly created resource in storage.
     *
     *
     * @return View
     */
    public function create()
    {

        return view('clients.create-client');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request)
    {

        $attributes = collect($request->validated())->except(['_token', 'workshop_id'])->toArray();
        $client = new Client($attributes);
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $client->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
        $client->save();
        $client->workshops()->attach($request->input('workshop_id'));
        //If Client directly added to an existing Workshop -> mail updated clients list
        if ($request->input('workshop_id')) {
            $newWorkshop = Workshop::where('id', $request->input('workshop_id'))->firstOrFail();
            //send mail to trainers with updated client list
            $notification = new Mailer();
            $notification->updatedWorkshopNotification($newWorkshop, $newWorkshop->clients);

        }
        $this->tagging($request, $client);
        return redirect('clients')->with('success', trans('clients.createSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     *
     * @return Redirector
     */
//    public function destroy(Request $request, Client $client)
//    {
//        if ($request->ajax()) {
//            $oldClient = $client;
//            $client->save();
//            $client->delete();
//            //TODO not for ended or canceled Workshops
//            foreach ($oldClient->workshops as $workshop) {
//                //send mail to trainers with updated client list
//                $notification = new Mailer();
//                $notification->updatedWorkshopNotification($workshop, $workshop->clients);
//            }
//        }
//    }
    // DO Not Delete, livewire CreateTrainer connected
    public function storeLogo($id, $logo)
    {
        $client = Client::where('id', $id)->firstOrFail();
        $client->clearMediaCollection('clientLogo');
        $client->addMedia($logo)
            ->setFileName($client->last_name.'_'.$client->first_name.'.jpg')
            ->toMediaCollection('clientLogo');
        $client->save();
    }
    public function transferLogo($id, $url)
    {
        $client = Client::where('id', $id)->firstOrFail();
        $client->addMediaFromUrl($url)
            ->setFileName($client->last_name.'_'.$client->first_name.'.jpg')
            ->toMediaCollection('clientLogo');
        $client->save();
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    /**
     * Display the specified resource.
     *
     * @param Client $client
     *
     * @return View
     */
    public function show($slug)
    {
//        try {
//            $client = Client::where('slug', $slug)->with('media')->firstOrFail();
//        } catch (ModelNotFoundException $exception) {
//            abort(404);
//        }

//        $client->bookedWorkshops = $client->workshops->diff(Workshop::where('status', 'Beendet')
//            ->orWhere('status', 'Storniert')
//            ->get()
//        );
//        foreach ($client->bookedWorkshops as $booked) {
//            $booked->start_date = Carbon::create($booked->start_date)->format('d.m.y');
//
////            $client->nextWorkshop
//        }
//        $client->workshopsHistory = $client->workshops->diff(Workshop::where('status', 'Aktiv')
//            ->orWhere('status', 'Inaktiv')
//            ->get());
//        foreach ($client->workshopsHistory as $history) {
//            $history->start_date = Carbon::create($history->start_date)->format('d.m.y');
//        }
        return view('clients.show-client', compact('slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param Client $client
     *
     * @return RedirectResponse
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $update = collect(($request->validated()))->except('bookedWorkshops', 'addWorkshop', 'remove')->filter()->toArray();
        $client->fill($update)->save();
        $this->editWorkshops($request, $client);
        $this->tagging($update, $client);
        return redirect('/clients/' . $client->slug)->with('success', trans('clients.updateSuccess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $slug
     *
     * @return View
     */
    public function edit($slug): View
    {

        try {
            $client = Client::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $bookedWorkshops = $client->workshops->diff(Workshop::where('status', 'Beendet')
            ->orWhere('status', 'Storniert')
            ->get()
        );
        foreach ($bookedWorkshops as $workshop) {
            $workshop->start_date = Carbon::create($workshop->start_date)->format('d.m.y');
        }

        $addWorkshop = '';
        $tags = Tag::orderBy('name', 'asc')->get();
        $companies = Company::pluck('id', 'name')->flip();
        return view('clients.edit-client',
            compact('client', 'bookedWorkshops', 'addWorkshop', 'companies', 'tags'));
    }

    /**
     * Get Attachable Workshops
     *
     * @param Request $request
     * @param Client $client
     * @return JsonResponse
     */

    public function getAttachableWorkshops(Request $request, Client $client)
    {
        $allWorkshops = [];
        if ($request->has('q')) {
            $search = $request->q;
            $allWorkshops = Workshop::select("id", "title", "slug", "location", "start_date")
                ->where('title', 'LIKE', "%$search%")
                ->where('status', 'LIKE', "%ktiv")
                ->get();
        }
        $results = $allWorkshops;
        return response()->json($results);
    }

    /**
     * Get Companies
     *
     * @param Client $client
     * @return JsonResponse
     */

    public function getCompanies(Request $request, Client $client)
    {
        $allCompanies = [];
        if ($request->has('q')) {
            $search = $request->q;
            $allCompanies = Company::select("id", "name", "slug")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($allCompanies);
    }

    /**
     * //     * Displaying Clients with DataTables.
     * //     *
     * //     * @return View
     * //     */

    public function index()
    {

        return view('clients.show-clients');
    }

//latest()->get
    public function getClients(Request $request)
    {
        define("edit", trans('clients.buttons.edit'));
        define("show", trans('clients.buttons.show'));
        if ($request->ajax()) {
            $data = Client::with('company')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('company_id', function (Client $client) {
                    return $client->company->name;
                })
                ->addColumn('action', function (Client $client) {
                    return '<a href="/clients/' . $client->slug . '/edit" class="btn btn-sm btn-warning">' . edit . '</a>
                             <a href="/clients/' . $client->slug . '" class="btn btn-sm btn-primary">' . show . '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * //     * Edit Client Tags.
     * //     *
     * //     *
     * //     */
    public function tagging($update, $client): void
    {
        if (!empty($update['tags'])) {
            $client->tags()->sync($update['tags']);

        } elseif (empty($update['tags'])) {
            $client->tags()->detach();
        }
        $tagNames = [];
        if (!empty($update['tag'])) {
            foreach ($update['tag'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName, 'slug' => Str::slug($tagName)]);
                if ($tag) {
                    $tagNames[] = $tag->id;
                }
            }
            $client->tags()->attach($tagNames);
        }

    }

    /**
     * //     * Displaying Clients with DataTables.
     * //     *
     * //     * @return View
     * //     */
    public function editWorkshops($request, $client)
    {
        if ($client->media && $request->hasFile('avatar')) {
            $client->clearMediaCollection('avatar');
            $client->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        if ($request->input('addWorkshop')) {
            $newWorkshop = Workshop::where('id', $request->input('addWorkshop'))->firstOrFail();
            $client->workshops()->attach($newWorkshop);
            //send mail to trainers with updated client list
            $notification = new Mailer();
            $notification->updatedWorkshopNotification($newWorkshop, $newWorkshop->clients);
        }
        if ($request->input('remove')) {
            $removeWorkshop = collect(($request->input('remove')))->filter()->values();
            $client->workshops()->detach($removeWorkshop);
            //send mail to trainers with updated client list
            foreach ($removeWorkshop as $remove) {
                $removed = Workshop::where('id', $remove)->firstOrFail();
                $notification = new Mailer();
                $notification->updatedWorkshopNotification($removed, $removed->clients);
            }
        }
    }
}
