@extends('templates.main')

@section('title_page')
    Equipments
@endsection

@section('breadcrumb_title')
    equipments
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Equipment Data</h3>
          </div> {{-- card-header --}}

          <form>
            
            <div class="card-body">

              <dl class="row">
                <dt class="col-sm-4">Unit No</dt>
                <dd class="col-sm-8">{{ $equipment->unit_no }}</dd>
                <dt class="col-sm-4">Description</dt>
                <dd class="col-sm-8">{{ $equipment->description }}</dd>
                <dt class="col-sm-4">Model</dt>
                <dd class="col-sm-8">{{ $equipment->unitmodel->model_no . ' | ' . $equipment->unitmodel->description}}</dd>
                <dt class="col-sm-4">Manufacture</dt>
                <dd class="col-sm-8">{{ $equipment->unitmodel->manufacture->name }}</dd>
                <dt class="col-sm-4">Location</dt>
                <dd class="col-sm-8">{{ $equipment->current_project->project_code . ' - ' . $equipment->current_project->bowheer .', '. $equipment->current_project->location }}</dd>
              </dl>
              <hr>
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-four-movings-tab" data-toggle="pill" href="#custom-tabs-four-movings" role="tab" aria-controls="custom-tabs-four-movings" aria-selected="true">Movings</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-acquisitions-tab" data-toggle="pill" href="#custom-tabs-four-acquisitions" role="tab" aria-controls="custom-tabs-four-acquisitions" aria-selected="false">Acquisitions</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-legals-tab" data-toggle="pill" href="#custom-tabs-four-legals" role="tab" aria-controls="custom-tabs-four-legals" aria-selected="false">Legal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-insurance-tab" data-toggle="pill" href="#custom-tabs-four-insurance" role="tab" aria-controls="custom-tabs-four-insurance" aria-selected="false">Insurance</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-four-others-tab" data-toggle="pill" href="#custom-tabs-four-others" role="tab" aria-controls="custom-tabs-four-others" aria-selected="false">Others</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-four-tabContent">

                    @include('equipments.tabs.movings')

                    @include('equipments.tabs.acquisition')
                    
                    @include('equipments.tabs.legals')
                    
                    @include('equipments.tabs.insurance')
                    
                    @include('equipments.tabs.others')

                  </div>
                </div>

              </div> 
              
            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <a href="{{ route('equipments.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-undo"></i>  Back</a>
            </div>


          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/datatables/css/datatables.min.css') }}"/>
@endsection

@section('scripts')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables/datatables.min.js') }}"></script>

  <script>
    $(function () {
      $("#movings").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('equipments.movings.data', $equipment->id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'ipa_no'},
          {data: 'ipa_date'},
          {data: 'from_project'},
          {data: 'to_project'},
          // {data: 'action'},
        ],
        fixedHeader: true,
      });
      $("#legals").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('equipments.legals.data', $equipment->id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'document_no'},
          {data: 'doctype'},
          {data: 'document_date'},
          {data: 'due_date'},
          {data: 'amount'},
          // {data: 'action'},
        ],
        fixedHeader: true,
        columnDefs: [
          {
            "targets": 5,
            "className": "text-right"
          }
        ],
      });
      $("#acquisitions").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('equipments.acquisitions.data', $equipment->id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'document_no'},
          {data: 'doctype'},
          {data: 'document_date'},
          {data: 'amount'},
          // {data: 'action'},
        ],
        fixedHeader: true,
        columnDefs: [
          {
            "targets": 4,
            "className": "text-right"
          }
        ],
      })
      $("#insurance").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('equipments.insurance.data', $equipment->id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'document_no'},
          {data: 'supplier'},
          {data: 'document_date'},
          {data: 'due_date'},
          {data: 'premi'},
          // {data: 'action'},
        ],
        fixedHeader: true,
        columnDefs: [
          {
            "targets": 5,
            "className": "text-right"
          }
        ],
      })
      $("#others").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('equipments.others.data', $equipment->id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'document_no'},
          {data: 'doctype'},
          {data: 'supplier'},
          {data: 'document_date'},
          {data: 'due_date'},
          {data: 'amount'},
          // {data: 'action'},
        ],
        fixedHeader: true,
        columnDefs: [
          {
            "targets": 6,
            "className": "text-right"
          }
        ],
      })
    });
  </script>
@endsection




