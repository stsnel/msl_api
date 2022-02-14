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
        $results = [
            'step_1_success' => 0,
            'step_1_total' => 0,
            'step_2_success' => 0,
            'step_2_total' => 0,
            'step_3_success' => 0,
            'step_3_total' => 0
        ];
        
        $sourceDatasetIdentifiers = $this->source_dataset_identifiers;
        if(count($sourceDatasetIdentifiers) > 0) {
            foreach ($sourceDatasetIdentifiers as $sourceDatasetIdentifier) {
                $results['step_1_total']++;
                if($sourceDatasetIdentifier->response_code == 200) {
                    $results['step_1_success']++;
                }
                
                $sourceDataset = $sourceDatasetIdentifier->source_dataset;
                if($sourceDataset) {
                    $results['step_2_total']++;
                    if($sourceDataset->status == 'succes') {
                        $results['step_2_success']++;                                                
                    }
                    
                    $datasetCreate = $sourceDataset->dataset_create;
                    if($datasetCreate) {
                        $results['step_3_total']++;
                        if($datasetCreate->response_code == 200) {
                            $results['step_3_success']++;
                        }
                    }
                }                                
            }
        }
                
        return $results;
    }
}
