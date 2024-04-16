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
        Schema::create('rating_anime_films', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anime_film_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('rating', [1,2,3,4,5,6,7,8,9,10]);             
            $table->foreign('anime_film_id')->references('id')->on('anime_films')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_anime_films');
    }
};
