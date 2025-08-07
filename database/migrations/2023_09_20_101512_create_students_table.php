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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('number_registration')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nisn')->unique()->nullable();
            $table->string('nik')->unique()->nullable();
            $table->string('competence')->nullable();
            $table->string('gender')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('religion')->nullable();
            $table->string('family_status')->nullable();
            $table->string('child_to')->nullable();
            $table->string('sum_sibling')->nullable();
            $table->string('hobby')->nullable();
            $table->string('mind')->nullable();
            $table->string('paud')->nullable();
            $table->string('tk')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
