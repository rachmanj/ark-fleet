<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitmodelRequest;
use App\Models\Manufacture;
use App\Models\Unitmodel;
use Illuminate\Http\Request;

class UnitmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unitmodels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufactures = Manufacture::orderBy('name', 'asc')->get();

        return view('unitmodels.create', compact('manufactures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitmodelRequest $request)
    {
        Unitmodel::create($request->validated());

        return redirect()->route('unitmodels.index')->with('success', 'Data successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unitmodel  $unitmodel
     * @return \Illuminate\Http\Response
     */
    public function show(Unitmodel $unitmodel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unitmodel  $unitmodel
     * @return \Illuminate\Http\Response
     */
    public function edit(Unitmodel $unitmodel)
    {
        $manufactures = Manufacture::orderBy('name', 'asc')->get();

        return view('unitmodels.edit', compact('unitmodel', 'manufactures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unitmodel  $unitmodel
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUnitmodelRequest $request, Unitmodel $unitmodel)
    {
        $unitmodel->update($request->validated());
        return redirect()->route('unitmodels.index')->with('success', 'Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unitmodel  $unitmodel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unitmodel $unitmodel)
    {
        $unitmodel->delete();
        return redirect()->route('unitmodels.index')->with('success', 'Data has been deleted');

    }

    public function index_data()
    {
        $unitmodels = Unitmodel::with('manufacture')->orderBy('model_no', 'asc')->get();

        return datatables()->of($unitmodels)
                ->editColumn('manufacture', function ($unitmodels) {
                    return $unitmodels->manufacture->name;
                })
                ->addIndexColumn()
                ->addColumn('action', 'unitmodels.action')
                ->rawColumns(['action'])
                ->toJson();
    }

    public function get_model_detail(Request $request)
    {
        if(!$request->model_id) {
            $manufacture = '';
            $model_desc = '';
        } else {
            $manufacture = '';
            $model_desc = '';
            $model = Unitmodel::with('manufacture')->where('id', $request->model_id)->first();
            $manufacture .= $model->manufacture->name;
            $model_desc .= $model->description;
        }

        return response()->json(['manufacture' => $manufacture, 'model_desc' => $model_desc]);
    }
}
