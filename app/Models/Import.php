<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'importer_id'        
    ];    
    
    public function importer() 
    {
        return $this->belongsTo(Importer::class);
    }
    
    public function source_dataset_identifiers() {
        return $this->hasMany(SourceDatasetIdentifier::class);
    }
    
    public function mapping_logs()
    {
        return $this->hasMany(MappingLog::class);
    }
    
    public function getStatsOverview()
    {
        $sourceDatasetIdentifiers = $this->source_dataset_identifiers();
        $results = [
            'step_1_success' => 0,
            'step_1_total' => 0,
            'step_2_success' => 0,
            'step_2_total' => 0,
            'step_3_succes' => 0,
            'step_3_total' => 0
        ];
        
        return $results;
        
        foreach ($sourceDatasetIdentifiers as $sourceDatasetIdentifier)
        {
            $result = [
                'source_identifier' => $sourceDatasetIdentifier
            ];
            
        }
        
        
        return $this->source_dataset_identifiers()->where('response_code', 200)->count();
        return $this->source_dataset_identifiers()->count();
        
        
        
    }
}
