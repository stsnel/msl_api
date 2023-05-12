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

class ProcessOrganizationCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $organizationCreate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(OrganizationCreate $organizationCreate)
    {
        $this->organizationCreate = $organizationCreate;
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
        $packageShowRequest = new OrganizationShow();
        $packageShowRequest->id = $this->organizationCreate->organization['name'];
        
        try {
            $response = $client->request(
                $packageShowRequest->method,
                $packageShowRequest->endPoint,
                $packageShowRequest->getPayloadAsArray()
                );
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $organizationShowResponse = new OrganizationShowResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        
        if($organizationShowResponse->packageExists()) {
            $this->updateOrganization($client, $organizationShowResponse->getId());
        } else {
            $this->createOrganization($client);
        }                      
                                  
    }
    
    private function createOrganization($client)
    {
        $OrganizationCreateRequest = new \App\Ckan\Request\OrganizationCreate();
        $OrganizationCreateRequest->payload = $this->organizationCreate->organization;
        
        try {
            $response = $client->request($OrganizationCreateRequest->method,
                $OrganizationCreateRequest->endPoint,
                $OrganizationCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->organizationCreate->response_code = $response->getStatusCode();
        //$this->organizationCreate->response_body = (string)$response->getBody();
        $this->organizationCreate->processed_type = 'insert'; 
        $this->organizationCreate->processed = now();
        $this->organizationCreate->save();
    }
    
    private function updateOrganization($client, $id)
    {
        $OrganizationUpdateRequest = new OrganizationUpdate();
        $OrganizationUpdateRequest->payload = $this->organizationCreate->organization;
        $OrganizationUpdateRequest->addIdToPayload($id);
        
        try {
            $response = $client->request($OrganizationUpdateRequest->method,
                $OrganizationUpdateRequest->endPoint,
                $OrganizationUpdateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $this->organizationCreate->response_code = $response->getStatusCode();
        //$this->organizationCreate->response_body = (string)$response->getBody();
        $this->organizationCreate->processed_type = 'update';
        $this->organizationCreate->processed = now();
        $this->organizationCreate->save();
    }
}
