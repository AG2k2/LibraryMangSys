<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function books($sortBy = 'created_at', $ord = 'desc')
    {
        return $this->belongsToMany(Book::class, 'borrows')
                            ->orderByPivot($sortBy, $ord)
                            ->withPivot('taken_at')
                            ->withPivot('return_at')
                            ->withTimestamps();
    }

    public function scopeFilter($query, array $filter)
    {

        $query->when($filter['stdntSearch'] ?? false, function ($query, $search){
            $search = explode(' ', $search);
            return $query->where( fn($query) =>
                    $query->whereIn('first_name', $search)
                        ->orwhere( fn($query) =>
                            $query->whereIn('last_name', $search))
                        ->orwhere( fn($query) =>
                            $query->whereIn('ID', $search)
        ));});
    }

    public function unReturnedBooks()
    {
        return $this->belongsToMany(Book::class)->wherePivot('return_at', '=', null)
                                                ->withPivot('return_at')
                                                ->withTimestamps();
    }

}
