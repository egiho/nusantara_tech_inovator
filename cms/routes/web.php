<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\UserInfoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {
        
        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    });
});

// Route untuk halaman User Info (web)
Route::middleware('auth')->get('/user/info', function () {
    return view('info');
})->name('user.info');

// Route::get('/user-info', [UserInfoController::class, 'show'])->name('user.info');
// Route::post('/user-info/update', [UserInfoController::class, 'update'])->name('api.user.update');