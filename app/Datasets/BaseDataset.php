<?php
namespace App\Datasets;

class BaseDataset
{
    public $title;
    
    public $msl_source;
    
    public $name;
    
    public $private = false;
    
    public $owner_org;
    
    public $notes;
    
    public $msl_pids = [];
}

