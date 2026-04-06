<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AnnouncementsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminAuthenticated;
use Illuminate\Support\Facades\Route;

// ===== Public Landing Page =====
Route::get('/', [HomeController::class, 'index'])->name('home');

// ===== Admin Auth =====
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(AdminAuthenticated::class)->group(function () {
        Route::get('/',             [DashboardController::class,    'index'])->name('dashboard');
        Route::get('announcements', [AnnouncementsController::class, 'index'])->name('announcements');
        Route::get('messages',      [MessagesController::class,      'index'])->name('messages');
        Route::get('sections',      [SectionsController::class,      'index'])->name('sections');
        Route::get('settings',      [SettingsController::class,      'index'])->name('settings');
    });
});
