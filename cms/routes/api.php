<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;

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

// API routes untuk User Info
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/info', [UserInfoController::class, 'getUserInfo'])->name('api.user.info');
    Route::post('/user/info/update', [UserInfoController::class, 'updateUserInfo'])->name('api.user.update');
});
