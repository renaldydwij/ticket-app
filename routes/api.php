<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\StatusController;
use App\Http\Controllers\API\PriorityController;
use App\Http\Controllers\API\TicketController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user' => UserController::class]);
Route::apiResources(['customer' => CustomerController::class]);
Route::apiResources(['status' => StatusController::class]);
Route::apiResources(['priority' => PriorityController::class]);
Route::apiResources(['ticket' => TicketController::class]);
Route::apiResources(['rating' => RatingController::class]);

Route::get('profile',  [UserController::class, 'profile']);
