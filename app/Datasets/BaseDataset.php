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
    
    public $msl_publication_date;
    
    public $msl_authors = [];
    
    public $msl_references = [];
    
    public $tag_string = [];
    
    public $msl_spatial_coordinates = [];
    
    public $license_id;
    
    public $msl_points_of_contact = [];
    
    public $msl_laboratories = [];
    
    public $msl_downloads = [];
    
    public $msl_materials = [];
    
    public $msl_publisher;
}

