@extends('templates.main')

@section('title_page')
    Suppliers
@endsection

@section('breadcrumb_title')
    suppliers
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Supplier</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" autofocus>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="remarks">Remarks</label>
                <input name="remarks" type="text" value="{{ old('remarks') }}" class="form-control @error('remarks') is-invalid @enderror" id="remarks" autofocus>
                @error('remarks')
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



