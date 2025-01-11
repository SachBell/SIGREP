<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\FormController as UsersFormController;

Route::view('/', 'welcome')->name('welcome');

Route::get('/', [UsersFormController::class, 'create'])->name('form.create');
Route::post('/', [UsersFormController::class, 'store'])->name('form.store');



require __DIR__.'/users.php';

