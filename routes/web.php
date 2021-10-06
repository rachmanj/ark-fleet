<?php

use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitmodelController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('projects/data', [ProjectController::class, 'index_data'])->name('projects.index.data');
    Route::resource('projects', ProjectController::class);

    Route::get('manufactures/data', [ManufactureController::class, 'index_data'])->name('manufactures.index.data');
    Route::resource('manufactures', ManufactureController::class);

    Route::get('unitmodels/data', [UnitmodelController::class, 'index_data'])->name('unitmodels.index.data');
    Route::resource('unitmodels', UnitmodelController::class);
    
    Route::get('equipments/data', [EquipmentController::class, 'index_data'])->name('equipments.index.data');
    Route::resource('equipments', EquipmentController::class);

    Route::get('doctypes/data', [DocumentTypeController::class, 'index_data'])->name('doctypes.index.data');
    Route::resource('doctypes', DocumentTypeController::class);

    Route::get('suppliers/data', [SupplierController::class, 'index_data'])->name('suppliers.index.data');
    Route::resource('suppliers', SupplierController::class);
});


