@extends('templates.main')

@section('title_page')
    Projects
@endsection

@section('breadcrumb_title')
    projects
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Project</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="project_code">Project Code</label>
                <input name="project_code" type="text" class="form-control @error('project_code') is-invalid @enderror" id="project_code" autofocus>
                @error('project_code')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="bowheer">Bowheer</label>
                <input name="bowheer" type="text" class="form-control  @error('bowheer') is-invalid @enderror" id="bowheer">
                @error('bowheer')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="location">Location</label>
                <input name="location" type="text" class="form-control  @error('location') is-invalid @enderror" id="location">
                @error('location')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input name="address" type="text" class="form-control" id="address">
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <input name="city" type="text" class="form-control" id="city">
              </div>
            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection



