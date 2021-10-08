<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovingRequest;
use App\Models\Moving;
use Illuminate\Http\Request;

class MovingController extends Controller
{
    public function index()
    {
        return view('movings.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreMovingRequest $request)
    {
        //
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
                ->addIndexColumn()
                ->addColumn('action', 'movings.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
