<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/teachers', [App\Http\Controllers\AuthController::class, 'teachers']);

Route::group(['prefix' => 'teacher', 'middleware' => ['auth:sanctum', 'is.teacher']], function (){
    Route::get('/students', [\App\Http\Controllers\Teacher\StudentController::class, 'index']);
    Route::post('/student/comment/{student_id}', [\App\Http\Controllers\Teacher\StudentController::class, 'comment']);
    Route::post('/student/homework', [\App\Http\Controllers\Teacher\StudentController::class, 'homework']);
    Route::post('/student/homework/{id}', [\App\Http\Controllers\Teacher\StudentController::class, 'homeworkUpdate']);
    Route::delete('/student/homework/{id}', [\App\Http\Controllers\Teacher\StudentController::class, 'homeworkDelete']);
});
