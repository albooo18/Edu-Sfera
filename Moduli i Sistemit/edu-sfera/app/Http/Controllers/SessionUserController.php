<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionUserController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    
    public function store()
    {
        $validated = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Auth::attempt($validated);

        request()->session()->regenerate();

        return redirect('/');
    }

    public function destroy(){
        Auth::logout();

        return redirect('/login');
    }
}
