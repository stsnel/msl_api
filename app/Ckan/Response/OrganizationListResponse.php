<?php
namespace App\Ckan\Response;

use function PHPUnit\Framework\throwException;

class OrganizationListResponse
{
    public $response_body;
    
    public $response_code;
    
    public function __construct($responseBody, $responseCode)
    {
        $this->response_body = $responseBody;
        $this->response_code = $responseCode;
    }
    
    public function getOrganizationIds()
    {
        $results = [];
         
        if(isset($this->response_body['result'])) {
            if(count($this->response_body['result']) > 0) {
                foreach ($this->response_body['result'] as $result) {
                    $results[] = $result['id'];
                }
            }
        }
        
        return $results;
    }
    
    public function getOrganizations()
    {
        if(isset($this->response_body['result'])) {
            return $this->response_body['result'];            
        }
        
        return [];
    }
}

