<?php
namespace App\Ckan\Request;

class PackageShow
{
    public $endPoint;
    
    public $method = 'GET';
    
    public $payload;
    
    public $id;
    
    public function __construct()
    {
        $this->endPoint = config('ckan.ckan_api_url') . 'action/package_show';
    }
    
    public function getPayloadAsArray()
    {
        return [
            'query' => [
                'id' => $this->id
            ],
            'http_errors' => false
        ];
    }
}

