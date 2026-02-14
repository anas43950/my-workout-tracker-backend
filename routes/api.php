<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WorkoutsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'exercises'], function () {
        Route::get('/', [ExerciseController::class, 'index']);
        Route::post('/add', [ExerciseController::class, 'store']);
        Route::post('/edit', [ExerciseController::class, 'edit']);
        Route::delete('/delete/{id}', [ExerciseController::class, 'destroy']);
    });

    Route::group(['prefix' => 'routines'], function () {
        Route::get('/', [RoutineController::class, 'index']);
        Route::get('/by-name', [RoutineController::class, 'routineByName']);
        Route::post('/add', [RoutineController::class, 'store']);
        Route::post('/edit', [RoutineController::class, 'edit']);
        Route::delete('/delete/{id}', [RoutineController::class, 'destroy']);
    });

    Route::group(['prefix' => 'workouts'], function () {
        Route::get('/', [WorkoutsController::class, 'index']);
        Route::get('/for-day', [WorkoutsController::class, 'workoutsForDay']);
        Route::post('/add', [WorkoutsController::class, 'store']);
    });
});
