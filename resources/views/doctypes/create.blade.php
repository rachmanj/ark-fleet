@extends('templates.main')

@section('title_page')
    Document Type
@endsection

@section('breadcrumb_title')
    doctypes
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Document Type</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('doctypes.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" autofocus>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
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



