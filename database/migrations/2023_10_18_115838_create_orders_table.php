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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('given_at')->nullable();
            $table->integer('sum')->nullable();
            $table->string('receipt_code')->nullable();
            $table->string('receipt_url')->nullable();
            $table->foreignId('employee_id')->nullable();

            $table->foreign('employee_id')->references('id')->on('employees')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
