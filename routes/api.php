<?php

use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DailyScreeningController;
use App\Http\Controllers\Api\PerformanceController;
use App\Http\Controllers\PerformanceAgentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/cities', CityController::class );
Route::apiResource('/cinemas', CinemaController::class );
Route::apiResource('/performances', PerformanceController::class );
Route::apiResource('/daily_screenings', DailyScreeningController::class );
Route::apiResource('/agents', AgentController::class );
Route::apiResource('/performance_agents', PerformanceAgentController::class );
Route::apiResource('/categories', CategoryController::class );
