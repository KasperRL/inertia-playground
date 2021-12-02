<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::inertia('/', 'Home');
    
    Route::get('/settings', [SettingsController::class, 'index']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create'])->can('create', 'App\Models\User')->middleware('can:add users');
    Route::post('/users', [UserController::class, 'store']);
    Route::middleware('can:edit users')->group(function () {
        Route::get('/users/{user:id}/edit', [UserController::class, 'edit']);
        Route::post('/users/{user:id}/edit', [UserController::class, 'update']);
    });
    Route::delete('/users/{user:id}/delete', [UserController::class, 'destroy'])->middleware('can:delete users');
});