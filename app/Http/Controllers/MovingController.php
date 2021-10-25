<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovingRequest;
use App\Models\Equipment;
use App\Models\Moving;
use App\Models\Project;
use App\Models\Unitstatus;
use Illuminate\Http\Request;

class MovingController extends Controller
{
    public function index()
    {
        return view('movings.index');
    }

    public function create()
    {
        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();

        return view('movings.create', compact('projects'));
    }

    public function store(StoreMovingRequest $request)
    {
        $this->validate($request, [
            'ipa_no' => ['required', 'unique:movings,ipa_no']
        ]);

        $moving_flag = 'DRAFT' . auth()->id();
        $moving = Moving::create(array_merge($request->validated(), [
            'ipa_no' => $request->ipa_no,
            'flag' => $moving_flag,
            'created_by' => auth()->id()
        ]));

        $moving_id = $moving->id;

        return redirect()->route('moving_details.create', $moving_id);
    }

    public function print_pdf($id)
    {
        $moving = Moving::with('equip_details.equipment')->where('id', $id)->first();

        return view('movings.print_pdf', compact('moving'));
    }

    public function show(Moving $moving)
    {
        //
    }

    public function edit(Moving $moving)
    {
        $equipments = Equipment::with('unitmodel', 'current_project')->where('isActive', 1)->get();
        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();
        
        return view('movings.edit', compact('moving', 'equipments', 'projects'));
    }

    public function update(StoreMovingRequest $request, $id)
    {
        $data_tosave = $this->validate($request, [
            'ipa_no' => ['required', 'unique:movings,ipa_no,' .$id]
        ]);

        $moving = Moving::find($id);
        $moving->update(array_merge($request->validated(), [
            $data_tosave
        ]));

        return redirect()->route('movings.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Moving $moving)
    {
        //
    }

    public function index_data()
    {
        $movings = Moving::orderBy('ipa_date', 'desc')
                    ->orderBy('ipa_no', 'desc')
                    ->get();

        return datatables()->of($movings)
                ->editColumn('ipa_date', function ($movings) {
                    return date('d-M-Y', strtotime($movings->ipa_date));
                })
                ->editColumn('from_project', function ($movings) {
                    return $movings->from_project->project_code;
                })
                ->editColumn('to_project', function ($movings) {
                    return $movings->to_project->project_code;
                })
                ->addIndexColumn()
                ->addColumn('action', 'movings.action')
                ->rawColumns(['action'])
                ->toJson();
    }

}
