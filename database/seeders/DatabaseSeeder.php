<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\GuestBorrow;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory(50)->create();
        User::factory(50)->hasBooks(3)->create();
        Book::factory(50)->hasCategories(2)->create();
        GuestBorrow::factory(20)->create();
    }
}
