<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\DailyScreeningController;
use App\Http\Controllers\Api\PerformanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(CityController::class)->prefix('cities')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{city}','show');
    Route::put('/{city}','update');
    Route::delete('/{city}','destroy');
});

Route::controller(CinemaController::class)->prefix('cinemas')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{cinema}','show');
    Route::put('/{cinema}','update');
    Route::post('/{cinema}/comment','comment');
    Route::delete('/{cinema}','destroy');
});

Route::controller(PerformanceController::class)->prefix('performances')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{performance}','show');
    Route::put('/{performance}','update');
    Route::post('/{performance}/comment','comment');
    Route::delete('/{performance}','destroy');
});

Route::controller(DailyScreeningController::class)->prefix('daily_screenings')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{daily_screening}','show');
    Route::put('/{daily_screening}','update');
    Route::delete('/{daily_screening}','destroy');
});

Route::controller(AgentController::class)->prefix('agents')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{agent}','show');
    Route::put('/{agent}','update');
    Route::delete('/{agent}','destroy');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/','index');
    Route::post('/','store');
    Route::get('/{category}','show');
    Route::put('/{category}','update');
    Route::delete('/{category}','destroy');
});

Route::controller(CommentController::class)->prefix('comments')->group(function () {
    Route::get('/','index');
    Route::get('/{comment}','show');
    Route::delete('/{comment}','destroy');
});
