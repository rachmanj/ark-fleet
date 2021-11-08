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
        'tujuan_row_1',
        'tujuan_row_2',
        'cc_row_1',
        'cc_row_2',
        'cc_row_3',
        'remarks',
        'created_by',
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function moving_details()
    {
        return $this->hasMany(MovingDetail::class, 'moving_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }
}
