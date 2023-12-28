<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('ISBN')->unique();
            $table->string('DDC');
            $table->string('title');
            $table->text('description');
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->date('published_at');
            $table->string('cover')->default('covers/noCover.png');
            $table->integer('copies_no');
            $table->integer('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
