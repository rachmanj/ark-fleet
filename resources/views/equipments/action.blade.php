<form action="{{ route('equipments.destroy', $model->id) }}" method="POST">
@csrf @method('DELETE')
  <a href="{{ route('equipments.show', $model->id) }}" class="btn btn-xs btn-success">show</a>
  <a href="{{ route('equipments.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
  <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
</form>
