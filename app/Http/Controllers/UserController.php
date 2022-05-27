<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Http\Traits\PageCount;

class UserController extends Controller
{
    use PageCount;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->input('id'));
        dd($user);
        $val = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'business' => 'required',
            'msme' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required'
        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->business = $request['business'];
        $user->msme = $request['msme'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        $user->updated_at = now();
        $user->assignRole($request['role']);
        if ($user->save()) {
            return back()->with('success', 'User updated successfully');
        } else {
            return back()->with('error', 'User did not update');
        }
    }
    public function password()
    {
        $this->counter();
        return Inertia::render('Profile/Password');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
