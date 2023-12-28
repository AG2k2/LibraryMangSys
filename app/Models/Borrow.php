<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['stdntSearch'] ?? false, function ($query, $search){
            $search = explode(' ', $search);
            return $query->whereHas( 'user', fn($query) =>
                    $query->whereIn('first_name', $search)
                        ->orwhere( fn($query) =>
                            $query->whereIn('last_name', $search))
                        ->orwhere( fn($query) =>
                            $query->whereIn('ID', $search)
        ));});

        $query->when($filters['bkSearch'] ?? false, function ($query, $search){
            return $query->whereHas( 'book', fn($query)=>
                    $query->where('title', 'like', '%'.$search.'%')
                    ->orwhere( 'ISBN', $search)
                    ->orwhere( 'DDC', $search)
        );});

    }

}
