<?php
namespace App\Datasets;

class BaseDataset
{
    public $title;
    
    public $type = 'data-publication';
    
    public $msl_subdomains = [];
    
    public $msl_source;
    
    public $name;
    
    public $private = false;
    
    public $owner_org;
    
    public $notes;
    
    public $msl_pids = [];    
    
    public $msl_publication_day;
    
    public $msl_publication_month;
    
    public $msl_publication_year;
    
    public $msl_authors = [];
    
    public $msl_contributors = [];
    
    public $msl_references = [];
    
    public $tag_string = [];
    
    public $msl_spatial_coordinates = [];
    
    public $msl_geolocations = [];
    
    public $license_id;
    
    public $msl_points_of_contact = [];
    
    public $msl_laboratories = [];
    
    public $msl_downloads = [];
    
    public $msl_materials = [];
    
    public $msl_publisher;
    
    public $msl_citation;
    
    public $msl_collection_period = [];        
}

