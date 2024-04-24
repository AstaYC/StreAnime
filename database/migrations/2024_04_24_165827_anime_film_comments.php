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
        Schema::create('anime_film_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('anime_film_id');
            $table->text('content');
            $table->foreign('user_id')->references('id')->on('user_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('anime_film_id')->references('id')->on('anime_films')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
