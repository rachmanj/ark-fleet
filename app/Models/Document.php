<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
            'equipment_id',
            'document_type_id',
            'document_no',
            'document_date',
            'supplier_id',
            'amount',
            'due_date',
            'user_id',
        ];
            
    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
