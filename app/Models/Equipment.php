<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'equipments';

    public function unitmodel()
    {
        return $this->belongsTo(Unitmodel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unitstatus()
    {
        return $this->belongsTo(Unitstatus::class);
    }
    
    public function current_project()
    {
        return $this->belongsTo(Project::class, 'current_project_id', 'id');
    }

    public function ipas()
    {
        return $this->hasMany(MovingDetail::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function moving_details()
    {
        return $this->hasMany(MovingDetail::class);
    }

    public function plant_type()
    {
        return $this->belongsTo(PlantType::class);
    }

    public function asset_category()
    {
        return $this->belongsTo(AssetCategory::class);
    }

    public function unitno_histories()
    {
        return $this->hasMany(UnitnoHistory::class)->orderby('date', 'desc');
    }

}
