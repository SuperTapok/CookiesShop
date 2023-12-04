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
        Schema::create('product_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('image_id')->nullable();

            $table->foreign('product_id')->references('id')->on('products')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('image_id')->references('id')->on('images')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_image');
    }
};
