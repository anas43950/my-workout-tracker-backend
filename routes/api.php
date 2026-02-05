<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutRecordController;
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
        Route::get('/with-name', [RoutineController::class, 'routineWithName']);
        Route::post('/add', [RoutineController::class, 'store']);
        Route::post('/edit', [RoutineController::class, 'edit']);
        Route::delete('/delete/{id}', [RoutineController::class, 'destroy']);
    });

    Route::group(['prefix' => 'workout-records'], function () {
        Route::get('/', [WorkoutRecordController::class, 'index']);
        Route::get('/for-day', [WorkoutRecordController::class, 'recordsForDay']);
        Route::post('/add', [WorkoutRecordController::class, 'store']);
    });
});
