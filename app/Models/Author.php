<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function scopeFilter($q, array $filters)
    {
        $q->when($filters['search'] ?? false, fn($q, $search) => (
            $q->where('name', 'like', '%' . $search . '%')
        ));
    }

}
