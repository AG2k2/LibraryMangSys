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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('card_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('pro_pic')->default('profiles/noPic.png');
            $table->string('username')->unique();
            $table->string('address');
            $table->char('gender', 1);
            $table->string('role');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birth_date');
            $table->string('password');
            $table->timestamp('enroll_submitted_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
 * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
