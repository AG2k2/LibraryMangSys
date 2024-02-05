<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificaitonController extends Controller
{
    public function create()
    {
        return view('profiles.verify-email');
    }

    public function store(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }
}
