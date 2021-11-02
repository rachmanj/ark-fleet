<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitmodel extends Model
{
    use HasFactory;

    protected $fillable = ['model_no', 'manufacture_id', 'transmisi', 'description'];

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class)->withDefault([
            'name' => 'n/a'
        ]);
    }
}
