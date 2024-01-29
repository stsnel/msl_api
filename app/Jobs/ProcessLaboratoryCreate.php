<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DatasetCreate;
use App\Ckan\Request\PackageCreate;
use App\Ckan\Request\PackageShow;
use App\Ckan\Response\PackageShowResponse;
use App\Ckan\Request\PackageUpdate;
use App\Models\OrganizationCreate;
use App\Ckan\Request\OrganizationShow;
use App\Ckan\Response\OrganizationShowResponse;
use App\Ckan\Request\OrganizationUpdate;
use App\Models\LaboratoryCreate;

class ProcessLaboratoryCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $laboratoryCreate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LaboratoryCreate $laboratoryCreate)
    {
        $this->laboratoryCreate = $laboratoryCreate;
    }
            

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
                
        //check if organization is already in ckan
        $packageShowRequest = new PackageShow();
        $packageShowRequest->id = $this->laboratoryCreate->laboratory['name'];
        
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
            $this->updateLaboratory($client);
        } else {
            $this->createLaboratory($client);
        }                      
                                  
    }
    
    private function createLaboratory($client)
    {
        $PackageCreateRequest = new PackageCreate();
        $PackageCreateRequest->payload = $this->laboratoryCreate->laboratory;
        
        try {
            $response = $client->request($PackageCreateRequest->method,
                $PackageCreateRequest->endPoint,
                $PackageCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->laboratoryCreate->response_code = $response->getStatusCode();
        //$this->organizationCreate->response_body = (string)$response->getBody();
        $this->laboratoryCreate->processed_type = 'insert';
        $this->laboratoryCreate->processed = now();
        $this->laboratoryCreate->save();                        
    }
    
    private function updateLaboratory($client)
    {
        $PackageCreateRequest = new PackageUpdate();
        $PackageCreateRequest->payload = $this->laboratoryCreate->laboratory;
        
        try {
            $response = $client->request($PackageCreateRequest->method,
                $PackageCreateRequest->endPoint,
                $PackageCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->laboratoryCreate->response_code = $response->getStatusCode();
        //$this->laboratoryCreate->response_body = (string)$response->getBody();
        $this->laboratoryCreate->processed_type = 'update';
        $this->laboratoryCreate->processed = now();
        $this->laboratoryCreate->save();        
    }
}
