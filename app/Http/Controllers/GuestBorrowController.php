<?php

namespace App\Http\Controllers;

use App\Models\GuestBorrow;
use Illuminate\Http\Request;

class GuestBorrowController extends Controller
{
    public function index()
    {
        return view('dashboard.guest-borrows', [
            'borrows' => GuestBorrow::with('book')
                                ->filter(request(['stdntSearch', 'bkSearch']))
                                ->orderByDesc('created_at')
                                ->paginate(30),
        ]);
    }
}
