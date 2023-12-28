<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBorrow extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeFilter($q, array $filters)
    {
        $q -> when($filters['stdntSearch'] ?? false, function ($q, $search) {
            $q->where('first_name', $search)
                ->orwhere('last_name', $search)
                ->orwhere('card_id', $search);
        });

        $q->when($filters['bkSearch'] ?? false, fn($q, $search) => (
            $q->whereHas('book', fn($q) =>(
                $q->where('title', 'like', '%' . $search . '%')
                    ->orwhere('ISBN', $search)
            ))
        ));
    }

}
