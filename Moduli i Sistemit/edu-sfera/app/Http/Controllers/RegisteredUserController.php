<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'uni' => ['required'],
            'location' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(5)->letters()->numbers()->max(20), 'confirmed'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('img')) {

            $originalFileName = $request->file('img')->getClientOriginalName();

            $validated['img'] = $request->file('img')->storeAs('images', $originalFileName, 'public');
        } else {
            $validated['img'] = 'default.jpg';
        }

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/');
    }
}