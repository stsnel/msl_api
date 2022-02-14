<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceDatasetIdentifier extends Model
{
    protected $fillable = [
        'import_id',
        'identifier'
    ];
    
    public function import()
    {
        return $this->belongsTo(Import::class);
    }
    
    public function source_dataset() {
        return $this->hasOne(SourceDataset::class);
    }
}
