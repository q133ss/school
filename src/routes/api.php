<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/teachers', [App\Http\Controllers\AuthController::class, 'teachers']);

Route::group(['prefix' => 'teacher', 'middleware' => ['auth:sanctum', 'is.teacher']], function (){
    Route::get('/students', [\App\Http\Controllers\Teacher\StudentController::class, 'index']);
});
