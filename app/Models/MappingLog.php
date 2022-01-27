<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappingLog extends Model
{
    protected $fillable = [
        'type',
        'message',
        'source_dataset_id',
        'import_id'
    ];
    
    public function importer()
    {
        return $this->belongsTo(Importer::class);
    }
    
    public function source_dataset()
    {
        return $this->belongsTo(SourceDataset::class);
    }
}
