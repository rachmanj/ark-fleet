<?php

namespace App\Http\Controllers;

use App\Models\AssetGroup;
use App\Models\PlantType;
use Illuminate\Http\Request;

class AssetGroupController extends Controller
{
    public function index()
    {
        return view('asset_groups.index');
    }

    public function create()
    {
        $plant_types = PlantType::orderBy('name')->get();
        return view('asset_groups.create', compact('plant_types'));
    }

    public function store(Request $request)
    {
        $data_tosave = $this->validate($request, [
            'plant_type_id' => 'required',
            'name' => 'required|unique:asset_groups'
        ]);

        AssetGroup::create($data_tosave);

        return redirect()->route('asset_groups.index')->with('success', 'New Asset Group successfully added');
    }

    public function edit(AssetGroup $asset_group)
    {
        $plant_types = PlantType::orderBy('name')->get();
        return view('asset_groups.edit', compact('asset_group', 'plant_types'));
    }

    public function update(Request $request, $id)
    {
        $data_tosave = $this->validate($request, [
            'plant_type_id' => ['required'],
            'name' => ['required','unique:asset_groups,name,' .$id]
        ]);

        $asset_group = AssetGroup::find($id);
        $asset_group->update($data_tosave);

        return redirect()->route('asset_groups.index')->with('success', 'Asset Group successfully updated');
    }

    public function destroy(AssetGroup $assetGroup)
    {
        $assetGroup->delete();
        return redirect()->route('asset_groups.index')->with('success', 'Asset Group successfully deleted');
    }

    public function index_data()
    {
        $asset_groups = AssetGroup::orderBy('plant_type_id', 'asc')
                            ->orderBy('name', 'asc')
                            ->get();

        return datatables()->of($asset_groups)
                ->addColumn('plant_type', function ($asset_groups) {
                    return $asset_groups->plant_type->name;
                })
                ->addIndexColumn()
                ->addColumn('action', 'asset_groups.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
