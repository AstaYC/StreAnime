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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id(); 
            $table->string('titre');
            $table->text('description');
            $table->string('posterLink');
            $table->string('trailerLink');
            $table->string('imbdLink');
            $table->date('releaseYear');
            $table->date('EndYear');
            $table->unsignedBigInteger('seasonNumber');
            $table->unsignedBigInteger('anime_id');
            $table->foreign('anime_id')->references('id')->on('animes')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status' , ['showing' , 'hidding'])->default('showing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
