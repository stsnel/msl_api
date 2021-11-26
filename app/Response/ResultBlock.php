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
                $this->results[] = new RockPhysicsResult($result);
            }
        }
    }

    public function getAsArray() {
        return (array)$this;
    }
}
