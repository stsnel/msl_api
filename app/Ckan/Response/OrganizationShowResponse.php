<?php
namespace App\Ckan\Response;

use function PHPUnit\Framework\throwException;

class OrganizationShowResponse
{
    public $response_body;
    
    public $response_code;
    
    public function __construct($responseBody, $responseCode)
    {
        $this->response_body = $responseBody;
        $this->response_code = $responseCode;
    }
    
    
    public function packageExists()
    {
        if($this->response_code == 404) {
            if(isset($this->response_body['error']['__type'])) {
                if($this->response_body['error']['__type'] == 'Not Found Error') {
                    return false;
                }
            }
        } else {
            if($this->response_code == 200) {
                return true;
            }
        }
        throw new \Exception('invalid organization_show response');
    }
    
    public function getId() {
        if(isset($this->response_body['result']['id'])) {
            return $this->response_body['result']['id'];
        }
        return null;
    }
}

