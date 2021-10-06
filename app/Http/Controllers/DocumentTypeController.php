<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentTypeRequest;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index()
    {
        return view('doctypes.index');
    }

    public function create()
    {
        return view('doctypes.create');
    }

    public function store(StoreDocumentTypeRequest $request)
    {
        DocumentType::create($request->validated());
        return redirect()->route('doctypes.index')->with('success', 'Data succesfully added');
    }

    public function show(DocumentType $documentType)
    {
        //
    }

    public function edit(DocumentType $doctype)
    {
        return view('doctypes.edit', compact('doctype'));
    }

    public function update(StoreDocumentTypeRequest $request, DocumentType $doctype)
    {
        $doctype->update($request->validated());
        return redirect()->route('doctypes.index')->with('success', 'Data succesfully updated');
    }

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
