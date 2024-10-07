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

Route::apiResource('scores', ScoreController::class)->except(['update','store']);

Route::apiResource('users', UserController::class)->except('store');

Route::apiResource('categories', CategoryController::class);

Route::apiResource("comments", CommentController::class)->except(["store", "update"]);
Route::post('comments/{comment}/giving_score', [CommentController::class, "givingScore"]);

Route::apiResource('cinemas', CinemaController::class);
Route::post('cinemas/{cinema}/comment',[CinemaController::class,'comment']);
Route::post('cinemas/{cinema}/giving_score',[CinemaController::class,'givingScore']);

Route::apiResource('performances', PerformanceController::class);
Route::post('/{performance}/comment',[PerformanceController::class,'comment']);
Route::post('/{performance}/giving_score',[PerformanceController::class,'givingScore']);

Route::apiResource('tickets', UserTicketController::class);
Route::put('/{userTicket}/paid',[UserTicketController::class,'ticketPaid']);

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login','login');
    Route::post('/register','register');
    route::delete('/logout','logout');
});
