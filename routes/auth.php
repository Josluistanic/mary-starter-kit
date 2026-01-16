<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'pages::login')->name('login');
    Route::livewire('/register', 'pages::register')->name('register');
    // Route::livewire('/forgot-password','auth.forgot-password')->name('forgot-password');
    // Route::livewire('/reset-password','auth.reset-password')->name('reset-password');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');

    Route::livewire('/', 'pages::dashboard')->name('dashboard');
});
