<?php

use App\Http\Controllers\Api\CinemaController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/cities', CityController::class );
Route::apiResource('/cinemas', CinemaController::class );
