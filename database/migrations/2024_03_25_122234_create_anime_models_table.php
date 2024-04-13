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
        Schema::create('animes', function (Blueprint $table) {
            $table->id();   
            $table->string('titre');
            $table->string('posterLink');
            $table->string('trailerLink');
            $table->string('imbdLink');
            $table->date('releaseYear');
            $table->string('description');
            $table->string('mangaka');
            $table->string('studio');
            $table->unsignedBigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status' , ['showing' , 'hidden'])->default('showing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime_models');
    }
};
