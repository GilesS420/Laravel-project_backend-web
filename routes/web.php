<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/maps', function () {
        return view('maps.index');
    })->name('maps.index');

    Route::get('/weapons', function () {
        return view('weapons.index');
    })->name('weapons.index');

    Route::get('/community', function () {
        return view('community.index');
    })->name('community.index');
});

require __DIR__.'/auth.php';
