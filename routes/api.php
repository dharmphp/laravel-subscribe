<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('subscribe', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::middleware('auth:api')->group(function() {
    Route::post('/post', 'PostController@store')->middleware('can:create,App\Post');
    Route::put('/post/{id}', 'PostController@update')->middleware('can:update,App\Post');
    Route::delete('/post/{id}', 'PostController@destroy')->middleware('can:delete,App\Post');
});

Route::resource('post', PostController::class)->only([
    'index', 'show'
]);