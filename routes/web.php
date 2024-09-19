<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Middleware\CheckIfUserIsAuthenticated;
use App\Http\Middleware\PreventDuplicateSubmissions;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

Route::middleware([CheckIfUserIsAuthenticated::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/notes', [NoteController::class, 'index'])->name('note.index');

    Route::get('/notes/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/notes/create', [NoteController::class, 'store'])
        ->middleware([PreventDuplicateSubmissions::class])
        ->name('note.store');

    Route::get('/notes/edit/{id}', [NoteController::class, 'edit'])->name('note.edit');
    Route::put('/notes/edit/{id}', [NoteController::class, 'update'])->name('note.update');

    Route::get('/notes/destroy/{id}', [NoteController::class, 'destroyConfirm'])->name('note.destroyConfirm');
    Route::delete('/notes/destroy/{id}', [NoteController::class, 'destroy'])->name('note.destroy');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
