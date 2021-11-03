@if (auth()->user()->role === 'superadmin' || auth()->user()->role == 'admin')
  <a href="{{ route('projects.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>  
@endif
