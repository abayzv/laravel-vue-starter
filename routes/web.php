<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripEntryController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['can:view dashboard']], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

Route::group(['middleware' => ['can:view user', 'can:delete user']], function () {
    Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('user.view');
});

Route::group(['middleware' => ['can:view trip', 'can:delete trip']], function () {
    Route::get('/trips', [TripController::class, 'index'])->middleware(['auth', 'verified'])->name('trip.view');
});

Route::group(['middleware' => ['can:view trip entry', 'can:delete trip']], function () {
    Route::get('/trip-entries', [TripEntryController::class, 'index'])->middleware(['auth', 'verified'])->name('trip-entries.view');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/design-system', function () {
        return Inertia::render('DesignSystem');
    })->name('design-system');
});

require __DIR__ . '/auth.php';
