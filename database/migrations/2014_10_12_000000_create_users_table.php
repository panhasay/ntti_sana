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
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->decimal('pageination', 10, 0)->nullable();
            $table->string('name')->nullable();
            $table->string('department_code', 100)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken(); // Creates remember_token (100 chars) and nullable
            $table->string('user_code', 10)->nullable();
            $table->timestamps(); // Creates created_at and updated_at
            $table->string('user_type', 100)->nullable();
            $table->string('role', 50)->default('');
            $table->string('permission', 100)->nullable();
            $table->decimal('phone', 50, 0)->nullable();
            $table->string('session_token', 100)->nullable();
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
