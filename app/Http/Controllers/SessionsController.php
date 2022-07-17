<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    public function store()
    {
        //validation
        $attributes=request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //authentication
        if(auth()->attempt($attributes)){
            session()->regenerate();
            //session fixation

            //redirect with a success flash message
            return redirect('/')->with('success','Welcome Back!');
        }

        //auth failed
        throw ValidationException::withMessages(['email'=>'Your provided credentials are wrong!']);
        //another way
        // return back()->withInput()
        // ->withErrors(['email'=>'Your provided credentials are wrong!']);

    }
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'GoodBye bro!');
    }
}
