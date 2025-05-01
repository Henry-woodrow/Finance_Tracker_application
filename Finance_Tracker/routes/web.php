<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\MonthlyController;
use App\Http\Controllers\WeeklyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

// ─────────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────────



// Profile
Route::post('/profile/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.photo');
Route::get('forms/settings/change_email', [ProfileController::class, 'editEmail'])->name('email.edit');
Route::post('forms/settings/change_email', [ProfileController::class, 'updateEmail'])->name('email.update');

// Show the change password form
Route::get('forms/settings/change_password', [ProfileController::class, 'editPassword'])->name('password.edit');

// Handle form submission
Route::put('forms/settings/change_password', [ProfileController::class, 'updatePassword'])->name('password.update');


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');


Route::middleware(['auth'])->group(function () {
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});
// ─────────────────────────────────────────────
// AUTHENTICATED ROUTES
// ─────────────────────────────────────────────

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    // Salary
    Route::get('/Salary_form', function () {
        return view('forms/salary_form');
    })->name('salary_form');
    Route::post('/salary', [SalaryController::class, 'store'])->name('salary.store');

    // Monthly
    Route::get('/monthly', function () {
        return view('forms.Monthly');
    })->name('monthly_form');
    Route::post('/monthly', [MonthlyController::class, 'store'])->name('monthly.store');

    // Weekly
    Route::get('/weekly', function () {
        return view('forms.weekly');
    })->name('weekly_form');
    Route::post('/weekly', [WeeklyController::class, 'store'])->name('weekly.store');

    // Goals
    Route::get('/add_goal', function () {
        return view('forms.Add_goal');
    })->name('goal.add');

    Route::get('/goal', [GoalController::class, 'index'])->name('goal.index');
    Route::post('/goal', [GoalController::class, 'store'])->name('goal.store');
    Route::put('/goal/{id}', [GoalController::class, 'update'])->name('goal.update');
    Route::delete('/goal/{id}', [GoalController::class, 'destroy'])->name('goal.destroy');
});

// ─────────────────────────────────────────────
// AUTH BOILERPLATE
// ─────────────────────────────────────────────

require __DIR__.'/auth.php';
