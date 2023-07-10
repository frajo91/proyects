<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;  
use App\Http\Controllers\proyectoController;  
use App\Http\Controllers\tareasController;  
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
        Route::get('proyectos/{proyecto}','show');
        Route::put('proyectos/{proyecto}','update');
        Route::delete('proyectos/{proyecto}','destroy');

    });

    Route::controller(tareasController::class)->group(function(){
        Route::get('tareas','index');
        Route::post('tareas','store');
        Route::get('tareas/{tarea}','show');
        Route::put('tareas/{tarea}','update');
        Route::delete('tareas/{tarea}','destroy');
        Route::post('tareas/asignar','Asignartouser');
        Route::post('tareas/desasignar','desasignartouser');

    });
});
