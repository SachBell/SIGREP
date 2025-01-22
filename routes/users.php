<?php

use App\Http\Controllers\Admin\ApplicationController as AdminAppController;
use App\Http\Controllers\Users\ApplicationController as UserAppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController as AdminController;
use App\Http\Controllers\Admin\InstitutesController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\Users\FormController as UserController;
use App\Http\Controllers\ProfileController;

// ADMIN ROUTES

Route::prefix('admin')->middleware(['auth', 'role:1'])->group(function () {

    // GETS
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::get('/registros', [AdminController::class, 'index'])->name('admin.registros.index');
    Route::get('/registros/edit/{id}', [AdminController::class, 'edit'])->name('admin.registros.edit');
    Route::get('/registros/export', [AdminController::class, 'export'])->name('admin.registros.export');
    Route::get('/institutes', [InstitutesController::class, 'index'])->name('admin.institutes.index');
    Route::get('/institutes/create', [InstitutesController::class, 'create'])->name('admin.institutes.create');
    Route::get('/institutes/edit/{id}', [InstitutesController::class, 'edit'])->name('admin.institutes.edit');
    Route::get('user-manager', [UserManagerController::class, 'index'])->name('admin.user-manager.index');
    Route::get('/user-manager/edit/{id}', [UserManagerController::class, 'edit'])->name('admin.user-manager.edit');
    Route::get('/application-calls', [AdminAppController::class, 'index'])->name('admin.application-calls.index');
    Route::get('/application-calls/create', [AdminAppController::class, 'create'])->name('admin.application-calls.create');
    Route::get('/application-calls/edit/{id}', [AdminAppController::class, 'edit'])->name('admin.application-calls.edit');
    // PATCHS
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    // DELETES
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    Route::delete('/registros/{id}', [AdminController::class, 'destroy'])->name('admin.registros.destroy');
    Route::delete('/institutes/{id}', [InstitutesController::class, 'destroy'])->name('admin.institutes.destroy');
    Route::delete('/user-manager/{id}', [UserManagerController::class, 'destroy'])->name('admin.user-manager.destroy');
    Route::delete('/application-calls/{id}', [AdminAppController::class, 'destroy'])->name('admin.application-calls.destroy');
    // PUTS
    Route::put('/registros/{id}', [AdminController::class, 'update'])->name('admin.registros.update');
    Route::put('/institutes/{id}', [InstitutesController::class, 'update'])->name('admin.institutes.update');
    Route::put('/user-manager/{id}', [UserManagerController::class, 'update'])->name('admin.user-manager.update');
    Route::put('/user-manager/{id}', [UserManagerController::class, 'update'])->name('admin.user-manager.update');
    Route::put('/application-calls/{id}', [AdminAppController::class, 'update'])->name('admin.application-calls.update');
    // POSTS
    Route::post('/institutes/create', [InstitutesController::class, 'store'])->name('admin.institutes.store');
    Route::post('/application-calls/create', [AdminAppController::class, 'store'])->name('admin.application-calls.create');
});

// USER ROUTES

Route::middleware('auth')->group(function () {
    // GETS
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::get('/forms', [UserAppController::class, 'index'])->name('user.form-register.index');
    Route::get('/forms/create/{id}', [UserAppController::class, 'create'])->name('user.form-register.create');
    // PATCHS
    Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::put('/profile', [ProfileController::class, 'dataUpdate'])->name('user.profile.dataUpdate');
    // DELETES
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');
    // POSTS
    Route::post('/forms/create', [UserAppController::class, 'store'])->name('user.form-register.store');
    Route::post('/profile', [UserController::class, 'store'])->name('user.profile.dataStore');
});

require __DIR__ . '/auth.php';
