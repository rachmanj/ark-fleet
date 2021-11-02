<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        // $cek = $request->validated() + $request->city;
        // return $cek;
        // die;

        Project::create(array_merge($request->validated(), [
            'address' => $request->address,
            'city' => $request->city,
            'isActive' => 1,
            'created_by' => auth()->id()
        ]));

        return redirect()->route('projects.index')->with('success', 'Data successfully added');
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('projects.edit', compact('project'));
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        $project->update(array_merge($request->validated(), [
            'address' => $request->address,
            'city' => $request->city,
            'isActive' => $request->isActive
        ]));

        return redirect()->route('projects.index')->with('success', 'Data successfully updated');
    }

    public function index_data()
    {
        $projects = Project::orderBy('project_code')->get();

        return datatables()->of($projects)
                ->editColumn('isActive', function($projects) {
                    return $projects->isActive == 1 ? "active" : 'inactive';
                })
                ->addIndexColumn()
                ->addColumn('action', 'projects.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
