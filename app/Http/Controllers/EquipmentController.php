<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\EquipmentDetail;
use App\Models\MovingDetail;
use App\Models\Project;
use App\Models\Unitmodel;
use App\Models\Unitstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        Equipment::create($request->validated());

        return redirect()->route('equipments.index')->with('success', 'Data successfully added');
    }

    public function show($id)
    {
        $equipment = Equipment::with('unitmodel.manufacture', 'ipas.moving')->where('id', $id)->first();
        
        $ipas = DB::table('movings')
                ->join('moving_details', 'movings.id', '=', 'moving_details.moving_id')
                ->join('projects as p1', 'movings.from_project_id', '=', 'p1.id')
                ->join('projects as p2', 'movings.to_project_id', '=', 'p2.id')
                ->select(
                    'movings.ipa_no',
                    'movings.ipa_date',
                    'moving_details.equipment_id as equipment_id',
                    'p1.project_code as from_project',
                    'p2.project_code as to_project',
                )
                ->where('equipment_id', $id)
                ->orderBy('ipa_date', 'desc')
                ->get();

        return view('equipments.show', compact('equipment', 'ipas'));
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
