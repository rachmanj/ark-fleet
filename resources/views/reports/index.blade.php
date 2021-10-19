@extends('templates.main')

@section('title_page')
    Reports
@endsection

@section('breadcrumb_title')
    reports
@endsection

@section('content')
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Reports</h3>
          </div> {{-- card-header --}}

          <div class="card-body">
            <ol>
              <li><a href="{{ route('reports.document_with_overdue') }}">Documents yang akan jatuh tempo</a></li>
              <li>Consectetur adipiscing elit</li>
              <li>Eget porttitor lorem</li>
            </ol>
          </div> {{-- card-body --}}
        </div> {{-- card --}}
      </div>
    </div>
@endsection
