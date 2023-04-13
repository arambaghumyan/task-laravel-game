<?php

use App\Http\Controllers\Site\GameController;
use App\Http\Controllers\Site\TokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\RegistrationController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UsersController;

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

Route::get('/', [RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');
Route::get('/home/{token}/{game?}', [HomeController::class, 'index'])->middleware(['valid_token'])->name('home');

Route::prefix('admin')->group(function () {
	Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
	Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
	Route::resource('users', UsersController::class)->except('show')->middleware(['auth', 'admin_middleware']);
});

Route::prefix('tokens')->group(function () {
    Route::resource('tokens', TokenController::class)->only(['store']);
    Route::post('/deactivate/{token}', [TokenController::class, 'deactivate'])->name('tokens.deactivate');
    Route::get('/expired/{token}', [TokenController::class, 'expired'])->name('tokens.expired');
});

Route::prefix('games')->group(function () {
    Route::get('/history/{token}', [GameController::class, 'index'])->name('games.history');
    Route::post('/play/{token}', [GameController::class, 'store'])->name('games.play');
});
