<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
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

    public function store(StoreEquipmentRequest $request)
    {
        // return $request;
        // die;

        Equipment::create($request->validated());

        return redirect()->route('equipments.index')->with('success', 'Data successfully added');
    }

    public function show(Equipment $equipment)
    {
        return view('equipments.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $projects   = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();
        $unitmodels = Unitmodel::with('manufacture')->orderBy('model_no', 'asc')->get();
        $categories = Category::orderBy('name')->get();
        $unitstatuses   = Unitstatus::orderBy('name')->get();
        
        return view('equipments.edit', compact('equipment', 'projects', 'unitmodels', 'categories', 'unitstatuses'));
    }

    public function update(StoreEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update(array_merge($request->validated(), [
            'serial_no'     => $request->serial_no,
            'chasis_no'     => $request->chasis_no,
            'machine_no'    => $request->machine_no,
            'nomor_polisi'  => $request->nomor_polisi,
            'warna'         => $request->warna,
            'bahan_bakar'   => $request->bahan_bakar,
            'bahan_bakar'   => $request->bahan_bakar,
        ]));
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipments.index')->with('success', 'Data successfully deleted');
    }

    public function index_data()
    {
        $equipments = Equipment::with('unitmodel', 'current_project', 'category')
                        ->orderBy('unit_no', 'asc')->get();

        return datatables()->of($equipments)
            ->addColumn('model', function($equipments) {
                return $equipments->unitmodel->model_no;
            })
            ->addColumn('category', function($equipments) {
                return $equipments->category->name;
            })
            ->addColumn('current_project', function($equipments) {
                return $equipments->current_project->project_code;
            })
            ->addIndexColumn()
            ->addColumn('action', 'equipments.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
