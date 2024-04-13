<?php

use App\Http\Controllers\Admin\AnimeFilmController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\AnimeController;
use App\Http\Controllers\Admin\AnimeController as AdminAnimeController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\HiddenContentController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\UserController;
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

Route::get('/user' , [UserController::class , 'displayUser']);
Route::post('/user/delete' , [UserController::class , 'deleteUser']);


// Slider Route //

Route::get('/slider' , [SliderController::class , 'displaySlider']);
Route::post('/slider/add' , [SliderController::class , 'addSlider']);
Route::post('/slider/update' , [SliderController::class , 'updateSlider']);
Route::post('/slider/delete' , [SliderController::class , 'deleteSlider']);



// Anime Route //

Route::get('/anime' , [AdminAnimeController::class , 'displayAnime']);
Route::post('/anime/add' , [AdminAnimeController::class , 'addAnime']);
Route::post('/anime/update' , [AdminAnimeController::class , 'updateAnime']);
Route::post('/anime/hidden' , [AdminAnimeController::class , 'hiddenAnime']);

// Hidden Anime Route //

Route::get('/hiddenAnime' , [HiddenContentController::class , 'displayHiddenAnime']);
Route::post('/hiddenAnime/recuperate' , [HiddenContentController::class , 'recuperateAnime']);
Route::post('/hiddenAnime/delete' , [HiddenContentController::class , 'deleteAnime']);

// Anime Film //

Route::get('/animeFilm' , [AnimeFilmController::class , 'displayAnimeFilm']);
Route::post('/animeFilm/add' , [AnimeFilmController::class , 'addAnimeFilm']);
Route::post('/animeFilm/update' , [AnimeFilmController::class , 'updateAnimeFilm']);
Route::post('/animeFilm/delete' , [AnimeFilmController::class , 'deleteAnimeFilm']);

// Hidden film Route //

Route::get('/hiddenAnimeFilm' , [HiddenContentController::class , 'displayHiddenAnimeFilm']);
Route::post('/hiddenAnimeFilm/recuperate' , [HiddenContentController::class , 'recuperateAnimFilm']);
Route::post('/hiddenAnimeFilm/delete' , [HiddenContentController::class , 'deleteAnimeFilm']);

// Season Route //

Route::get('/season' , [SeasonController::class , 'displaySeason']);
Route::post('/season/add' , [SeasonController::class , 'addSeason']);
Route::post('/season/update' , [SeasonController::class , 'updateSeason']);
Route::post('/season/delete' , [SeasonController::class , 'deleteSeason']);

// Episodes //

Route::get('/episode' , [EpisodeController::class , 'displayEpisode']);
Route::post('/episode/add' , [EpisodeController::class , 'addEpisode']);
Route::post('/episode/update' , [EpisodeController::class , 'updateEpisode']);
Route::post('/episode/delete' , [EpisodeController::class , 'deleteEpisode']);
