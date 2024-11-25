<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome')->name('welcome');
Route::view('/form_registers', 'form_registers')->name('form_registers');

Route::get('/', [FormController::class, 'create'])->name('form.create');
Route::post('/', [FormController::class, 'store'])->name('form.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/registros', [FormController::class, 'index'])->name('registros.index');
    Route::get('/registros/edit/{id}', [FormController::class, 'edit'])->name('registros.edit');
    Route::put('/registros/{id}', [FormController::class, 'update'])->name('registros.update');
    Route::delete('/registros/{id}', [FormController::class, 'destroy'])->name('registros.destroy');
    Route::get('/registros/export', [FormController::class, 'export'])->name('registros.export');
});

require __DIR__.'/auth.php';
