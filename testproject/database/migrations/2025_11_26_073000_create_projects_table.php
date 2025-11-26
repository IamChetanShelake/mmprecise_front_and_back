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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['ongoing', 'completed'])->default('ongoing');
            $table->string('main_image');
            $table->string('title');
            $table->string('span')->nullable();
            $table->string('area')->nullable();
            $table->string('technology')->nullable();
            $table->string('completion')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
