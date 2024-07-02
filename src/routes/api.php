<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

/*
 * Me
 * Login
 * Register
 *
 * Аварка
 *
 * Форма
 */

Route::get('/teachers', [App\Http\Controllers\AuthController::class, 'teachers']);

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/me', [\App\Http\Controllers\Student\MeController::class, 'me']);
    Route::get('/homeworks', [\App\Http\Controllers\Student\MeController::class, 'homeworks']);
    Route::get('/get/teacher/tg', [\App\Http\Controllers\Student\MeController::class, 'getTg']);

    Route::post('/avatar', [\App\Http\Controllers\Student\MeController::class, 'avatar']);
});

Route::group(['prefix' => 'teacher', 'middleware' => ['auth:sanctum', 'is.teacher']], function (){
    Route::get('/students', [\App\Http\Controllers\Teacher\StudentController::class, 'index']);
    Route::post('/student/comment/{student_id}', [\App\Http\Controllers\Teacher\StudentController::class, 'comment']);
    Route::post('/student/homework', [\App\Http\Controllers\Teacher\StudentController::class, 'homework']);
    Route::post('/student/homework/{id}', [\App\Http\Controllers\Teacher\StudentController::class, 'homeworkUpdate']);
    Route::delete('/student/homework/{id}', [\App\Http\Controllers\Teacher\StudentController::class, 'homeworkDelete']);
    Route::patch('/student/{id}', [\App\Http\Controllers\Teacher\StudentController::class, 'update']);
    Route::apiResource('lesson', \App\Http\Controllers\Teacher\LessonController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'is.admin']], function (){
    Route::apiResource('users', \App\Http\Controllers\Admin\UsersController::class);
});
