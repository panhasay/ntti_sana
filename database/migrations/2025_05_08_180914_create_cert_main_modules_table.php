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
        Schema::create('cert_main_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_kh', 50)->nullable();
            $table->string('name_eng', 50)->nullable();
            $table->text('icon')->nullable();
            $table->string('url', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->integer('active')->default(0);

            $table->index('id', 'cert_main_modules_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_main_modules');
    }
};
