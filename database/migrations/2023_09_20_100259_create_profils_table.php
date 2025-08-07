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
        Schema::create('profils', function (Blueprint $table) {

            $table->id();
            $table->text('history')->nullable();
            $table->string('image_06')->nullable();
            $table->text('origin_name')->nullable();
            $table->text('logo_meaning')->nullable();
            $table->string('image_01')->nullable();

            $table->string('title_foreword')->nullable();
            $table->text('foreword')->nullable();
            $table->string('image_04')->nullable();

            $table->text('vision_mission')->nullable();
            $table->string('image_05')->nullable();
            $table->text('objective')->nullable();
            $table->string('image_02')->nullable();

            $table->text('structure_organization')->nullable();
            $table->string('image_03')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
