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
        Schema::create('csrs', function (Blueprint $table) {
            $table->id();
            $table->string('main_title');
            $table->string('main_image')->nullable();
            $table->text('main_description')->nullable();
            $table->text('short_description')->nullable();
            $table->json('positive_changes')->nullable(); // Array of objects with image, title, description
            $table->json('measurable_results')->nullable(); // Array of objects with image, number, title, description
            $table->json('green_construction')->nullable(); // Array of objects with image, title, description
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csrs');
    }
};
