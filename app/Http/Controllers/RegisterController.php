<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create', []);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'min:3', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:7'],
        ]);


        auth()->login(User::create($attributes));

        // session()->flash('success','Now you are registered !');
        return redirect('/')->with('success', 'Now you are registered !');
    }
}
