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
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('user_name', 50)->unique();
            $table->string('name', 100);
            $table->string('email', 50)->unique();
            $table->string('phone', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->boolean('is_deleted');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_moderator')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
