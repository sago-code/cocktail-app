<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\CocktailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/list-cocktails');
    }
    return redirect('/login');
});

Route::get('/list-cocktails', [CocktailController::class, 'list'])
    ->middleware(['auth', 'verified'])
    ->name('list-cocktails');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/list-cocktails', [CocktailController::class, 'list'])->name('list-cocktails');
    Route::get('/cocktails/stored', [CocktailController::class, 'stored'])->name('cocktails.stored');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';
