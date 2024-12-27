<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->name('home');

// Community routes (publicly accessible)
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::get('/community/{user}', [CommunityController::class, 'show'])->name('community.show');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/maps', function () {
        return view('maps.index');
    })->name('maps.index');

    Route::get('/weapons', function () {
        return view('weapons.index');
    })->name('weapons.index');

    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    Route::get('/dashboard/community', [CommunityController::class, 'index'])
        ->name('dashboard.community.index');
});


Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // User management routes
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
});

// Add routes for news and FAQ management (admin only)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::delete('/news/{newsItem}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::put('/news/{newsItem}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/faq/{faqItem}', [FaqController::class, 'destroy'])->name('faq.destroy');
    Route::put('/faq/{faqItem}', [FaqController::class, 'update'])->name('faq.update');
});

require __DIR__.'/auth.php';
