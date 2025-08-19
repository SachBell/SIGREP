<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\ConvenantController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentPostController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Tutor\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:admin|gestor-teacher|tutor'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('app-calls', ApplicationController::class);
    Route::resource('manage-users', ManageUsersController::class);
    Route::resource('convenants', ConvenantController::class);
    Route::resource('careers', CareerController::class);
    Route::resource('student-posts', StudentPostController::class);
    Route::resource('tutor-student', StudentController::class);

    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings/emails', [SettingsController::class, 'emailsUpdate'])->name('settings.emailsUpdate');
    Route::put('settings/general', [SettingsController::class, 'generalUpdate'])->name('settings.generalUpdate');
});

Route::middleware(['role:admin|gestor-teacher'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});
