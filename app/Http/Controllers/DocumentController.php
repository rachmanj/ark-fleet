<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Equipment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('documents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipments = Equipment::orderBy('unit_no', 'asc')->get();
        $doctypes = DocumentType::orderby('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return view('documents.create', compact('equipments', 'doctypes', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        Document::create(array_merge($request->validated(), [
            'user_id' => auth()->id()
        ]));
        return redirect()->route('documents.index')->with('success', 'Data succesfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $equipments = Equipment::with('unitmodel')->orderBy('unit_no', 'asc')->get();
        $doctypes = DocumentType::orderby('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return view('documents.edit', compact('document', 'equipments', 'doctypes', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDocumentRequest $request, Document $document)
    {
        $document->update($request->validated());
        return redirect()->route('documents.index')->with('success', 'Data succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Data succesfully deleted');
    }

    public function index_data()
    {
        $documents = Document::with('document_type')->latest()->get();

        return datatables()->of($documents)
                ->editColumn('document_date', function ($documents) {
                    return date('d-M-Y', strtotime($documents->document_date));
                })
                ->editColumn('due_date', function ($documents) {
                    return date('d-M-Y', strtotime($documents->due_date));
                })
                ->addColumn('doctype', function($documents) {
                    return $documents->document_type->name;
                })
                ->addIndexColumn()
                ->addColumn('action', 'documents.action')
                ->rawColumns(['action'])
                ->toJson();
    }
}
