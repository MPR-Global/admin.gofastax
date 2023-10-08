<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\MeetTheTeamController;
use App\Http\Controllers\API\ReviewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getBusinessRules', [APIController::class, 'getBusinessRules']);
Route::match(['get', 'post'], 'getZipdata', [APIController::class, 'getZipdata']);

Route::post('meet-the-team', [MeetTheTeamController::class, 'getAllTeamMembers'])->name('meet-the-team');
Route::get('getReviews',[ReviewsController::class,'index'])->name('reviews');