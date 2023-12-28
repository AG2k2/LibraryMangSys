<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\GuestBorrow;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function update(Borrow $borrow)
    {

        if($borrow->book->available == 0 ) {
            return back()->with('failure', "This book isn't available to borrow" );
        }

        $borrow->update(['taken_at' => Carbon::today()]);
        $book = $borrow->book;
        $book->update(['available' => $book->available - 1]);

        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    public function destroy(Borrow $borrow)
    {
        // TODO SEND MSG TO THE USER EMAIL.

        $borrow->delete();

        return redirect()->back()->with('success', 'Request declined and deleted.');

    }

    public function create()
    {
        return view('dashboard.create-req');
    }

    public function store()
    {
        request()->validate([
            'ISBN' => ['bail', 'required', 'exists:books,ISBN'],
        ]);

        $book = Book::where('ISBN', request('ISBN'))->first();

        if ($book->available == 0){
            return back()->with('failure', 'This book has no copies available');
        }

        if(request('user') == 'guest'){

            $attributes = request()->validate([
                'first_name' => ['bail', 'required', 'string'],
                'last_name' => ['bail', 'required', 'string'],
                'address' => ['bail', 'required'],
                'gender' => ['bail', 'required'],
                'occupation' => ['bail', 'required', 'string'],
                'phone_no' => ['bail', 'required', 'string'],
                'birth_date' => ['bail', 'required', 'date'],
                'card_id' => ['bail', 'required', 'integer'],
            ]);

            $attributes['book_id'] = $book->id;

            if (GuestBorrow::where('card_id', $attributes['card_id'])->where('return_at', null)->count() >= 3){
                return back()->with('failure', 'This guest has reached maximum number of borrowing');
            }

            $borrowed = GuestBorrow::whereHas('book', fn($q) => $q->where('ISBN', $book->ISBN))
                        ->where('card_id', $attributes['card_id'])
                        ->where('return_at', null)
                        ->first();

            if($borrowed ?? false){
                return back()->with('failure', 'This Guest has already borrowed this book');
            } else {
                GuestBorrow::create($attributes);
                return back()->with('success', 'Operation successed');
            }

        } else if (request('user') == 'enrolled') {

            request()->validate([
                'card_id' => ['bail', 'required', 'exists:users,card_id']
            ]);

            $user = User::where('card_id', request('card_id'))->first();

            if($user->books->contains($book)){
                if($user->books->find($book)->pivot->return_at == null){
                    return back()->with('failure', 'The user has borrowed already this book.');
                }
            }

            $user->books()->attach($book);
            $user->books->first()->pivot->update(['taken_at' => Carbon::today()]);

            $book->update(['available' => $book->available - 1]);

            return back()->with('success', 'Operation successed');

        } else {

            $user = User::where('id', Auth::user()->id)->first();

            if($user->books->contains($book)){
                if($user->books->find($book)->pivot->return_at == null){
                    return back()->with('failure', 'The user has borrowed already this book.');
                }
            }

            $user->books()->attach($book);
            return back()->with('success', 'Your request to borrow this book has been sent.');

        }

    }

}
