@extends('templates.main')

@section('title_page')
    IPA
@endsection

@section('breadcrumb_title')
    ipa
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New IPA</h3>
          </div> {{-- card-header --}}

            <div class="card-body">

            <form action="{{ route('movings.store') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="ipa_no">IPA No</label>
                    <input name="ipa_no" type="text" class="form-control @error('ipa_no') is-invalid @enderror" id="ipa_no" autofocus>
                    @error('ipa_no')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="ipa_date">Date</label>
                    <input name="ipa_date" type="date" class="form-control @error('ipa_date') is-invalid @enderror" id="ipa_date">
                    @error('ipa_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="from_project_id">From Project</label>
                    <select name="from_project_id" class="form-control select2bs4 @error('from_project_id') is-invalid @enderror">
                      <option value="">-- select project --</option>
                      @foreach ($projects as $project)
                          <option {{ old('from_project_id') == $project->id ? "selected" : "" }} value="{{ $project->id }}">{{ $project->project_code .' - '. $project->bowheer .' - '. $project->location  }}</option>
                      @endforeach
                    </select>
                    @error('from_project_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="to_project_id">To Project</label>
                    <select name="to_project_id" class="form-control select2bs4 @error('to_project_id') is-invalid @enderror">
                      <option value="">-- select project --</option>
                      @foreach ($projects as $project)
                          <option {{ old('to_project_id') == $project->id ? "selected" : "" }} value="{{ $project->id }}">{{ $project->project_code .' - '. $project->bowheer .' - '. $project->location  }}</option>
                      @endforeach
                    </select>
                    @error('to_project_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Add Equipment</button>
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }) 
  </script>
@endsection



