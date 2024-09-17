<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckIfUserIsAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::middleware([CheckIfUserIsAuthenticated::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
