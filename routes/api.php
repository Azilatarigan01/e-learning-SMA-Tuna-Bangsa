<?php

use App\Http\Controllers\Api\DataClassController;
use App\Http\Controllers\Api\DataClassSubjectController;
use App\Http\Controllers\Api\DataTeacherClassController;
use App\Http\Controllers\Api\DataSubjectController;
use App\Http\Controllers\Api\DataHomeworkController;
use App\Http\Controllers\Api\DataExamController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user', [UserController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::post('user', [UserController::class, 'store']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

Route::get('class', [DataClassController::class, 'index']);
Route::get('class/{id}', [DataClassController::class, 'show']);
Route::post('class', [DataClassController::class, 'store']);
Route::put('class/{id}', [DataClassController::class, 'update']);
Route::delete('class/{id}', [DataClassController::class, 'destroy']);

Route::get('classsubject', [DataClassSubjectController::class, 'index']);
Route::get('classsubject/{id}', [DataClassSubjectController::class, 'show']);
Route::post('classsubject', [DataClassSubjectController::class, 'store']);
Route::put('classsubject/{id}', [DataClassSubjectController::class, 'update']);
Route::delete('classsubject/{id}', [DataClassSubjectController::class, 'destroy']);

Route::get('teacherclass', [DataTeacherClassController::class, 'index']);
Route::get('teacherclass/{id}', [DataTeacherClassController::class, 'show']);
Route::post('teacherclass', [DataTeacherClassController::class, 'store']);
Route::put('teacherclass/{id}', [DataTeacherClassController::class, 'update']);
Route::delete('teacherclass/{id}', [DataTeacherClassController::class, 'destroy']);

Route::get('subject', [DataSubjectController::class, 'index']);
Route::get('subject/{id}', [DataSubjectController::class, 'show']);
Route::post('subject', [DataSubjectController::class, 'store']);
Route::put('subject/{id}', [DataSubjectController::class, 'update']);
Route::delete('subject/{id}', [DataSubjectController::class, 'destroy']);

Route::get('exam', [DataExamController::class, 'index']);
Route::get('exam/{id}', [DataExamController::class, 'show']);
Route::post('exam', [DataExamController::class, 'store']);
Route::put('exam/{id}', [DataExamController::class, 'update']);
Route::delete('exam/{id}', [DataExamController::class, 'destroy']);

Route::get('homework', [DataHomeworkController::class, 'index']);
Route::get('homework/{id}', [DataHomeworkController::class, 'show']);
Route::post('homework', [DataHomeworkController::class, 'store']);
Route::put('homework/{id}', [DataHomeworkController::class, 'update']);
Route::delete('homework/{id}', [DataHomeworkController::class, 'destroy']);