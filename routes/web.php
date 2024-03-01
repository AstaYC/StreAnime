<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeDetailController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login' , [AuthController::class , 'displayLogin']);
Route::get('/register' , [AuthController::class , 'displayRegister']);




Route::get('/' , [AnimeController::class , 'displayAnime']);
Route::get('/anime-liste' , [AnimeController::class , 'displayAnimeListe']);
Route::get('/anime-details' , [AnimeDetailController::class , 'displayAnimeDetails']);
