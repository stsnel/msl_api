<?php

namespace App\Response\Elements;

class Reference
{
    public $referenceIdentifier = "";

    public $referenceIdentifierType = "";

    public $referenceTitle = "";

    public $referenceType = "";

    public function __construct($data) {
        if(isset($data['msl_reference_identifier'])) {
            $this->referenceIdentifier = $data['msl_reference_identifier'];
        }

        if(isset($data['msl_reference_identifier_type'])) {
            $this->referenceIdentifierType = $data['msl_reference_identifier_type'];
        }

        if(isset($data['msl_reference_title'])) {
            $this->referenceTitle = $data['msl_reference_title'];
        }

        if(isset($data['msl_reference_type'])) {
            $this->referenceType = $data['msl_reference_type'];
        }
    }
}
