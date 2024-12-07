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
        Schema::create('inspection', function (Blueprint $table) {
            $table->id();
            $table->string('animal');
            $table->string('cage_treatment');
            $table->string('date');
            $table->string('environmental_care');
            $table->string('feeding');
            $table->string('medical_treatment');
            $table->string('inspector');
            $table->string('location');
            $table->string('suggestion');
            $table->string('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection');
    }
};
