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
        Schema::create('cert_student_print_card_session', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY

            $table->string('session_code')->nullable()->index(); // stu_code_index
            $table->date('print_date')->nullable();

            $table->text('print_khmer_lunar')->nullable();
            $table->text('print_date_due')->nullable();
            $table->text('print_expire_date')->nullable();

            $table->unsignedInteger('create_by')->default(0);
            $table->timestamp('create_by_date')->nullable();

            $table->timestamp('print_by_date')->nullable();

            $table->unsignedInteger('update_by')->default(0);
            $table->timestamp('update_by_date')->nullable();

            $table->unsignedInteger('disable_by')->default(0);
            $table->timestamp('disable_by_date')->nullable();

            $table->unsignedInteger('status')->default(0);

            $table->index('id', 'id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_student_print_card_session');
    }
};
