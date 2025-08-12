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
        Schema::create('student_files', function (Blueprint $table) {
            $table->id();
            $table->text('foto');
            $table->text('ijazah');
            $table->text('raport');
            $table->text('kejuruan');
            $table->text('kartu_keluarga');
            $table->text('pkh');
            $table->text('kip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_files');
    }
};
