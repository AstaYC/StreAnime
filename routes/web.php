<?php

use App\Http\Controllers\Admin\AnimeFilmController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AnimeController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\HiddenContentController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\User\ContentDetailController;
use App\Http\Controllers\User\ContentController;
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


// Home Route // 

Route::get('/' , [ContentController::class , 'displayContent']);
Route::get('/home' , [ContentController::class , 'displayContent']);

// Anime (Film) List //

Route::get('/animeList' , [ContentController::class , 'displayAnimeList']);
Route::get('/animeFilmList' , [ContentController::class , 'displayAnimeFilmList']);

// Anime (Season) (Film) Details //

Route::get('/animeDetails/{id}' , [ContentDetailController::class , 'displayAnimeDetails']);
Route::get('/seasonDetails/{id}' , [ContentDetailController::class , 'displaySeasonDetails']);
Route::get('/animeFilmDetails/{id}' , [ContentDetailController::class , 'displayAnimeFilmDetails']);

// Content Watching //

Route::get('/episodeWatching/{id}' , [ContentDetailController::class , 'dispalyEpisodeWatching']);
Route::get('/animeFilmWatching/{id}' , [ContentDetailController::class , 'displayAnimeFilmWatching']);

// Incriment View //

Route::post('/episodeWatching/{episodeId}/viewsIncr' , [ContentDetailController::class , 'viewsIncriment']);


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

Route::get('/anime' , [AnimeController::class , 'displayAnime']);
Route::post('/anime/add' , [AnimeController::class , 'addAnime']);
Route::post('/anime/update' , [AnimeController::class , 'updateAnime']);
Route::post('/anime/hidden' , [AnimeController::class , 'hiddenAnime']);

// Hidden Anime Route //

Route::get('/hiddenAnime' , [HiddenContentController::class , 'displayHiddenAnime']);
Route::post('/hiddenAnime/recuperate' , [HiddenContentController::class , 'recuperateAnime']);
Route::post('/hiddenAnime/delete' , [HiddenContentController::class , 'deleteAnime']);

// Anime Film //

Route::get('/animeFilm' , [AnimeFilmController::class , 'displayAnimeFilm']);
Route::post('/animeFilm/add' , [AnimeFilmController::class , 'addAnimeFilm']);
Route::post('/animeFilm/update' , [AnimeFilmController::class , 'updateAnimeFilm']);
Route::post('/animeFilm/hidden' , [AnimeFilmController::class , 'hiddenAnimeFilm']);

// Hidden film Route //

Route::get('/hiddenAnimeFilm' , [HiddenContentController::class , 'displayHiddenAnimeFilm']);
Route::post('/hiddenAnimeFilm/recuperate' , [HiddenContentController::class , 'recuperateAnimFilm']);
Route::post('/hiddenAnimeFilm/delete' , [HiddenContentController::class , 'deleteAnimeFilm']);

// Season Route //

Route::get('/season' , [SeasonController::class , 'displaySeason']);
Route::post('/season/add' , [SeasonController::class , 'addSeason']);
Route::post('/season/update' , [SeasonController::class , 'updateSeason']);
Route::post('/season/hidden' , [SeasonController::class , 'hiddenSeason']);

// Hidden Season Route //

Route::get('/hiddenSeason' , [HiddenContentController::class , 'displayHiddenSeason']);
Route::post('/hiddenSeason/recuperate' , [HiddenContentController::class , 'recuperateSeason']);
Route::post('/hiddenSeason/delete' , [HiddenContentController::class , 'deleteSeason']);


// Episodes //

Route::get('/episode' , [EpisodeController::class , 'displayEpisode']);
Route::post('/episode/add' , [EpisodeController::class , 'addEpisode']);
Route::post('/episode/update' , [EpisodeController::class , 'updateEpisode']);
Route::post('/episode/hidden' , [EpisodeController::class , 'hiddenEpisode']);

// Hidden Episode Route //

Route::get('/hiddenEpisode' , [HiddenContentController::class , 'displayHiddenEpisode']);
Route::post('/hiddenEpisode/recuperate' , [HiddenContentController::class , 'recuperateEpisode']);
Route::post('/hiddenEpisode/delete' , [HiddenContentController::class , 'deleteEpisode']);


