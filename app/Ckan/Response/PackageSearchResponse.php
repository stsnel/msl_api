<?php

namespace App\Ckan\Response;

class PackageSearchResponse
{
    public $response_body;
    
    public $response_code;
    
    public function __construct($responseBody, $responseCode)
    {
        $this->response_body = $responseBody;
        $this->response_code = $responseCode;
    }
    
    public function getNameList() 
    {
        $names = [];
                
        if(isset($this->response_body['result']['results'])) {
            if(count($this->response_body['result']['results']) > 0) {
                foreach ($this->response_body['result']['results'] as $result) {
                    $names[] = $result['name'];
                }
            }
        }
        
        return $names;
    }
}
