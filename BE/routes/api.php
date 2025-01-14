<?php

use App\Http\Controllers\FilestorageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelationTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//tests -------------------------------------------------------
Route::get('/test-relations', [RelationTestController::class, 'checkRelations']); //test per le relazioni
Route::post('/upload', [FilestorageController::class, 'storeFile']);
Route::get('/show_path/{id}', [FilestorageController::class, 'show_path']);

//standard routes jwt -------------------------------------------------------
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//Category routes -------------------------------------------------------
Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'Category'

], function ($router) {

    Route::get('home', 'CategoryController@index');
});
