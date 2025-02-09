<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Redirect to login by default
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Authentication routes
require __DIR__.'/auth.php';

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/upload', [StudentController::class, 'uploadForm'])->name('students.upload.form');
    Route::post('/upload', [StudentController::class, 'upload'])->name('students.upload');
    
});
