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
            <h3 class="card-title">Create New Equipment</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('equipments.store') }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="unit_no">Unit No</label>
                    <input name="unit_no" type="text" value="{{ old('unit_no') }}" class="form-control @error('unit_no') is-invalid @enderror" id="unit_no" autofocus>
                    @error('unit_no')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input name="description" type="text" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" id="description" autofocus>
                    @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Model</label>
                    <select name="model_id" id="model_id" class="form-control select2bs4 @error('model_id') is-invalid @enderror">
                      <option value="">-- select unit model --</option>
                      @foreach ($unitmodels as $unitmodel)
                          <option value="{{ $unitmodel->id }}">{{ $unitmodel->model_no . ' - ' . $unitmodel->manufacture->name }}</option>
                      @endforeach
                    </select>
                    @error('model_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
  
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Manufacture</label>
                    <input type="text" id="manufacture" class="form-control" readonly>
                  </div>
                </div>
  
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Model Desc</label>
                    <input type="text" id="model_desc" class="form-control" readonly>
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Current Project</label>
                    <select name="current_project_id" class="form-control select2bs4 @error('current_project_id') is-invalid @enderror">
                      <option value="">-- select current project --</option>
                      @foreach ($projects as $project)
                          <option value="{{ $project->id }}">{{ $project->project_code . ' - ' . $project->location }}</option>
                      @endforeach
                    </select>
                    @error('current_project_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control select2bs4 @error('category_id') is-invalid @enderror">
                      <option value="">-- select category --</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

              </div> {{-- row --}}

            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
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

@section('scripts')
    <!-- Select2 -->
  <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $("#model_id").change(function() {
      $.ajax({
        url: "{{ route('get_model_detail') }}?model_id=" + $(this).val(),
        method: 'GET',
        success: function(data) {
          $('#manufacture').val(data.manufacture);
          $('#model_desc').val(data.model_desc);
        }
      });
    });
  </script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }) 
  </script>
@endsection



