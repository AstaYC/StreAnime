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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('glance');
            $table->unsignedBigInteger('anime_id');
            $table->unsignedBigInteger('animeFilm_id');
            $table->foreign('anime_id')->references('id')->on('animes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('animeFilm_id')->references('id')->on('anime_films')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_models');
    }
};
