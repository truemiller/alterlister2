<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

use App\Http\Controllers\EventController;
use App\Http\Controllers\SearchController;

Route::get('/{ent}/like', [EventController::class,'createEventEntityLike'])
    ->name('ent.like');

Route::get('/search/{query}', [SearchController::class,'query']);
