<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function unitmodel()
    {
        return $this->belongsTo(Unitmodel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
