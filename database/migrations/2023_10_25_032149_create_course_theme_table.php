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
        Schema::create('course_theme', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('course_id')->nullable();
            $table->foreignId('theme_id')->nullable();

            $table->foreign('course_id')->references('id')->on('courses')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('theme_id')->references('id')->on('themes')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_theme');
    }
};
