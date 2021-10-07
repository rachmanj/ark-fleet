<form action="{{ route('unitstatuses.destroy', $model->id) }}" method="POST">
@csrf @method('DELETE')
  <a href="{{ route('unitstatuses.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
  <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
</form>
