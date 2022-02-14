<?php

namespace App\Ckan\Request;

class DatasetPurge
{
    public $endPoint;
    
    public $method = 'POST';

    public $id;

    public function __construct() {
        $this->endPoint = config('ckan.ckan_api_url') . 'action/dataset_purge';
    }
    
    public function getPayloadAsArray() {
        return [
            'headers' => [
                'Authorization' => config('ckan.ckan_api_token'),
                'Accept'        => 'application/json',
            ],
            'form_params' => [
                'id' => $this->id
            ],
            'http_errors' => false
        ];
    }
}
