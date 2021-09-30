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
            <h3 class="card-title">Edit Project Data</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('project.update', $project->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
              <div class="form-group">
                <label for="project_code">Project Code</label>
                <input name="project_code" value="{{ old('project_code', $project->project_code) }}" type="text" class="form-control" id="project_code" autofocus>
              </div>
              <div class="form-group">
                <label for="bowheer">Bowheer</label>
                <input name="bowheer" value="{{ old('bowheer', $project->bowheer) }}" type="text" class="form-control" id="bowheer">
              </div>
              <div class="form-group">
                <label for="location">Location</label>
                <input name="location" value="{{ old('location', $project->location) }}" type="text" class="form-control" id="location">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input name="address" value="{{ old('address', $project->address) }}" type="text" class="form-control" id="address">
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <input name="city" value="{{ old('city', $project->city) }}" type="text" class="form-control" id="city">
              </div>
              <div class="form-group">
                <label for="isActive">isActive</label>
                <select name="isActive" class="form-control" id="isActive">
                  <option value="1" {{ $project->isActive == 1 ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ $project->isActive == 0 ? 'selected' : '' }}>in-Active</option>
                </select>
              </div>
            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection



