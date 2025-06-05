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
        Schema::create('cert_student_print_card_revision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('print_card_id')->default(0)->comment('cert_student_print_card');
            $table->integer('revision')->default(0);
            $table->integer('print_by')->default(0);
            $table->dateTime('print_by_date')->nullable();
            $table->timestamp('auto_date')->useCurrent()->useCurrentOnUpdate();
            $table->tinyInteger('status')->default(0);

            $table->index(['id', 'print_card_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_student_print_card_revision');
    }
};
