<?php

use App\Http\Controllers\Dashboard\ApplicationCallsController;
use App\Http\Controllers\Dashboard\ProgresController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware(['role:student'])->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('dashboard.index');

    Route::resource('applications', ApplicationCallsController::class);
    Route::resource('progres', ProgresController::class);
});
