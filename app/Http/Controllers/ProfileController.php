<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profiles.index');
    }

    public function edit(User $user)
    {

        $auth = Auth::user();
        if ($auth != $user) {
            return route('profileEdit', $auth->username);
        }

    }

}
