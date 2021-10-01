<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        Manufacture::create($request->all());

        return redirect()->route('manufacture.index')->with('success', 'Data successfully added');
    }

    public function edit($id)
    {
        $manufacture = Manufacture::find($id);

        return view('manufactures.edit', compact('manufacture'));
    }

    public function update(Request $request, $id)
    {
        $manufacture = Manufacture::find($id);

        $manufacture->update($request->all());
        return redirect()->route('manufacture.index')->with('success', 'Data successfully updated');
    }

    public function destroy($id)
    {
        $manufacture = Manufacture::find($id);

        $manufacture->delete();
        return redirect()->route('manufacture.index')->with('success', 'Data successfully deleted');
    }

    public function index_data()
    {
        $manufacture = Manufacture::latest()->get();

        return datatables()->of($manufacture)
                ->addIndexColumn()
                ->addColumn('action', 'manufactures.action')
                ->toJson();
    }
}
