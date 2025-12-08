<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function(){
    Volt::route('login','auth.login')->name('login');    
    Volt::route('register','auth.register')->name('register');
    // Volt::route('forgot-password','auth.forgot-password')->name('forgot-password');
    // Volt::route('reset-password','auth.reset-password')->name('reset-password');
});

Route::middleware('auth')->group(function(){
    Route::get('logout',function(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});