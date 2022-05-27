<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Exports\BusinessesExport;
use Maatwebsite\Excel\Facades\Excel;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,phone,created_at,updated_at']
        ]);

        $query = User::query();

        if (request('search')) {
            $query->role('User')->where('name', 'LIKE', '%' . request('search') . '%')
                // ->where()
                ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                ->orWhere('phone', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        if (request()->has(['start_date', 'end_date'])) {
            $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
        }
        return Inertia::render('Admin/Business/Index', [
            'users' => $query->role('User')->with('roles')->paginate(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Admin/Business/Create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);
        $request['email_verified'] = now();
        $request['password'] = Hash::make($request['password']);
        try {
            $user = User::create($request->all());
            $user->assignRole($request['role']);
            return back()->with('success', 'User created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['roles', 'tickets'])->find($id);
        return Inertia::render('Admin/Business/Show', ['business' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ser  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Business/Edit', ['user' => $user, 'roles' => $user->roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $val = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if (!is_null($request['password'])) {
            $request['password'] = Hash::make($request['password']);
            $user->password = $request['password'];
        }
        $user->updated_at = now();
        $user->assignRole($request['role']);
        if ($user->save()) {
            return back()->with('success', 'User updated successfully');
        } else {
            return back()->with('error', 'User did not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('kitchn.user.index')->with('success', 'Delete Successfull');
    }
    public function export()
    {
        return Excel::download(new BusinessesExport, 'businesses-' . now() . '.xlsx');
        // return back();

    }
}
