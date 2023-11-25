<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('list-homework', [StudentController::class, 'getListHomework']);
        Route::put('submit-homework/{homeworkId}', [StudentController::class, 'submitHomework']);
    });

    Route::prefix('teacher')->group(function () {
        Route::post('create-homework', [TeacherController::class, 'createHomework']);
        Route::post('assigned-homework', [TeacherController::class, 'updateAssignedHomework']);
    });
});