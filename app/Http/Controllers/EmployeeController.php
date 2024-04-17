<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function update(User $user){

        if(!in_array($user->role, ['worker', 'manager'])){
            return back();
        }

        request()->validate([
            'role' => ['bail', 'required'],
        ]);

        $user->update(['role'=>request('role')]);
        return back()->with(['success' => 'Updated successfully.']);

    }

    public function show(User $user){

        if(auth()->user()->role !=='manager'){
            return back();
        }

        return view('management.show', [
            'employee' => $user,
        ]);

    }
}
