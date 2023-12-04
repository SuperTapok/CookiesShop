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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')->nullable();
            $table->foreignId('category_id')->nullable();

            $table->foreign('place_id')->references('id')->on('places')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
