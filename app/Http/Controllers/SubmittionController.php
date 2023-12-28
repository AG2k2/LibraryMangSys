<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubmittionController extends Controller
{
    public function update(User $user)
    {

        $user->update(['enroll_submitted_at' => Carbon::today()]);

        return redirect()->back()->with('success', 'Student submitted successfully.');
    }

    public function destroy(User $user)
    {

        // TODO send a messge to the user email.

        $user->delete();

        return redirect()->back()->with('success', 'Request declined and student deleted');
    }


}
