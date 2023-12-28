<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'borrows' => Borrow::with('user', 'book')
                                ->where('taken_at', '<>', null)
                                ->orderByDesc('taken_at')
                                ->paginate(30),
        ]);
    }

}
