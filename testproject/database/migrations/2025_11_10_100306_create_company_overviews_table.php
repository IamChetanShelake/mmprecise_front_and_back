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
        Schema::create('company_overviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('first_description');
            $table->text('second_description');
            $table->integer('years_experience')->default(0);
            $table->integer('projects_completed')->default(0);
            $table->integer('expert_engineers')->default(0);
            $table->text('vision_description');
            $table->json('mission_points')->nullable(); // Store mission points as JSON array
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_overviews');
    }
};
