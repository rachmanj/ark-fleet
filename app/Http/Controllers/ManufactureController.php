<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManufactureRequest;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function index()
    {
        return view('manufactures.index');
    }

    public function create()
    {
        return view('manufactures.create');
    }

    public function store(StoreManufactureRequest $request)
    {
        Manufacture::create($request->validated());

        return redirect()->route('manufactures.index')->with('success', 'Data successfully added');
    }

    public function edit($id)
    {
        $manufacture = Manufacture::find($id);

        return view('manufactures.edit', compact('manufacture'));
    }

    public function update(StoreManufactureRequest $request, Manufacture $manufacture)
    {
        $manufacture->update($request->validated());
        return redirect()->route('manufactures.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Manufacture $manufacture)
    {
        $manufacture->delete();

        return redirect()->route('manufactures.index')->with('success', 'Data successfully deleted');
    }

    public function index_data()
    {
        $manufacture = Manufacture::orderBy('name', 'asc')->get();

        return datatables()->of($manufacture)
                ->addIndexColumn()
                ->addColumn('action', 'manufactures.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
