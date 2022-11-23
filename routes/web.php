<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified','role:1'])
    ->name('student.')
    ->prefix('student')
    ->group(function(){
        Route::get('/home',[App\Http\Controllers\Student\HomeController::class,'index'])
            ->middleware(['auth', 'verified'])
            ->name('home');
});

Route::middleware(['auth','verified','role:2'])
    ->name('teacher.')
    ->prefix('teacher')
    ->group(function(){
        Route::get('/home',[App\Http\Controllers\Teacher\HomeController::class,'index'])
            ->middleware(['auth', 'verified'])
            ->name('home');
});

Route::middleware(['auth','verified','role:3'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/home',[App\Http\Controllers\Admin\HomeController::class,'index'])
            ->middleware(['auth', 'verified'])
            ->name('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
