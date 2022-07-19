<?php

namespace App\Http\Controllers;


use App\Http\Controllers\MailController as Mailer;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Company;
use App\Models\Staff;
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
use App\DataTables\staffsDataTable;
use Yajra\DataTables\Html\Button;


class StaffController extends Controller

{
    /**
     * Store a newly created resource in storage.
     *
     *
     * @return View
     */
    public function create()
    {

        return view('staff.create-staff');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStaffRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStaffRequest $request)
    {

        $attributes = collect($request->validated())->except(['_token', 'workshop_id'])->toArray();
        $staff = new Staff($attributes);
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $staff->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
        $staff->save();
        $staff->workshops()->attach($request->input('workshop_id'));
        //If Staff directly added to an existing Workshop -> mail updated staffs list
        if ($request->input('workshop_id')) {
            $newWorkshop = Workshop::where('id', $request->input('workshop_id'))->firstOrFail();
            //send mail to trainers with updated Staff list
            $notification = new Mailer();
            $notification->updatedWorkshopNotification($newWorkshop, $newWorkshop->staffs);

        }
        $this->tagging($request, $staff);
        return redirect('staffs')->with('success', trans('staffs.createSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     *
     * @return Redirector
     */
    public function destroy(Request $request, Staff $staff)
    {
        if ($request->ajax()) {
            $oldStaff = $staff;
            $staff->save();
            $staff->delete();
            //TODO not for ended or canceled Workshops
            foreach ($oldStaff->workshops as $workshop) {
                //send mail to trainers with updated Staff list
                $notification = new Mailer();
                $notification->updatedWorkshopNotification($workshop, $workshop->staffs);
            }
        }
    }
    // DO Not Delete, livewire CreateTrainer connected
    public function storeLogo($id, $logo)
    {
        $staff = Staff::where('id', $id)->firstOrFail();
        $staff->clearMediaCollection('staffLogo');
        $staff->addMedia($logo)
            ->setFileName($staff->last_name.'_'.$staff->first_name.'.jpg')
            ->toMediaCollection('staffLogo');
        $staff->save();
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
     * @param Staff $staff
     *
     * @return View
     */
    public function show($slug)
    {
        try {
            $staff = Staff::where('slug', $slug)->with('media')->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return view('staff.show-staff', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStaffRequest $request
     * @param Staff $staff
     *
     * @return RedirectResponse
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $update = collect(($request->validated()))->except('bookedWorkshops', 'addWorkshop', 'remove')->filter()->toArray();
        $staff->fill($update)->save();
        $this->editWorkshops($request, $staff);
        $this->tagging($update, $staff);
        return redirect('/staffs/' . $staff->slug)->with('success', trans('staffs.updateSuccess'));
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
            $staff = Staff::where('slug', $slug)->with('media')->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return view('staff.edit-staff',
            compact('staff'));
    }

    /**
     * Get Attachable Workshops
     *
     * @param Request $request
     * @param Staff $staff
     * @return JsonResponse
     */

    public function getAttachableWorkshops(Request $request, Staff $staff)
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
     * @param Staff $staff
     * @return JsonResponse
     */

    public function getCompanies(Request $request, Staff $staff)
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
     * //     * Displaying staffs with DataTables.
     * //     *
     * //     * @return View
     * //     */

    public function index()
    {

        return view('staff.show-staffs');
    }

//latest()->get
    public function getstaffs(Request $request)
    {
        define("edit", trans('staffs.buttons.edit'));
        define("show", trans('staffs.buttons.show'));
        if ($request->ajax()) {
            $data = Staff::with('company')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('company_id', function (Staff $staff) {
                    return $staff->company->name;
                })
                ->addColumn('action', function (Staff $staff) {
                    return '<a href="/staffs/' . $staff->slug . '/edit" class="btn btn-sm btn-warning">' . edit . '</a>
                             <a href="/staffs/' . $staff->slug . '" class="btn btn-sm btn-primary">' . show . '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * //     * Edit Staff Tags.
     * //     *
     * //     *
     * //     */
    public function tagging($update, $staff): void
    {
        if (!empty($update['tags'])) {
            $staff->tags()->sync($update['tags']);

        } elseif (empty($update['tags'])) {
            $staff->tags()->detach();
        }
        $tagNames = [];
        if (!empty($update['tag'])) {
            foreach ($update['tag'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName, 'slug' => Str::slug($tagName)]);
                if ($tag) {
                    $tagNames[] = $tag->id;
                }
            }
            $staff->tags()->attach($tagNames);
        }

    }

    /**
     * //     * Displaying staffs with DataTables.
     * //     *
     * //     * @return View
     * //     */
    public function editWorkshops($request, $staff)
    {
        if ($staff->media && $request->hasFile('avatar')) {
            $staff->clearMediaCollection('avatar');
            $staff->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        if ($request->input('addWorkshop')) {
            $newWorkshop = Workshop::where('id', $request->input('addWorkshop'))->firstOrFail();
            $staff->workshops()->attach($newWorkshop);
            //send mail to trainers with updated Staff list
            $notification = new Mailer();
            $notification->updatedWorkshopNotification($newWorkshop, $newWorkshop->staffs);
        }
        if ($request->input('remove')) {
            $removeWorkshop = collect(($request->input('remove')))->filter()->values();
            $staff->workshops()->detach($removeWorkshop);
            //send mail to trainers with updated Staff list
            foreach ($removeWorkshop as $remove) {
                $removed = Workshop::where('id', $remove)->firstOrFail();
                $notification = new Mailer();
                $notification->updatedWorkshopNotification($removed, $removed->staffs);
            }
        }
    }
}
