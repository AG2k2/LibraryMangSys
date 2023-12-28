<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'card_id' => ['bail', 'required', 'integer'],
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
        auth()->login(User::create($attributes));

        return redirect('/books')->with('success', '');
    }
}
