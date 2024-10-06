<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\DailyScreeningController;
use App\Http\Controllers\Api\PerformanceController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserTicketController;
use Illuminate\Support\Facades\Route;




Route::apiResource('cities', CityController::class);

Route::apiResource('agents', AgentController::class);

Route::apiResource('daily_screenings', DailyScreeningController::class);

Route::apiResource('scores', ScoreController::class)->except(['update','store'])->middleware('auth:sanctum');

Route::apiResource('users', UserController::class)->middleware('auth:sanctum')->except('store');

Route::controller(CommentController::class)->prefix('comments')->group(function () {
    Route::get('/','index')->middleware('auth:sanctum');
    Route::get('/{comment}','show')->middleware('auth:sanctum');
    Route::post('/{comment}/giving_score','givingScore')->middleware('auth:sanctum');
    Route::delete('/{comment}','destroy')->middleware('auth:sanctum');
});

Route::controller(CinemaController::class)->prefix('cinemas')->group(function () {
    Route::get('/','index');
    Route::post('/','store')->middleware('auth:sanctum');
    Route::get('/{cinema}','show');
    Route::put('/{cinema}','update')->middleware('auth:sanctum');
    Route::post('/{cinema}/comment','comment')->middleware('auth:sanctum');
    Route::post('/{cinema}/giving_score','givingScore')->middleware('auth:sanctum');
    Route::delete('/{cinema}','destroy')->middleware('auth:sanctum');
});

Route::controller(PerformanceController::class)->prefix('performances')->group(function () {
    Route::get('/','index');
    Route::post('/','store')->middleware('auth:sanctum');
    Route::get('/{performance}','show');
    Route::put('/{performance}','update')->middleware('auth:sanctum');
    Route::post('/{performance}/comment','comment')->middleware('auth:sanctum');
    Route::post('/{performance}/giving_score','givingScore')->middleware('auth:sanctum');
    Route::delete('/{performance}','destroy')->middleware('auth:sanctum');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/','index');
    Route::post('/','store')->middleware('auth:sanctum');
    Route::get('/{category}','show');
    Route::put('/{category}','update')->middleware('auth:sanctum');
    Route::delete('/{category}','destroy')->middleware('auth:sanctum');
});

Route::controller(UserTicketController::class)->middleware('auth:sanctum')->prefix('my_tickets')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{userTicket}','show');
    Route::put('/{userTicket}','update');
    Route::put('/{userTicket}/paid','ticketPaid');
    Route::delete('/{userTicket}','destroy');
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login','login');
    Route::post('/register','register');
    route::delete('/logout','logout')->middleware('auth:sanctum');
});
