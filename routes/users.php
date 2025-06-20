<?php

use App\Http\Controllers\Admin\ApplicationController as AdminAppController;
use App\Http\Controllers\Users\ApplicationController as UserAppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController as AdminController;
use App\Http\Controllers\Admin\InstitutesController;
use App\Http\Controllers\Admin\RolesPermissionsController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Users\FormController as UserController;
use App\Http\Controllers\ProfileController;

// ADMIN ROUTES
Route::middleware(['auth', 'role:admin|headteacher'])->prefix('admin')->name('admin.dashboard.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/registers/export', [AdminController::class, 'export'])->name('registers.export');
    Route::get('/user/{id}/reset-password', [UserManagerController::class, 'sendResetPassword'])->name('user-manager.resetPassword');
    Route::get('/user/user-manager', [UserManagerController::class, 'search'])->name('user-manager.search');
    Route::get('/user/registers', [AdminController::class, 'search'])->name('registers.search');
    Route::get('/user/institutes', [InstitutesController::class, 'search'])->name('institutes.search');
    Route::post('/user/user-manager', [UserManagerController::class, 'massiveUsersImport'])->name('user-manager.massive-users');
    Route::post('/user/institutes', [InstitutesController::class, 'massiveInstitutesImport'])->name('institutes.massive-institutes');

    Route::resource('admin.dashboard.', AdminController::class);
    Route::resource('user-manager', UserManagerController::class);
    Route::resource('rolespermissions', RolesPermissionsController::class);
    Route::resource('registers', AdminController::class);
    Route::resource('institutes', InstitutesController::class);
    Route::resource('applications', AdminAppController::class);
});

// USER ROUTES
Route::middleware(['auth', 'role:student'])->prefix('dashboard')->name('user.dashboard.')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [UserController::class, 'store'])->name('profile.dataUpdate');
    Route::post('/profile', [UserController::class, 'store'])->name('profile.dataStore');
    Route::get('/forms', [UserAppController::class, 'index'])->name('forms.index');
    Route::get('/forms/create/{id}', [UserAppController::class, 'create'])->name('forms.create');
    Route::post('/forms/create', [UserAppController::class, 'store'])->name('forms.store');
    Route::get('request/{id}', [PDFController::class, 'generatePDF'])->name('request.preview');
});

require __DIR__ . '/auth.php';
