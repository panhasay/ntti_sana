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
        Schema::create('cert_student_provisionals', function (Blueprint $table) {
            $table->id();
            $table->string('stu_code');
            $table->string('off_code');
            $table->string('class_code');
            $table->string('reference_code');
            $table->timestamp('print_date')->nullable(); // allow null
            $table->unsignedBigInteger('print_by');
            $table->timestamp('print_by_date')->nullable(); // allow null
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_student_provisionals');
    }
};
