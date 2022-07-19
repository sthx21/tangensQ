<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Builder;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::orderBy('id','DESC');
        $roles = Role::all();
        return view('edmin.users.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('edmin.users.create-users', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user): View
    {
        return view('edmin.users.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user): View
    {
//        try {
//            $user = User::where('id', $id)->firstOrFail();
//        } catch (ModelNotFoundException $exception) {
//            abort(404);
//        }
        $roles = Role::all();
        $roles = $roles->except(4);
        $userRole = $user->roles->pluck('name','name')->all();
        return view('edmin.users.edit-user', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
//            changed $id to $user->
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->save();
        $user->delete();

        return redirect()->route('users.index')

            ->with('success','User deleted successfully');
    }
//TODO Livewire Edit User
    public function getUsers(Request $request)
    {
        define("edit", trans('users.buttons.edit'));
        define("show", trans('users.buttons.show'));

        define("openModal", "'openModal', 'edit-user'");

        if ($request->ajax()) {
            $data = User::with('roles')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function (User $user) {
                    return $user->roles->map(fn($roles) => $roles->name)->implode('  ');
                })
                ->addColumn('action', function ($user) {
                    return '<a href="/users/' . $user->id .'" class="btn btn-sm btn-primary">' . show . '</a>
                             <button onclick="Livewire.emit('.openModal.')" class="btn btn-sm btn-info">'. edit .'</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
