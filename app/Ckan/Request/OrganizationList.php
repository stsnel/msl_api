<?php
namespace App\Ckan\Request;

class OrganizationList
{
    public $endPoint;
    
    public $method = 'GET';
    
    public $payload;
        
    public $allFields = true;
    
    public function __construct()
    {
        $this->endPoint = config('ckan.ckan_api_url') . 'action/organization_list';
    }
    
    public function getPayloadAsArray()
    {
        if($this->allFields) {
            return [
                'query' => [
                    'all_fields' => true,
                ],
                'http_errors' => false
            ];
        }
        return [
            'http_errors' => false
        ];
    }
}

