<?php

namespace App\Response;

class ErrorResponse
{
    public $success = false;

    public $message = '';

    public function getAsLaravelResponse() {
        return response()->json([
            'success' => $this->success,
            'message' => $this->message
        ], 500);
    }
}
