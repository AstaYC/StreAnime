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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id(); 
            $table->string('titre');
            $table->string('posterLink');
            $table->date('releaseYear');
            $table->string('imbdLink');
            $table->string('mediaLink');
            $table->string('duration');
            $table->unsignedBigInteger('episodeNumber');
            $table->unsignedBigInteger('season_id');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status' , ['showing' , 'hidding'])->default('showing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
