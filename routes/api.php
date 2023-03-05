<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\InformationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [RegisterController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

// Authenticated Routes
Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('resource', ResourceController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('comment', CommentController::class);

    // TODO : Custom Routes User :
        // RessourcesOfUser


    // TODO : Custom Routes Admin/Modo :
        // Ressources a valider


    // TODO : + middlewares roles


});

Route::get('get_visible_resources', [ResourceController::class, 'get_visible_resources']);
Route::get('get_one_resource', [ResourceController::class, 'get_one_resource']);

Route::get('get_visible_tutorials' , [TutorialController::class, 'get_visible_tutorials']);

Route::get('get_visible_informations' , [InformationController::class, 'get_visible_informations']);


// TODO : Custom Routes (Offline) (accessible aussi quand utilisateur connecté)
    // get_one_ressource() : Affiche ressource + auteur + category + contenu + commentaires associés

