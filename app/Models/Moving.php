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
        'from_project_id',
        'to_project_id',
        'created_by',
        'name1',
        'name2',
        'name3',
        'remarks',
        'flag'
    ];

    public function from_project()
    {
        return $this->belongsTo(Project::class, 'from_project_id', 'id');
    }

    public function to_project()
    {
        return $this->belongsTo(Project::class, 'to_project_id', 'id');
    }

    public function equip_details()
    {
        return $this->hasMany(MovingDetail::class, 'moving_id', 'id');
    }
}
