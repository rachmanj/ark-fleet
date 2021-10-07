@extends('templates.main')

@section('title_page')
    Categories
@endsection

@section('breadcrumb_title')
    categories
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit Category Data</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" value="{{ old('name', $category->name) }}" type="text" class="form-control" id="name" autofocus>
              </div>
            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection



