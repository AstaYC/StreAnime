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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id');
            $table->enum('type', ['anime', 'animeFilm']);
            $table->foreign('media_id')->references('id')->on('animes')->onDelete('cascade')->onUpdate('cascade')->name('slider-anime');
            $table->foreign('media_id')->references('id')->on('anime_films')->onDelete('cascade')->onUpdate('cascade')->name('slider-film');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_models');
    }
};
