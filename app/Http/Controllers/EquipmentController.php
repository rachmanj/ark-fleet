<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Unitmodel;
use App\Models\Unitstatus;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return view('equipments.index');
    }

    public function create()
    {
        $projects   = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();
        $unitmodels = Unitmodel::with('manufacture')->orderBy('model_no', 'asc')->get();
        $categories = Category::orderBy('name')->get();
        $unitstatuses   = Unitstatus::orderBy('name')->get();
        
        return view('equipments.create', compact('projects', 'unitmodels', 'categories', 'unitstatuses'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Equipment $equipment)
    {
        //
    }

    public function edit(Equipment $equipment)
    {
        //
    }

    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    public function destroy(Equipment $equipment)
    {
        //
    }

    public function index_data()
    {
        $equipments = Equipment::orderBy('unit_no', 'asc')->get();

        return datatables()->of($equipments)
            ->addIndexColumn()
            ->toJson();
    }
}
