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
        Schema::create('cert_student_print_card', function (Blueprint $table) {
            $table->id();
            $table->string('stu_code')->nullable();
            $table->string('class_code')->nullable();
            $table->integer('print_code')->default(0);
            $table->unsignedInteger('print_by')->default(0);
            $table->timestamp('print_by_date')->nullable();
            $table->unsignedInteger('update_by')->default(0);
            $table->timestamp('update_by_date')->nullable();
            $table->unsignedInteger('disable_by')->default(0);
            $table->timestamp('disable_by_date')->nullable();
            $table->unsignedInteger('status')->default(0);

            $table->index('id');
            $table->index('stu_code');
            $table->index('class_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_student_print_card');
    }
};
