<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'card_id' => ['bail', 'required', 'integer', 'unique:users,card_id'],
            'first_name' => ['bail', 'required', 'string'],
            'last_name' => ['bail', 'required', 'string'],
            'username' => ['bail', 'required', 'string', 'unique:users,username'],
            'email' => ['bail', 'required', 'string', 'email', 'unique:users,email'],
            'address' => ['bail', 'required', 'string'],
            'gender' => ['bail', 'required'],
            'birth_date' => ['bail', 'required', 'date'],
            'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
        ]);

        $attributes['role'] = 'student';
        $user = User::create($attributes);

        // event(new Registered($user));

        auth()->login($user);

        return redirect()->route('verification.notice');
    }
}
