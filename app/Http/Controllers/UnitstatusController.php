<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitstatusRequest;
use App\Models\Unitstatus;
use Illuminate\Http\Request;

class UnitstatusController extends Controller
{
    public function index()
    {
        return view('unitstatuses.index');
    }

    public function create()
    {
        return view('unitstatuses.create');
    }

    public function store(StoreUnitstatusRequest $request)
    {
        Unitstatus::create($request->validated());
        return redirect()->route('unitstatuses.index')->with('success', 'Data succesfully added');
    }

    public function edit(Unitstatus $unitstatus)
    {
        return view('unitstatuses.edit', compact('unitstatus'));
    }

    public function update(StoreUnitstatusRequest $request, Unitstatus $unitstatus)
    {
        $unitstatus->update($request->validated());
        return redirect()->route('unitstatuses.index')->with('success', 'Data succesfully updated');
    }

    public function destroy(Unitstatus $unitstatus)
    {
        $unitstatus->delete();
        return redirect()->route('unitstatuses.index')->with('success', 'Data succesfully deleted');
    }

    public function index_data()
    {
        $unitstatuses = Unitstatus::orderBy('name', 'asc')->get();

        return datatables()->of($unitstatuses)
                ->addIndexColumn()
                ->addColumn('action', 'unitstatuses.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
