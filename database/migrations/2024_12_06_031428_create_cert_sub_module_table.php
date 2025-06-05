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
        Schema::create('cert_sub_module', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();

            $table->string('name_kh', 50)->nullable();
            $table->string('name_eng', 50)->nullable();

            $table->text('icon')->nullable();
            $table->string('route', 50)->nullable();
            $table->string('controller', 50)->nullable();

            // Handle timestamps
            $table->timestamp('create_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->integer('active')->default(0);

            // Add indexes
            $table->index('name_kh');
            $table->index('name_eng');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_sub_module');
    }
};
