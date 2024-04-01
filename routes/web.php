<?php

use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Admin\userController;
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

//  Categorie Route//

Route::get('/categorie' , [CategorieController::class , 'displayCategorie']);
Route::post('/categorie/add' , [CategorieController::class , 'addCategorie']);
Route::post('/categorie/update' , [CategorieController::class , 'updateCategorie']);
Route::post('/categorie/delete' , [CategorieController::class , 'deleteCategorie']);


// Source Route //

Route::get('/source' , [SourceController::class , 'displaySource']);
Route::post('/source/add' , [SourceController::class , 'addSource']);
Route::post('/source/update' , [SourceController::class , 'updateSource']);
Route::post('/source/delete' , [SourceController::class , 'deleteSource']);


// Character Route //

Route::get('/character' , [CharacterController::class , 'displayCharacter']);
Route::post('/character/add' , [CharacterController::class , 'addCharacter']);
Route::post('/character/update' , [CharacterController::class , 'updateCharacter']);
Route::post('/character/delete' , [CharacterController::class , 'deleteCharacter']);


// Role Route //

Route::get('/role' , [RoleController::class , 'displayRole']);
Route::post('/role/add' , [RoleController::class , 'addRole']);
Route::post('/role/update' , [RoleController::class , 'updateRole']);
Route::post('/role/delete' , [RoleController::class , 'deleteRole']);

// User Route //

Route::post('/user' , [userController::class , 'displayUser']);
Route::post('/user/delete' , [userController::class , 'deleteUser']);

