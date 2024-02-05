<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', [
            'books' => Book::latest()
                            ->filter(request(['search', 'category', 'availability']))
                            ->paginate(21),
        ]);
    }

    public function show(Book $book)
    {
        return view('books.show', [
            'book' => $book,
            'isBorrowed' => $book->users->contains(auth()->user())
        ]);
    }

    public function create()
    {

        if (request('search') ?? false) {
            request()->validate([
                'search' => ['bail', 'exists:books,ISBN']
            ]);
            return redirect("books/" . request('search') . "/edit");
        }

        return view('books.create');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'cover' => ['bail', 'image'],
            'title' => ['bail', 'required'],
            'ISBN' => ['bail', 'required', 'integer', 'unique:books,ISBN'],
            'DDC' => ['bail', 'required', 'string'],
            'description' => ['bail', 'required'],
            'published_at' => ['bail', 'required', 'date'],
            'copies_no' => ['bail', 'required', 'integer', 'min:1']
        ]);

        $request->validate([
            'author' => ['bail', 'required', 'exists:authors,name'],
            'categories' => ['bail'],
        ]);

        if ($request->cover ?? false) {
            $attributes['cover'] = request()->file('cover')->store('covers');
        }

        $attributes['author_id'] = Author::where('name', $request->author)->first()->id;


        $attributes['published_at'] = Carbon::parse($attributes['published_at']);
        $attributes['available'] = $attributes['copies_no'];


        $cats = explode('-', preg_replace('/\s+/', '', $request->categories));

        foreach( $cats as $category) {
            if(empty($category)) { continue; }
            try {
                $categories[] = Category::where('slug', $category)
                                        ->orWhere('name', $category)
                                        ->firstOrFail()->id;
            } catch (ModelNotFoundException) {
                throw ValidationException::withMessages([
                    'category' => "The category {$category} doesn't exist."
                ]);
            };
        }

        $book = Book::create($attributes);

        $book->categories()->sync($categories);

        return back()->with('success', 'Book is added successfully.');

    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'book' => $book,
        ]);
    }

    public function update(Book $book, Request $request)
    {

        $attributes = $request->validate([
            'cover' => ['bail', 'image'],
            'title' => ['bail', 'required'],
            'DDC' => ['bail', 'required', 'string'],
            'description' => ['bail', 'required'],
            'published_at' => ['bail', 'required', 'date'],
            'copies_no' => ['bail', 'required', 'integer']
        ]);

        $request->validate([
            'author' => ['bail', 'required', 'exists:authors,name'],
        ]);

        if ($request->cover ?? false) {
            Storage::disk('public')->delete($book->cover);
            $attributes['cover'] = $request->file('cover')->store('covers', 'public');
        }
        $attributes['published_at'] = Carbon::parse($attributes['published_at']);


        $copiesAdded = $attributes['copies_no'] - $book->copies_no;
        $attributes['available'] = $book->available + $copiesAdded;
        if($attributes['available'] < 0) {
            throw ValidationException::withMessages([
                'copies_no' => "There are " . $book->copies_no - $book->available . " copies borrowed."
            ]);
        }

        $book->update($attributes);
        return back()->with('success', "book's updated successfully.");

    }

    public function destroy(Book $book)
    {
        $book->delete();
    }
}
