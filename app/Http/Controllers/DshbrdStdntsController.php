<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DshbrdStdntsController extends Controller
{
    public function index()
    {

        return view('dashboard.students', [
            'students' => User::with('books')
                                    ->where('role', '<>', 'librarian')
                                    ->where('enroll_submitted_at', '<>', null)
                                    ->filter(request(['stdntSearch']))
                                    ->orderBy($this->sortByFilter(), $this->orderType())
                                    ->paginate(30),
        ]);

    }

    public function show(User $user)
    {

        return view('dashboard.stdntShow', [
            'student' => $user,
            'books' => $user->books,
        ]);

    }

    public function enrollRequest()
    {

        return view('dashboard.enrl-req', [
            'students' => User::with('books')
                                    ->where('role', '<>', 'librarian')
                                    ->where('enroll_submitted_at', '=', null)
                                    ->filter(request(['stdntSearch']))
                                    ->orderBy($this->sortByFilter(), $this->orderType())
                                    ->paginate(30),
        ]);

    }

    protected function orderType()
    {

        $ord = 'desc';
        if(request('ord')){ $ord = request('ord'); }

        return $ord;

    }

    protected function sortByFilter()
    {
        $sortBy = 'ID';

        if (request('sortBy') ?? false) {
            switch (request('sortBy')){
                case ('joined-in'):
                    $sortBy = 'created_at';
                    break;
                case ('name'):
                    $sortBy = 'first_name';
                    break;
                case ('email-verification'):
                    $sortBy = 'email_verified_at';
                    break;
                default:
                    $sortBy = request('sortBy');
            }
        }

        return $sortBy;

    }


}
