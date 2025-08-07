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
        Schema::create('identitiy_school', function (Blueprint $table) {
            $table->id();
            $table->string('province')->nullable();
            $table->string('regency')->nullable();
            $table->string('district')->nullable();
            $table->string('village')->nullable();
            $table->string('name_school')->nullable();
            $table->string('ladder_study')->nullable();
            $table->string('vice_pricipal')->nullable();
            $table->string('status_school')->nullable();
            $table->string('npsn')->nullable();
            $table->string('school_level')->nullable();
            $table->text('location_study')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitiy_school');
    }
};
