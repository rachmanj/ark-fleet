@if (auth()->user()->role == 'superadmin')
  <a href="{{ route('users.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
@endif