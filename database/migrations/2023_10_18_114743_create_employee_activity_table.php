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
        Schema::create('employee_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable();
            $table->foreignId('activity_id')->nullable();
            $table->dateTime('given_at');

            $table->foreign('employee_id')->references('id')->on('employees')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('activity_id')->references('id')->on('activities')
                  ->onUpdate('cascade')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_activity');
    }
};
