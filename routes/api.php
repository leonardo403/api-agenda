<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\V1\UserController;
use  App\Http\Controllers\Api\V1\AgendaController;
use App\Http\Controllers\AuthController;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/**
 * Api V1
 */
Route::prefix('v1')->group( function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/agendas', [AgendaController::class, 'index']);
    Route::get('/agendas/{agenda_id}', [AgendaController::class, 'showAgenda']);
    Route::get('/agendas/rangeData', [AgendaController::class, 'rangeData']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('/agendas', [AgendaController::class, 'createAgenda']);
        Route::delete('/agendas/{agenda_id}', [AgendaController::class, 'deleteAgenda']);
        Route::put('/agendas/{agenda_id}', [AgendaController::class, 'updateAgenda']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});


