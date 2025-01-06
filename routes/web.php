<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FormController;

Route::view('/', 'welcome')->name('welcome');

Route::get('/', [FormController::class, 'create'])->name('form.create');
Route::post('/', [FormController::class, 'store'])->name('form.store');



require __DIR__.'/users.php';

