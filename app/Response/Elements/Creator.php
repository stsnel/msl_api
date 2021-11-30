<?php

namespace App\Response\Elements;

class Creator
{
    public $creatorFirstName = "";

    public $creatorFamilyName = "";

    public $creatorOrcid = "";

    public $creatorAffiliation = [];

    public function __construct($data) {
        if(isset($data['msl_creator_first_name'])) {
            $this->creatorFirstName = $data['msl_creator_first_name'];
        }

        if(isset($data['msl_creator_family_name'])) {
            $this->creatorFamilyName = $data['msl_creator_family_name'];
        }

        if(isset($data['msl_creator_orcid'])) {
            $this->creatorOrcid = $data['msl_creator_orcid'];
        }

        if(isset($data['msl_creator_affiliation'])) {
            $this->creatorAffiliation = $data['msl_creator_affiliation'];
        }
    }

}
