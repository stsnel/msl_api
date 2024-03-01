<?php
namespace App\fast;

use Illuminate\Support\Facades\App;

class Fast
{
    
    protected $client;
    
    public function __construct()
    {
        if (App::environment('local')) {
            $this->client = new \GuzzleHttp\Client(['verify' => false]);
        } else {
            $this->client = new \GuzzleHttp\Client();
        }
    }
    
    
    public function facilityRequest($facilityId)
    {        
        $result =  new \stdClass();               
        
        try {
            $response = $this->client->request('GET', "https://fast.geo.uu.nl/api/facility/$facilityId", [
                'headers' => [
                    'Authorization' => '9c5f2b4bb83ad3c9059f4e2b706244748592402e9a815e6d',
                ],
            ]);
        } catch (\Exception $e) {
            dd($e);
        }

        $result->response_code = $response->getStatusCode();
        $result->response_body = [];
        
        if($result->response_code == 200) {
            $result->response_body = json_decode($response->getBody(), true);
        }
                
        return $result;
    }
    
    
}

