<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::apiResource('exemplos', ExemploController::class)->middleware(['auth:api', 'can:gestor']);
//Route::apiResource('exemplos', ExemploController::class)->middleware(['auth:api']);
Route::post('auth/login', 'App\\Http\\Controllers\\AuthController@login');
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    /*
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    */
    Route::post('me', 'App\\Http\\Controllers\\AuthController@me');
});
