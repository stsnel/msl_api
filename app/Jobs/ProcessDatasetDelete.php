<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DatasetDelete;
use App\Ckan\Request\DatasetPurge;

class ProcessDatasetDelete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $datasetDelete;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DatasetDelete $datasetDelete)
    {
        $this->datasetDelete = $datasetDelete;
    }    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
                        
        $DatasetPurgeRequest = new DatasetPurge();
        $DatasetPurgeRequest->id = $this->datasetDelete->ckan_id;
                
        try {
            $response = $client->request($DatasetPurgeRequest->method, 
                $DatasetPurgeRequest->endPoint,
                $DatasetPurgeRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->datasetDelete->response_code = $response->getStatusCode();
        $this->datasetDelete->processed = now();
        $this->datasetDelete->save();               
    }
}
