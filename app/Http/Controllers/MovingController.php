<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovingRequest;
use App\Models\Equipment;
use App\Models\Moving;
use App\Models\Project;
use Illuminate\Http\Request;

class MovingController extends Controller
{
    public function index()
    {
        return view('movings.index');
    }

    public function create()
    {
        $equipments = Equipment::with('unitmodel', 'current_project')->where('isActive', 1)->get();
        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();

        return view('movings.create', compact('equipments', 'projects'));
    }

    public function store(StoreMovingRequest $request)
    {
        $moving_flag = 'DRAFT' . auth()->id();
        $moving = Moving::create(array_merge($request->validated(), [
            'flag' => $moving_flag,
            'created_by' => auth()->id()
        ]));

        $moving_id = $moving->id;

        return redirect()->route('moving_details.create', $moving_id);
    }

    public function print_pdf($id)
    {
        $moving = Moving::with('equip_details.equipment')->where('id', $id)->first();
        // return $moving;
        // die;
        return view('movings.print_pdf', compact('moving'));
    }

    public function show(Moving $moving)
    {
        //
    }

    public function edit(Moving $moving)
    {
        //
    }

    public function update(StoreMovingRequest $request, Moving $moving)
    {
        //
    }

    public function destroy(Moving $moving)
    {
        //
    }

    public function index_data()
    {
        $movings = Moving::orderBy('ipa_date', 'desc')->get();

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
