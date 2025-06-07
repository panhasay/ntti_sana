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
        Schema::create('student_score', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key 'id'
            $table->unsignedBigInteger('assign_line_no')->nullable();
            $table->string('student_code'); // FK to students.code
            $table->date('att_date')->nullable();
            $table->decimal('att_score', 5, 2)->nullable(); // Example: 99.50
            $table->string('subjects_code'); // FK to subjects.code

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_score');
    }
};
