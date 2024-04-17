<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(Request $request)
    {

        if($request->ord == null){
            $ord = 'desc';
        } else {
            $ord = $request->ord;
        }

        if($request->sortBy == null){
            $order = 'role';
        } else if($request->sortBy == 'name') {
            $order = 'first_name';
        } else if($request->sortBy == 'card id') {
            $order = 'card_id';
        } else {
            $order = $request->sortBy;
        }

        return view('management.index', [
            'employees' => User::whereIn('role', ['manager', 'worker'])
                            ->where(fn($q) => (
                                $q->where('first_name', 'like', '%' . $request->search . '%')
                                ->orwhere('last_name', 'like', '%' . $request->search . '%')))
                            ->orderBy($order, $ord)
                            ->paginate(30),
        ]);
    }
}
