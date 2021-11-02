<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\MovingController;
use App\Http\Controllers\MovingDetailController;
use App\Http\Controllers\PlantGroupController;
use App\Http\Controllers\PlantTypeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitmodelController;
use App\Http\Controllers\UnitnoHistoryController;
use App\Http\Controllers\UnitstatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('equipments/data', [EquipmentController::class, 'index_data'])->name('equipments.index.data');
    Route::get('equipments/{equipment}/movings/data', [EquipmentController::class, 'equipment_movings_data'])->name('equipments.movings.data');
    Route::get('equipments/{equipment}/changes/data', [EquipmentController::class, 'equipment_changes_data'])->name('equipments.changes.data');
    Route::get('equipments/{equipment}/legals/data', [EquipmentController::class, 'equipment_legals_data'])->name('equipments.legals.data');
    Route::get('equipments/{equipment}/acquisitions/data', [EquipmentController::class, 'equipment_acquisitions_data'])->name('equipments.acquisitions.data');
    Route::get('equipments/{equipment}/insurance/data', [EquipmentController::class, 'equipment_insurance_data'])->name('equipments.insurance.data');
    Route::get('equipments/{equipment}/others/data', [EquipmentController::class, 'equipment_others_data'])->name('equipments.others.data');
    Route::get('equipments/{equipment}/edit_detail', [EquipmentController::class, 'edit_detail'])->name('equipments.edit_detail');
    Route::put('equipments/{equipment}/update_detail', [EquipmentController::class, 'update_detail'])->name('equipments.update_detail');
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

    Route::get('documents/data', [DocumentController::class, 'index_data'])->name('documents.index.data');
    Route::get('documents/{id}/extends', [DocumentController::class, 'extends_edit'])->name('documents.extends_edit');
    Route::put('documents/{id}/extends', [DocumentController::class, 'extends_update'])->name('documents.extends_update');
    Route::resource('documents', DocumentController::class);

    Route::get('movings/data', [MovingController::class, 'index_data'])->name('movings.index.data');
    Route::get('movings/{moving}/print_pdf', [MovingController::class, 'print_pdf'])->name('movings.print_pdf');
    Route::get('movings/{moving}/before_select', [MovingController::class, 'edit_before_select_equipment'])->name('movings.before_select_equipment');
    Route::put('movings/{moving}/before_select', [MovingController::class, 'update_before_select_equipment'])->name('movings.update_before_select_equipment');
    Route::resource('movings', MovingController::class);

    Route::get('moving_details/incart/data', [MovingDetailController::class, 'unit_incart_data'])->name('moving_details.unit_incart.data');
    Route::get('moving_details/{from_project_id}/data', [MovingDetailController::class, 'available_unit_data'])->name('moving_details.available_unit.data');

    Route::get('moving_details/{moving_id}/create', [MovingDetailController::class, 'create'])->name('moving_details.create');
    Route::post('moving_details', [MovingDetailController::class, 'store'])->name('moving_details.store');
    Route::patch('moving_details/{equipment_id}/add_tocart', [MovingDetailController::class, 'add_tocart'])->name('moving_details.add_tocart');
    Route::patch('moving_details/{equipment_id}/remove_fromcart', [MovingDetailController::class, 'remove_fromcart'])->name('moving_details.remove_fromcart');

    Route::get('planttypes/data', [PlantTypeController::class, 'index_data'])->name('planttypes.index.data');
    Route::resource('planttypes', PlantTypeController::class);

    Route::get('asset_categories/data', [AssetCategoryController::class, 'index_data'])->name('asset_categories.index.data');
    Route::resource('asset_categories', AssetCategoryController::class);

    Route::get('plant_groups/data', [PlantGroupController::class, 'index_data'])->name('plant_groups.index.data');
    Route::resource('plant_groups', PlantGroupController::class);

    Route::get('unitnohistories/data', [UnitnoHistoryController::class, 'index_data'])->name('unitno_histories.index.data');
    Route::resource('unitnohistories', UnitnoHistoryController::class);

    Route::get('reports/with_overdue/data', [ReportController::class, 'document_with_overdue_data'])->name('reports.document_with_overdue_data');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/with_overdue', [ReportController::class, 'document_with_overdue'])->name('reports.document_with_overdue');
    Route::get('reports/with_overdue/{document}', [ReportController::class, 'document_with_overdue'])->name('reports.overdue_edit');

    //Users
    Route::get('/admin/activate', [UserController::class, 'activate_index'])->name('user.activate_index');
    Route::put('/admin/activate/{id}', [UserController::class, 'activate_update'])->name('user.activate_update');
    Route::get('/admin/deactivate', [UserController::class, 'deactivate_index'])->name('user.deactivate_index');
    Route::put('/admin/deactivate/{id}', [UserController::class, 'deactivate_update'])->name('user.deactivate_update');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    
    Route::get('/admin/users/index/data', [UserController::class, 'index_data'])->name('users.index.data');
    Route::get('/admin/users/activate/data', [UserController::class, 'user_activate_data'])->name('user_activate.data');
    Route::get('/admin/users/deactivate/data', [UserController::class, 'user_deactivate_data'])->name('user_deactivate.data');

});

Route::get('/model_detail', [UnitmodelController::class, 'get_model_detail'])->name('get_model_detail');
Route::get('/get_plant_groups', [PlantGroupController::class, 'get_plant_group_by_plant_type_id'])->name('get_plant_groups');
