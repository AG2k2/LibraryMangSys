<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\GuestBorrow;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReturnController extends Controller
{
    public function create()
    {
        return view('dashboard.create-return');
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_id' => ['bail', 'required', 'integer'],
            'ISBN' => ['bail', 'required', 'integer'],
            'type_user' => ['bail', 'required', 'string']
        ]);

        if ($request['type_user'] === 'user') {

            $this->userReturn($request['card_id'], $request['ISBN']);
            return redirect()->back()->with('success', 'Book has returned.');

        } else if ($request['type_user'] === 'guest') {

            $this->guestReturn($request['card_id'], $request['ISBN']);
            return redirect()->back()->with('success', 'Book has returned.');

        } else {

            return back();

        }


    }

    private function userReturn(int $cardID, int $isbn)
    {
        try {
            $borrow = Borrow::whereHas('user', fn($q) => $q->where('card_id', $cardID))
                            ->whereHas('book', fn($q) => $q->where('ISBN', $isbn))
                            ->where('return_at', null)
                            ->firstOrFail();
        } catch (ModelNotFoundException) {
            throw ValidationException::withMessages([
                'card_id' => 'Card ID or book ISBN is not right.'
            ]);
        }
        $borrow->update(['return_at' => Carbon::today()]);

        $book = Book::where('ISBN', $isbn)->firstOrFail();
        $book->update(['available' => $book->available + 1]);
    }

    private function guestReturn(int $cardID, int $isbn)
    {
        try {
            $borrow = GuestBorrow::where('card_id', $cardID)
                                ->whereHas('book', fn($q) => $q->where('ISBN', $isbn))
                                ->where('return_at', null)
                                ->firstOrFail();
        } catch (ModelNotFoundException) {
            throw ValidationException::withMessages([
                'card_id' => 'Card ID or book ISBN is not right.'
            ]);
        }
        $borrow->update(['return_at' => Carbon::today()]);

        $book = Book::where('ISBN', $isbn)->firstOrFail();
        $book->update(['available' => $book->available + 1]);
    }


}
