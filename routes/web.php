<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('settings', 'pages/p01/settings')->name('settings');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
