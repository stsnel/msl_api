<?php

namespace App\Response;

class RockPhysicsResult
{
    public $id = "";

    public $notes = "";

    public function __construct($data) {
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }

        if(isset($data['notes'])) {
            $this->notes = $data['notes'];
        }
    }
}
