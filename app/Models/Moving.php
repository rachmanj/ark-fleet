<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moving extends Model
{
    use HasFactory;

    protected $fillable = [
        'ipa_date',
        'ipa_no',
        'from_project',
        'to_project',
        'created_by',
        'name1',
        'name2',
        'name3',
        'remarks',
    ];

    public function from_project()
    {
        return $this->belongsTo(Project::class, 'from_project', 'id');
    }

    public function to_project()
    {
        return $this->belongsTo(Project::class, 'to_project', 'id');
    }
}
