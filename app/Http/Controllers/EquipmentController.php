<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Equipment;
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
        $this->validate($request, [
            'unit_no'   => ['required', 'unique:equipments,unit_no'],
        ]);

        Equipment::create(array_merge($request->validated(), [
            'unit_no' => $request->unit_no,
            'serial_no' => $request->serial_no,
            'chasis_no' => $request->chasis_no,
            'machine_no' => $request->machine_no,
            'engine_model' => $request->engine_model,
            'no_polisi' => $request->no_polisi,
            'bahan_bakar' => $request->bahan_bakar,
            'color' => $request->body_color,
        ]));

        return redirect()->route('equipments.index')->with('success', 'Data successfully added');
    }

    public function show($id)
    {
        $equipment = Equipment::with('unitmodel.manufacture')->where('id', $id)->first();

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

    public function equipment_movings_data($id)
    {
        $movings = DB::table('movings')
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

        return datatables()->of($movings)
                    ->editColumn('ipa_date', function ($movings) {
                        return date('d-M-Y', strtotime($movings->ipa_date));
                    })
                    ->addIndexColumn()
                    ->toJson();
    }

    public function equipment_legals_data($id)
    {
        $document_types = [2, 3]; // document type : BPKB dan STNK

        $documents = Document::with('document_type')->where('equipment_id', $id)
                    ->whereIn('document_type_id', $document_types)
                    ->orderBy('document_date', 'desc')
                    ->get();

        return datatables()->of($documents)
                    ->editColumn('document_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->document_date));
                    })
                    ->editColumn('due_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->due_date));
                    })
                    ->addColumn('doctype', function ($documents) {
                        return $documents->document_type->name;
                    })
                    ->addColumn('amount', function ($documents) {
                        return number_format($documents->amount, 0);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', 'equipments.tabs.legals_action')
                    ->rawColumns(['action'])
                    ->toJson();
    }

    public function equipment_acquisitions_data($id)
    {
        $document_type = DocumentType::where('name', 'Purchase Order')->first();

        $documents = Document::with('document_type')->where('equipment_id', $id)
                    ->where('document_type_id', $document_type->id)
                    ->orderBy('document_date', 'desc')
                    ->get();

        return datatables()->of($documents)
                    ->editColumn('document_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->document_date));
                    })
                    ->editColumn('due_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->due_date));
                    })
                    ->addColumn('doctype', function ($documents) {
                        return $documents->document_type->name;
                    })
                    ->addColumn('amount', function ($documents) {
                        return number_format($documents->amount, 0);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', 'equipments.tabs.legals_action')
                    ->rawColumns(['action'])
                    ->toJson();
    }

    public function equipment_insurance_data($id)
    {
        $document_type = DocumentType::where('name', 'Polis Asuransi')->first();

        $documents = Document::with('document_type')->where('equipment_id', $id)
                    ->where('document_type_id', $document_type->id)
                    ->orderBy('document_date', 'desc')
                    ->get();

        return datatables()->of($documents)
                    ->editColumn('document_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->document_date));
                    })
                    ->editColumn('due_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->due_date));
                    })
                    ->addColumn('supplier', function ($documents) {
                        return $documents->supplier->name;
                    })
                    ->addColumn('premi', function ($documents) {
                        return number_format($documents->amount, 0);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', 'equipments.tabs.legals_action')
                    ->rawColumns(['action'])
                    ->toJson();
    }

    public function equipment_others_data($id)
    {
        $docs_exclude = [2, 3, 4, 6]; // not like : BPKB, STNK, Polis Asuransi, Purchase Order
        foreach ($docs_exclude as $e) {
            $docs_exclude_arr[] = ['document_type_id', 'not like', $e];
        };

        $documents = Document::with('document_type')->where('equipment_id', $id)
                    ->where($docs_exclude_arr)
                    ->orderBy('document_date', 'desc')
                    ->get();

        return datatables()->of($documents)
                    ->editColumn('document_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->document_date));
                    })
                    ->editColumn('due_date', function ($documents) {
                        return date('d-M-Y', strtotime($documents->due_date));
                    })
                    ->addColumn('doctype', function ($documents) {
                        return $documents->document_type->name;
                    })
                    ->addColumn('supplier', function ($documents) {
                        return $documents->supplier->name;
                    })
                    ->addColumn('amount', function ($documents) {
                        return number_format($documents->amount, 0);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', 'equipments.tabs.legals_action')
                    ->rawColumns(['action'])
                    ->toJson();
    }

}
