<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Phpoaipmh\Endpoint;
use App\Models\Import;
use App\Models\SourceDatasetIdentifier;


class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $import;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Import $import)
    {
        $this->import = $import;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $importer = $this->import->importer;
        
        $endPoint = Endpoint::build($importer->options['endpoint']);        
        
        try {
            $results = $endPoint->listIdentifiers($importer->options['metadataPrefix'], null, null, $importer->options['setDefinition']);
        } catch (\Exception $e) {
            $this->import->response_code = 404;
            $this->import->save();
        }
        
        if($results->getTotalRecordCount() > 0) {            
            $counter = 0;
            foreach($results as $item) {
                $counter++;
                if($counter > 4) {
                    break;
                }
                $identifier = SourceDatasetIdentifier::create([
                    'import_id' => $this->import->id,
                    'identifier' => (string)$item->identifier
                ]);
                
                ProcessSourceDatasetIdentifier::dispatch($identifier);
            }
        }
        
        $this->import->response_code = 200;
        $this->import->save();
    }
}
