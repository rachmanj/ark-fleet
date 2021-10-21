<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $projects = Project::orderBy('project_code', 'asc')->get();

        return view('admin.users.edit', compact('user', 'projects'));
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required|min:3|max:255',
            'username'      => ['required','min:3','max:20', 'unique:users,username,'. $id],
            'email'         => ['required','email','unique:users,email,'. $id],
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->project_id = $request->project_id;
        $user->role = $request->role;
        $user->update();

        return redirect()->route('users.index')->with('status', 'Data successfully updated!');

    }

    public function activate_index()
    {
        return view('admin.users.activate.index');
    }

    public function deactivate_index()
    {
        return view('admin.users.activate.deactivate_index');
    }

    public function activate_update($id)
    {
        $user = User::find($id);

        $user->is_active = 1;
        $user->update();

        return redirect()->route('user.activate_index')->with('status', 'User successfully activated');
    }

    public function deactivate_update($id)
    {
        $user = User::find($id);

        $user->is_active = 0;
        $user->update();

        return redirect()->route('user.deactivate_index')->with('status', 'User successfully Deactivated');
    }

    public function index_data()
    {
        $users = User::all();

        return datatables()->of($users)
            ->editColumn('created_at', function ($users) {
                 return Carbon::parse($users->created_at)->diffForHumans();
                
            })
            ->addColumn('project', function ($users) {
                return $users->project->project_code;
            })
            ->addIndexColumn()
            ->addColumn('action', 'admin.users.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function user_activate_data()
    {
        $users = User::where('is_active', 0)->get();

        return datatables()->of($users)
            ->editColumn('created_at', function ($users) {
                $date   = Carbon::parse($users->created_at);
                return $date->diffForHumans();
            })
            ->addColumn('project', function ($users) {
                return $users->project->project_code;
            })
            ->addIndexColumn()
            ->addColumn('action', 'admin.users.activate.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function user_deactivate_data()
    {
        $users = User::where('is_active', 1)->get();

        return datatables()->of($users)
        ->editColumn('created_at', function ($users) {
                $date   = Carbon::parse($users->created_at);
                return $date->diffForHumans();
            })
            ->addColumn('project', function ($users) {
                return $users->project->project_code;
            })
            ->addIndexColumn()
            ->addColumn('action', 'admin.users.activate.deactivate_action')
            ->rawColumns(['action'])
            ->toJson();
    }

    
}
