<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\GoalController;




Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->name('goal.destroy');

Route::post('/goals/submit', function (Illuminate\Http\Request $request) {
    // Process goal submission logic
    return redirect('/dashboard');
})->name('goals.submit');


Route::put('/goals/{goal}', [GoalController::class, 'update'])->name('goals.update');

Route::middleware('auth')->group(function () {
    Route::resource('goal', GoalController::class);
});

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/add_goal', function () {
    return view('forms.Add_goal');
})->name('goal.add');

Route::get('/', function () {
    return view('welcome');
}) -> name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::get('/edit', [ProfileController::class, 'index'])->name('profile');


Route::get('/Salary_form', function () {
    return view('forms/salary_form');
})->name('salary_form');

Route::post('/salary', [SalaryController::class, 'store'])->name('salary.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


