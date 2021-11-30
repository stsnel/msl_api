<?php

namespace App\Response\Elements;

class Contributor
{
    public $contributorFirstName = "";

    public $contributorFamilyName = "";

    public $contributorOrcid = "";

    public $contributorAffiliation = [];

    public $contributorRole = "";

    public function __construct($data) {
        if(isset($data['msl_contributor_first_name'])) {
            $this->contributorFirstName = $data['msl_contributor_first_name'];
        }

        if(isset($data['msl_contributor_family_name'])) {
            $this->contributorFamilyName = $data['msl_contributor_family_name'];
        }

        if(isset($data['msl_contributor_orcid'])) {
            $this->contributorOrcid = $data['msl_contributor_orcid'];
        }

        if(isset($data['msl_contributor_affiliation'])) {
            $this->contributorAffiliation = $data['msl_contributor_affiliation'];
        }

        if(isset($data['msl_contributor_role'])) {
            $this->contributorRole = $data['msl_contributor_role'];
        }
    }

}
