<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('login');

require __DIR__.'/users.php';

