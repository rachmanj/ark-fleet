<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        // $projects = Project::orderBy('project_code');
        return view('register.index');
    }
}
