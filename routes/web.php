<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {

    Route::view('/', 'dashboard');
    Route::view('settings', 'pages/p01/settings')->name('settings');
    Route::view('treasuries', 'pages/p02/treasuries')->name('treasuries');
    Route::view('invoice-types', 'pages/p03/invoices_types')->name('invoice-types');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
