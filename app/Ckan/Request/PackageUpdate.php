<?php
namespace App\Ckan\Request;

class PackageUpdate
{
    public $endPoint;
    
    public $method = 'POST';
    
    public $payload;
    
    public function __construct() {
        $this->endPoint = config('ckan.ckan_api_url') . 'action/package_update';
    }
    
    public function getPayloadAsArray() {
        return [
            'headers' => [
                'Authorization' => config('ckan.ckan_api_token'),
                'Accept'        => 'application/json',
            ],
            'json' => $this->payload,
            'http_errors' => false
        ];
    }
}

