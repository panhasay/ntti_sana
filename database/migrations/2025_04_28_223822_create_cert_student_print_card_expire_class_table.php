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
        Schema::create('cert_student_print_card_expire_class', function (Blueprint $table) {
            $table->id(); // id (Primary key, auto increment)
            $table->string('session_code', 50); // Example length
            $table->string('class_code', 50);   // Example length
            $table->integer('year');
            $table->date('expire_date');        // Only DATE
            $table->string('print_expire_date'); // Text (because Khmer full date text)
            $table->unsignedBigInteger('create_by'); // User ID (foreign key if needed)
            $table->timestamp('create_by_date')->nullable(); // DateTime
            $table->unsignedBigInteger('update_by')->nullable(); // Update by user (nullable)
            $table->timestamp('update_by_date')->nullable();    // DateTime (nullable)
            $table->tinyInteger('status')->default(1); // Status 1=Active, 0=Inactive
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_student_print_card_expire_class');
    }
};
