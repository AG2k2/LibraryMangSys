<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DshbrdBooksController extends Controller
{
    public function index()
    {
        return view('dashboard.books', [
            'books' => Book::with('students', 'author')->filter(request(['bkSearch']))->orderBy($this->sortByFilter(), $this->orderType())->paginate(30),
        ]);

    }

    public function show(Book $book)
    {

        return view('dashboard.bkShow', [
            'book' => $book,
            'students' => $book->students,
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

        $sortBy = 'created_at';

        if (request('sortBy') ?? false) {
            $sortBy = request('sortBy');
        }

        return $sortBy;

    }


}
