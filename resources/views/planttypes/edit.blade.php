@extends('templates.main')

@section('title_page')
    Plant Type
@endsection

@section('breadcrumb_title')
    planttypes
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit Plant Type Data</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('planttypes.update', $planttype->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" value="{{ old('name', $planttype->name) }}" type="text" class="form-control" id="name" autofocus>
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



