<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        return view('authors.index', [
        'authors' => Author::latest()->filter(request(['search']))->orderBy('name')->paginate(20),
    ]);
    }

    public function show(Author $author)
    {
        return view('authors.show', [
            'author' => $author,
        ]);
    }

    public function create()
    {

        if (request('search') ?? false) {
            request()->validate([
                'search' => ['bail', 'exists:authors,name']
            ]);

            $author = Author::where('name', request('search'))->get();

            if($author->count() > 1) {
                return view('authors.create', [
                    'authors' => $author,
                ]);
            }

            return redirect("books/" . request('search') . "/edit");
        }

        return view('authors.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'auth_pic' => ['bail', 'image'],
            'name' => ['bail', 'required'],
            'birth_year' => ['bail', 'required'],
            'death_year' => ['bail', 'required'],
            'excerpt' => ['bail', 'required'],
        ]);

        $attributes['auth_pic'] = request()->file('auth_pic')->store('authors');

        $attributes['birth_year'] = Carbon::parse($attributes['birth_year']);
        $attributes['death_year'] = Carbon::parse($attributes['death_year']);

        Author::create($attributes);

        return back()->with('success', 'Author created sucessfully.');

    }

    public function edit(Author $author)
    {
        return view('authors.edit', [
            'author' => $author,
        ]);
    }

    public function update(Request $request, Author $author)
    {
        $attributes = $request->validate([
            'auth_pic' => ['bail', 'image'],
            'name' => ['bail', 'required'],
            'birth_year' => ['bail', 'required'],
            'death_year' => ['bail', 'required'],
            'excerpt' => ['bail', 'required'],
        ]);

        if ($request->auth_pic ?? false) {
            $attributes['auth_pic'] = request()->file('auth_pic')->store('authors');
        }

        $author->update($attributes);

        return back()->with('success', 'Author updated sucessfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();
    }

}
