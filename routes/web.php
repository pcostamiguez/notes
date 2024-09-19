<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Middleware\CheckIfUserIsAuthenticated;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

Route::middleware([CheckIfUserIsAuthenticated::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/notes', [NoteController::class, 'index'])->name('note.index');
    Route::get('/new_note', [NoteController::class, 'create'])->name('note.create');
    Route::post('/new_note', [NoteController::class, 'store'])->name('note.store');
    Route::get('/notes/edit/{id}', [NoteController::class, 'edit'])->name('note.edit');
    Route::put('/notes/edit/{id}', [NoteController::class, 'update'])->name('note.update');
    Route::get('/notes/destroy/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
