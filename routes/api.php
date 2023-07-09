<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;  
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function(){
    Route::post('login','login');
    Route::post('registro','registro');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::controller(proyectoController::class)->group(function(){
        Route::get('proyectos','index');
        Route::post('proyectos','store');
        Route::get('proyectos/{id}','show');
        Route::get('proyectos','index');

    });
});