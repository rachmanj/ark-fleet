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
            <h3 class="card-title">{{ $report_name }}</h3>
            <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

          <div class="card-header">
            <div class="col-3">
              <form action="{{ route('reports.report1_display') }}" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                  <input type="month" value="{{ $date }}" name="date" class="form-control">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">submit</button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-head-fixed text-nowrap">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Unit No</th>
                  <th>Model</th>
                  <th>Active Date</th>
                  <th>Project</th>
                </tr>
              </thead>
              <tbody>
                @if (!$equipments->count())
                  <tr>
                    <td colspan="5" class="text-center"><h5>No data found</h5></td>
                  </tr>
                @else
                  @foreach ($equipments as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->unit_no }}</td>
                      <td>{{ $item->unitmodel->model_no }}</td>
                      <td>{{ date('d-M-Y', strtotime($item->active_date)) }}</td>
                      <td>{{ $item->current_project->project_code }}</td>
                    </tr>
                  @endforeach   
                @endif
              </tbody>
            </table>
          </div> {{-- card-body --}}
        </div> {{-- card --}}
      </div>
    </div>
@endsection


