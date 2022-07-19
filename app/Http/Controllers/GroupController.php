<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('groups.show-groups');
    }

}
