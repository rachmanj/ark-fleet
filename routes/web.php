<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::middleware('auth')->prefix('projects')->name('project.')->group(function () {
    Route::get('/data', [ProjectController::class, 'index_data'])->name('index.data');

    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/create', [ProjectController::class, 'create'])->name('create');
    Route::post('/', [ProjectController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ProjectController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');
});

// Equipment
Route::middleware('auth')->prefix('equipments')->name('equipment.')->group(function () {
    Route::get('/', [EquipmentController::class, 'index'])->name('index');
});

// Manufacture
Route::middleware('auth')->prefix('manufactures')->name('manufacture.')->group(function () {
    Route::get('/data', [ManufactureController::class, 'index_data'])->name('index.data');

    Route::get('/', [ManufactureController::class, 'index'])->name('index');
    Route::get('/create', [ManufactureController::class, 'create'])->name('create');
    Route::post('/', [ManufactureController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ManufactureController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ManufactureController::class, 'update'])->name('update');
    Route::delete('/{id}', [ManufactureController::class, 'destroy'])->name('destroy');
});
