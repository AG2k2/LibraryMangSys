<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowReqController extends Controller
{
    public function index()
    {

        return view('dashboard.borrow-req', [
            'requests' => Borrow::with('user', 'book')
                                    ->where('taken_at', null)
                                    ->filter(request(['stdntSearch', 'bkSearch']))
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(30),
        ]);

    }
}
