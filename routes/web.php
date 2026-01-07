<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Customer\AuthController as CustomerAuth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin/login', [AdminAuth::class, 'showLogin']);
Route::post('/admin/login', [AdminAuth::class, 'login']);
Route::post('/admin/logout', [AdminAuth::class, 'logout']);

Route::middleware('auth:admin')->get('/admin/dashboard', function () {
    return 'ADMIN DASHBOARD';
});

Route::get('/login', [CustomerAuth::class, 'showLogin']);
Route::post('/login', [CustomerAuth::class, 'login']);
Route::post('/logout', [CustomerAuth::class, 'logout']);

Route::middleware('auth:customer')->get('/dashboard', function () {
    return 'CUSTOMER DASHBOARD';
});
require __DIR__.'/auth.php';
