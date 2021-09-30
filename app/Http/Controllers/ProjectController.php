<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {

        Project::create($request->all());

        return redirect()->route('project.index')->with('success', 'Data successfully added');
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $project->update($request->all());
        return redirect()->route('project.index')->with('success', 'Data successfully updated');
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
                ->toJson();
    }
}
