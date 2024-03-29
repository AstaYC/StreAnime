<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AnimeController;
use App\Http\Controllers\User\AnimeDetailController;
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
Route::get('/home' , [AnimeController::class , 'displayAnime']);
Route::get('/animeListe' , [AnimeController::class , 'displayAnimeListe']);
Route::get('/animeDetails' , [AnimeDetailController::class , 'displayAnimeDetails']);
