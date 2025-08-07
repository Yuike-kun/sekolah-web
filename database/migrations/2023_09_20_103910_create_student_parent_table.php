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
        Schema::create('student_parent', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk')->unique()->nullable();
            $table->string('family_leader')->nullable();

            $table->string('father')->nullable();
            $table->string('nik_father')->unique()->nullable();
            $table->string('birth_year_father')->nullable();
            $table->string('status_father')->nullable();
            $table->string('father_work')->nullable();
            $table->string('father_income')->nullable();
            $table->string('education_father')->nullable();

            $table->string('mother')->nullable();
            $table->string('nik_mother')->unique()->nullable();
            $table->string('birth_year_mother')->nullable();
            $table->string('status_mother')->nullable();
            $table->string('mother_work')->nullable();
            $table->string('mother_income')->nullable();
            $table->string('education_mother')->nullable();

            $table->string('guardian')->nullable();
            $table->string('nik_guardian')->unique()->nullable();
            $table->string('guardian_work')->nullable();
            $table->string('birth_year_guardian')->nullable();
            $table->string('guardian_income')->nullable();
            $table->string('education_guardian')->nullable();

            $table->string('kks')->unique()->nullable();
            $table->string('pkh')->unique()->nullable();
            $table->string('kip')->unique()->nullable();
            $table->string('phone')->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parent');
    }
};
