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
        Schema::create('anime_films', function (Blueprint $table) {
            $table->id();   
            $table->string('titre');
            $table->string('posterLink');
            $table->string('duration');
            $table->string('trailerLink');
            $table->string('imbdLink');
            $table->string('mediaLink');
            $table->date('releaseYear');
            $table->text('description');
            $table->enum('status' , ['showing' , 'hidden'])->default('showing');
            $table->unsignedBigInteger('anime_id');
            $table->foreign('anime_id')->references('id')->on('animes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime_film_models');
    }
};
