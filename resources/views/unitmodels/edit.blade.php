@extends('templates.main')

@section('title_page')
    Manufactures
@endsection

@section('breadcrumb_title')
    manufactures
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit Manufacture Data</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('manufactures.update', $manufacture->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" value="{{ old('name', $manufacture->name) }}" type="text" class="form-control" id="name" autofocus>
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



