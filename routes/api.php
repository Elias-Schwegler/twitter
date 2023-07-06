<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\Auth\LoginController;



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

Route::middleware('auth:sanctum')->
get('/user', function (Request $request) {
    return $request->user();

});
/*
Route::get('/tweets', function (Request $request) {
    return "Biip Biip Biip";
});
 */


Route::get('/tweets', [TweetController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/tweets', [UserController::class, 'tweets']);
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('/auth', [LoginController::class, 'checkAuth']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
Route::post('/tweets/{tweet}/like', [TweetController::class, 'like']);
Route::post('/tweets', [TweetController::class, 'store'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::put('/me', [UserController::class, 'updateMe']);
});

