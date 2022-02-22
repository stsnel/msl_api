<?php

namespace App\Response;

class ResultBlock
{
    public $count = 0;

    public $resultCount = 0;

    public $results = [];


    public function setByCkanResponse($response) {
        if(isset($response['result']['count'])) {
            $this->count = $response['result']['count'];
        }
        if(isset($response['result']['results'])) {
            $this->resultCount = count($response['result']['results']);

            foreach ($response['result']['results'] as $result) {
                if($result['type'] == "rockphysics") {
                    $this->results[] = new RockPhysicsResult($result);
                } elseif($result['type'] == "analogue") {
                    $this->results[] = new AnalogueResult($result);
                } elseif($result['type'] == "paleomagnetic") {
                    $this->results[] = new PaleoResult($result);
                }
            }
        }
    }

    public function getAsArray() {
        return (array)$this;
    }
    
        
}
