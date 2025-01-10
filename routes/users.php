<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController as AdminController;
use App\Http\Controllers\Admin\InstitutesController;
use App\Http\Controllers\Users\FormController as UserController;
use App\Http\Controllers\ProfileController;

// ADMIN ROUTES

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    Route::get('/registros', [AdminController::class, 'index'])->name('admin.registros.index');
    Route::get('/registros/edit/{id}', [AdminController::class, 'edit'])->name('admin.registros.edit');
    Route::put('/registros/{id}', [AdminController::class, 'update'])->name('admin.registros.update');
    Route::delete('/registros/{id}', [AdminController::class, 'destroy'])->name('admin.registros.destroy');
    Route::get('/registros/export', [AdminController::class, 'export'])->name('admin.registros.export');
    Route::get('/institutes', [InstitutesController::class, 'index'])->name('admin.institutes.index');
    Route::get('/institutes/edit/{id}', [InstitutesController::class, 'edit'])->name('admin.institutes.edit');
    Route::put('/institutes/{id}', [InstitutesController::class, 'update'])->name('admin.institutes.update');
    Route::delete('/institutes/{id}', [InstitutesController::class, 'destroy'])->name('admin.institutes.destroy');
    Route::get('/institutes/create', [InstitutesController::class, 'create'])->name('admin.institutes.create');
    Route::post('/institutes/create', [InstitutesController::class, 'store'])->name('admin.institutes.store');
});

// USER ROUTES

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');
    Route::view('/forms', 'user.form-register.index')->name('user.form-register.index');
});

require __DIR__.'/auth.php';
