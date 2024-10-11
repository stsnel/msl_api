<?php

namespace App\CkanClient;

use App\CkanClient\Response\BaseResponse;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\TransferException;

class Client
{

    /**
     * @var GuzzleClient Guzzle HTTP client instance
     */
    private $client;

    /**
     * @var string CKAN API token
     */
    private $apiToken;

    /**
     * @var string CKAN Base path to CKAN API
     */
    private $ckanApiUrl;

    /**
     * Contructs a new CKAN client
     */
    public function __construct()
    {
        $this->client = new GuzzleClient();
        $this->apiToken = config('ckan.ckan_api_token');
        $this->ckanApiUrl = config('ckan.ckan_api_url');
    }

    public function get($request): mixed
    {
        try {
            $response = $this->client->request(
                $request->getMethod(),
                $this->ckanApiUrl . $request->getEndpoint(),
                $this->getPayload($request)
            );
            
            $body = json_decode($response->getBody(), true);
            $statusCode = $response->getStatusCode();
        } catch (TransferException $e) {

            dd($e->getMessage());
        }
        
        $responseClassName = $request->getResponseClass();
        return new $responseClassName($body, $statusCode);
    }

    private function getPayload($request) {
        $basePayload = [
            'headers' => [
                'Authorization' => $this->apiToken,
                'Accept'        => 'application/json',
            ],
            'http_errors' => false
        ];

        return array_merge($basePayload, $request->getPayloadAsArray());
    }


}