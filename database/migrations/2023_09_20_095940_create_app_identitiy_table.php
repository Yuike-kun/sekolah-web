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
        Schema::create('app_identitiy', function (Blueprint $table) {
            $table->id();
            $table->string('contact_school')->nullable();
            $table->string('email_school')->nullable();
            $table->string('facebook_school')->nullable();
            $table->string('youtube_school')->nullable();
            $table->string('instagram_school')->nullable();
            $table->string('twitter_school')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_identitiy');
    }
};
