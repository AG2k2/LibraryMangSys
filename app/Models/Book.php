<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'borrows')
                            ->orderByPivot('created_at', 'desc')
                            ->withPivot('taken_at')
                            ->withPivot('return_at')
                            ->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'borrows')
                            ->orderByPivot('created_at', 'desc')
                            ->withPivot('taken_at')
                            ->withPivot('return_at')
                            ->withTimestamps();
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function ($query, $search){
            return $query->where( fn($query)=>
                    $query->where('title', 'like', '%'.$search.'%')
        );});

        $query->when($filter['category'] ?? false, function ($query, $search){
            return $query->whereHas( 'categories', fn($q) =>
                        $q->where('slug', $search)
        );});
    }

    public function guests()
    {
        return $this->hasMany(GuestBorrow::class);
    }



}
