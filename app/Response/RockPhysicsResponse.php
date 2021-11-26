<?php

namespace App\Response;

class RockPhysicsResponse
{
    public $success = true;

    public $message = '';

    public $result;

    public function __construct() {
        $this->result = new ResultBlock();
    }

    public function setByCkanResponse($response) {
        $content = json_decode($response->getBody(), true);
        $this->success = (boolean)$content['success'];
        $this->result->setByCkanResponse($content);
        //dd($content);
    }

    public function getAsLaravelResponse() {
        return response()->json([
            'success' => $this->success,
            'message' => $this->message,
            'result' => $this->result->getAsArray()
        ], 200);
    }


    /**
     * $response->result->count = 14;
     * $response->result->resultCount = 10;
     * $response->result->results
     *
     */
}
