<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('throttle:40,1')->group(function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::middleware(['auth','verified'])->group(function () {
        Route::view('dashboard','dashboard')->name('dashboard');

        //settings
        Route::redirect('settings', 'settings/profile');
        Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
        Volt::route('settings/password', 'settings.password')->name('settings.password');
        Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    });

    require __DIR__.'/auth.php';
});

