<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function document_with_overdue()
    {
        return view('reports.overdue_docs.index');
    }


    // DATA //

    public function document_with_overdue_data()
    {
        $date = Carbon::now()->addMonths(2);
        $list = Document::with('document_type', 'equipment')
                ->whereNotNull('due_date')
                ->where('due_date', '<=', $date)
                ->whereNull('extended_doc_id')
                ->get();

        return datatables()->of($list)
                ->addColumn('overdue_in', function ($list) {
                    $date   = Carbon::parse($list->due_date);
                    return $date->diffForHumans();
                })
                ->addColumn('unit_no', function ($list) {
                    return $list->equipment->unit_no;
                })
                ->addColumn('doctype', function ($list) {
                    return $list->document_type->name;
                })
                ->editColumn('due_date', function ($list) {
                    return date('d-M-Y', strtotime($list->due_date));
                })
                ->addIndexColumn()
                ->addColumn('action', 'reports.overdue_docs.action')
                ->rawColumns(['action'])
                ->toJson();
    } 
}
