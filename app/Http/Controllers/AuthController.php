<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\PageCount;

class AuthController extends Controller
{
    use PageCount;
    public function login()
    {
        $this->counter();
        return Inertia::render('Login');
    }
    public function register()
    {
        $this->counter();
        return Inertia::render('Register');
    }
    public function signup(Request $request)
    {
        if (Auth::check()) {
            return back();
        }
        $request->validate([
            'phone' => 'regex:/^\+234[0-9]{10}/',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'),
            'msme' => $request->input('msme'),
            'phone' => $request->input('phone'),
            'business' => $request->input('business'),
            'category' => $request->input('category')['title'],
            'state' => $request->input('state')
        ]);
        $user->assignRole('User');
        foreach ($request->products as $product) {
            DB::table('products')->insert(['user_id' => $user->id, 'title' => $product]);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('ticket.create')->with('success', 'Signup Successful');
        } else {
            return back()->with('error', 'Could not create');
        }
    }
}
