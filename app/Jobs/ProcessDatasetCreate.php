<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DatasetCreate;
use App\Ckan\Request\PackageCreate;
use App\Ckan\Request\PackageShow;
use App\Ckan\Response\PackageShowResponse;
use App\Ckan\Request\PackageUpdate;

class ProcessDatasetCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $datasetCreate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DatasetCreate $datasetCreate)
    {
        $this->datasetCreate = $datasetCreate;
    }
            

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        
        //check if package is already in ckan
        $packageShowRequest = new PackageShow();
        $packageShowRequest->id = $this->datasetCreate->dataset['name'];
        
        try {
            $response = $client->request(
                $packageShowRequest->method,
                $packageShowRequest->endPoint,
                $packageShowRequest->getPayloadAsArray()
                );
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $packageShowResponse = new PackageShowResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        
        if($packageShowResponse->packageExists()) {
            $this->updateDataset($client);
        } else {
            $this->createDataset($client);
        }                      
                                  
    }
    
    private function createDataset($client)
    {
        $PackageCreateRequest = new PackageCreate();
        $PackageCreateRequest->payload = $this->datasetCreate->dataset;
        
        try {
            $response = $client->request($PackageCreateRequest->method,
                $PackageCreateRequest->endPoint,
                $PackageCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->datasetCreate->response_code = $response->getStatusCode();
        $this->datasetCreate->response_body = (string)$response->getBody();
        $this->datasetCreate->processed_type = 'insert'; 
        $this->datasetCreate->processed = now();
        $this->datasetCreate->save();
    }
    
    private function updateDataset($client)
    {
        $PackageCreateRequest = new PackageUpdate();
        $PackageCreateRequest->payload = $this->datasetCreate->dataset;
        
        try {
            $response = $client->request($PackageCreateRequest->method,
                $PackageCreateRequest->endPoint,
                $PackageCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->datasetCreate->response_code = $response->getStatusCode();
        $this->datasetCreate->response_body = (string)$response->getBody();
        $this->datasetCreate->processed_type = 'update';
        $this->datasetCreate->processed = now();
        $this->datasetCreate->save();
    }
}
