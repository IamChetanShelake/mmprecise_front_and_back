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
        Schema::create('expertises', function (Blueprint $table) {
            $table->id();

            // Main section fields
            $table->string('main_title')->nullable();
            $table->text('main_description')->nullable();
            $table->string('main_image')->nullable();

            // Second item fields
            $table->string('second_title')->nullable();
            $table->json('second_points')->nullable(); // Array of points
            $table->string('second_image')->nullable();

            // Third item fields
            $table->string('third_title')->nullable();
            $table->json('third_points')->nullable(); // Array of points
            $table->string('third_image')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expertises');
    }
};
