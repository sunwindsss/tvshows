<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TvShowController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/', [TvShowController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // TV Show Routes
    Route::post('/tvshows', [TvShowController::class, 'store'])->name('tvshows.store');
    Route::delete('/tvshows/{tvshow}', [TvShowController::class, 'destroy'])->name('tvshows.destroy');
});

require __DIR__ . '/auth.php';
