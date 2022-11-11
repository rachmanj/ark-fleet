<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Equipment;
use App\Http\Resources\EquipmentResource;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('equipments', function () {
    $equipments = Equipment::where('unitstatus_id', 1)->orderBy('unit_no', 'asc')->get();
    return EquipmentResource::collection($equipments);
});