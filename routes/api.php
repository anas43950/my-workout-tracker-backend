<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'workouts'], function () {
        Route::get('/', [WorkoutController::class, 'index']);
        Route::post('/add', [WorkoutController::class, 'store']);
        Route::post('/edit', [WorkoutController::class, 'edit']);
        Route::delete('/delete/{id}', [WorkoutController::class, 'destroy']);
    });

    Route::group(['prefix' => 'routines'], function () {
        Route::get('/', [RoutineController::class, 'index']);
        Route::get('/by-name', [RoutineController::class, 'routineByName']);
        Route::post('/add', [RoutineController::class, 'store']);
        Route::post('/edit', [RoutineController::class, 'edit']);
        Route::delete('/delete/{id}', [RoutineController::class, 'destroy']);
    });

    Route::group(['prefix' => 'workout-history'], function () {
        Route::get('/', [WorkoutHistoryController::class, 'index']);
        Route::get('/for-day', [WorkoutHistoryController::class, 'historyForDay']);
        Route::post('/add', [WorkoutHistoryController::class, 'store']);
    });
});
