<?php

namespace App\Response;

class MainResponse
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
    }

    public function getAsLaravelResponse() {
        return response()->json([
            'success' => $this->success,
            'message' => $this->message,
            'result' => $this->result->getAsArray()
        ], 200);
    }


}
