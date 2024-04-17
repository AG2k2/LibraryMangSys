<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }

    public function logIn()
    {

        $attributes = request()->validate([
            'username' => ['bail', 'required', 'string',],
            'password' => ['bail', 'required', 'string',]
        ]);

        if(!auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'username' => 'The provided credentials do not match our records.'
            ]);
        };

        session()->regenerate();

        if (in_array(auth()->user()->role, ["worker", "manager"])) {
            return redirect()->route('dashboard');
        }
        else {
            return redirect()->back();
        };

    }

    public function destroy()
    {
        auth()->logout();
        return redirect("/");
    }


}
