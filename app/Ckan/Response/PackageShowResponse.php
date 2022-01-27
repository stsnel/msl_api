<?php
namespace App\Ckan\Response;

use function PHPUnit\Framework\throwException;

class PackageShowResponse
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
        throw new \Exception('invalid package_show response');
    }
}

