<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentTypeRequest;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctypes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentTypeRequest $request)
    {
        DocumentType::create($request->validated());
        return redirect()->route('doctypes.index')->with('success', 'Data succesfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $doctype)
    {
        return view('doctypes.edit', compact('doctype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDocumentTypeRequest $request, DocumentType $doctype)
    {
        $doctype->update($request->validated());
        return redirect()->route('doctypes.index')->with('success', 'Data succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $doctype)
    {
        $doctype->delete();
        return redirect()->route('doctypes.index')->with('success', 'Data succesfully deleted');
    }

    public function index_data()
    {
        $doctypes = DocumentType::orderBy('name', 'asc')->get();

        return datatables()->of($doctypes)
                ->addIndexColumn()
                ->addColumn('action', 'doctypes.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
