<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\MovingController;
use App\Http\Controllers\MovingDetailController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitmodelController;
use App\Http\Controllers\UnitstatusController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('equipments/data', [EquipmentController::class, 'index_data'])->name('equipments.index.data');
    Route::resource('equipments', EquipmentController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('projects/data', [ProjectController::class, 'index_data'])->name('projects.index.data');
    Route::resource('projects', ProjectController::class);

    Route::get('manufactures/data', [ManufactureController::class, 'index_data'])->name('manufactures.index.data');
    Route::resource('manufactures', ManufactureController::class);

    Route::get('unitmodels/data', [UnitmodelController::class, 'index_data'])->name('unitmodels.index.data');
    Route::resource('unitmodels', UnitmodelController::class);

    Route::get('doctypes/data', [DocumentTypeController::class, 'index_data'])->name('doctypes.index.data');
    Route::resource('doctypes', DocumentTypeController::class);

    Route::get('suppliers/data', [SupplierController::class, 'index_data'])->name('suppliers.index.data');
    Route::resource('suppliers', SupplierController::class);

    Route::get('categories/data', [CategoryController::class, 'index_data'])->name('categories.index.data');
    Route::resource('categories', CategoryController::class);

    Route::get('unitstatuses/data', [UnitstatusController::class, 'index_data'])->name('unitstatuses.index.data');
    Route::resource('unitstatuses', UnitstatusController::class);

    Route::get('movings/data', [MovingController::class, 'index_data'])->name('movings.index.data');
    Route::get('movings/{moving}/print_pdf', [MovingController::class, 'print_pdf'])->name('movings.print_pdf');
    Route::resource('movings', MovingController::class);

    Route::get('moving_details/incart/data', [MovingDetailController::class, 'unit_incart_data'])->name('moving_details.unit_incart.data');
    Route::get('moving_details/{from_project_id}/data', [MovingDetailController::class, 'available_unit_data'])->name('moving_details.available_unit.data');

    Route::get('moving_details/{moving_id}/create', [MovingDetailController::class, 'create'])->name('moving_details.create');
    Route::post('moving_details', [MovingDetailController::class, 'store'])->name('moving_details.store');
    Route::patch('moving_details/{equipment_id}/add_tocart', [MovingDetailController::class, 'add_tocart'])->name('moving_details.add_tocart');
    Route::patch('moving_details/{equipment_id}/remove_fromcart', [MovingDetailController::class, 'remove_fromcart'])->name('moving_details.remove_fromcart');
});

Route::get('/model_detail', [UnitmodelController::class, 'get_model_detail'])->name('get_model_detail');
