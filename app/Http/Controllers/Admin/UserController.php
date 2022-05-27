<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Models\Service;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|HOD');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,service,created_at,updated_at']
        ]);

        $query = User::query();
        if (auth()->user()->hasRole('HOD')) {
            if (request('search')) {
                $query->role(['Admin', 'Agent', 'HOD'])->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('phone', 'LIKE', '%' . request('search') . '%');
            }
        }
        if (auth()->user()->hasRole('Admin')) {
            if (request('search')) {
                $query->role(['Admin', 'Agent', 'HOD'])->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('phone', 'LIKE', '%' . request('search') . '%');
            }
        }
        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }
        if (request()->has(['start_date', 'end_date'])) {
            $query->whereDate('created_at', '>=', request('start_date'))->whereDate('created_at', '<=', request('end_date'));
        }
        if (auth()->user()->hasRole('HOD')) {
            return Inertia::render('Admin/Users/Index', [
                'users' => $query->role(['Admin', 'Agent', 'HOD'])->with(['roles', 'departments'])->whereHas('departments', function ($q) {
                    $q->where('services.id', auth()->user()->departments[0]->id);
                })->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }
        if (auth()->user()->hasRole('Admin')) {
            return Inertia::render('Admin/Users/Index', [
                'users' => $query->role(['Admin', 'Agent', 'HOD'])->with(['roles', 'departments'])->paginate(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasRole('Admin')) abort(403);
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) abort(403);

        $val = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role' => 'required',
            'department' => 'required'
        ]);
        $request['email_verified'] = now();
        $request['password'] = Hash::make($request['password']);
        try {
            $user = User::create($request->all());
            $user->assignRole($request['role']);
            $user->departments()->attach($request['department']);
            return back()->with('success', 'User created successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            // return back()->with('error', 'Not created ');
            return back()->with('error', 'Not created: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ser  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'useri' => $user,
            'userRoles' => $user->roles,
            'departments' => $user->departments
        ]);
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
        if (!auth()->user()->hasRole('Admin')) abort(403);

        $val = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'department' => 'required'
        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if (!is_null($request['password'])) {
            $request['password'] = Hash::make($request['password']);
            $user->password = $request['password'];
        }
        $user->updated_at = now();


        if ($user->save()) {
            $u = User::find($user->id);
            if (!$u->departments->contains($request['department'])) {
                $u->departments()->attach($request['department']);
            }
            $u->assignRole($request['role']);
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
        if (!auth()->user()->hasRole('Admin')) abort(403);

        $user->delete();
        return redirect()->route('kitchn.user.index')->with('success', 'Delete Successfull');
    }
    public function removeDept($department, $user)
    {
        if (!auth()->user()->hasRole('Admin')) abort(403);

        $user = User::find($user);
        // dd($user->departments);
        if ($user->departments->count() == 1) {
            return back()->with('error', 'User must have a department');
        } else {
            $user->departments()->detach($department);
            // return auth()->user()->departments;
            return back()->with('success', 'User removed from ' . $department);
        }
    }

    public function removeRole($role, $user)
    {
        if (!auth()->user()->hasRole('Admin')) abort(403);

        $user = User::find($user);
        if ($user->roles()->count() == 1) {
            return back()->with('error', 'User must have at least one role');
        }
        $user->removeRole($role);

        return back()->with('success', 'Role Deleted successfully');
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users-' . now() . '.xlsx');
        // return back();

    }
}
