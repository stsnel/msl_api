<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Phpoaipmh\Endpoint;
use App\Models\SourceDatasetIdentifier;
use App\Models\SourceDataset;

class ProcessSourceDatasetIdentifier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $sourceDatasetIdentifier;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SourceDatasetIdentifier $sourceDatasetIdentifier)
    {
        $this->sourceDatasetIdentifier = $sourceDatasetIdentifier;
    }
        

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $importer = $this->sourceDatasetIdentifier->import->importer;
        
        $endPoint = Endpoint::build($importer->options['endpoint']);
        
        $result = $endPoint->getRecord($this->sourceDatasetIdentifier->identifier, $importer->options['metadataPrefix']);
        
        if($result) {
            $SourceDataset = SourceDataset::create([
                'source_dataset_identifier_id'=> $this->sourceDatasetIdentifier->id,
                'source_dataset' => $result->asXML()
            ]);
            
            ProcessSourceDataset::dispatch($SourceDataset);
            
            $this->sourceDatasetIdentifier->response_code = 200;
            $this->sourceDatasetIdentifier->save();
        } else {
            $this->sourceDatasetIdentifier->response_code = 404;
            $this->sourceDatasetIdentifier->save();
        }
        
        
    }
}
