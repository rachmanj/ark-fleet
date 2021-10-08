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

              <div class="row">

                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-movings-tab" data-toggle="pill" href="#custom-tabs-four-movings" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Movings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-acquisition-tab" data-toggle="pill" href="#custom-tabs-four-acquisition" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Acquisition</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-insurance-tab" data-toggle="pill" href="#custom-tabs-four-insurance" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Insurance</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-legal-tab" data-toggle="pill" href="#custom-tabs-four-legal" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Legal</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-others-tab" data-toggle="pill" href="#custom-tabs-four-others" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Others</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
  
                      @include('equipments.tabs.movings')
  
                      @include('equipments.tabs.acquisition')
                      
                      @include('equipments.tabs.insurance')
                      
                      @include('equipments.tabs.legal')
                      
                      @include('equipments.tabs.others')
  
                    </div>
                  </div>


                </div>

              </div> {{-- row --}}
              
              

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
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection




