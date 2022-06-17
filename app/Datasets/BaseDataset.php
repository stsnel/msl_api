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
    
    public $msl_technical_description;

    public $msl_doi;
    
    public $msl_handle;
    
    public $msl_publication_day;
    
    public $msl_publication_month;
    
    public $msl_publication_year;
    
    public $msl_publication_date;
    
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
    
    public $msl_porefluids = [];
    
    public $msl_rockphysics = [];
    
    public $msl_analogue = [];
    
    public $msl_publisher;
    
    public $msl_citation;
    
    public $msl_collection_period = [];
    
    
    public function addSubDomain($subDomain) {
        switch($subDomain) {
            case "rock and melt physics":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'rock and melt physics'];
                }                
                break;
            
            case "analogue modelling of geologic processes":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'analogue modelling of geologic processes'];
                }
                break;
                
            case "microscopy and tomography":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'microscopy and tomography'];
                }
                break;
                
            case "paleomagnetism":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'paleomagnetism'];
                }
                break;
                
            case "geochemistry":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'geochemistry'];
                }
                break;
                                
            default:
                throw new \Exception('attempt to add invalid subdomain');
        }
    }
    
    public function hasSubDomain($subDomain) {
        foreach ($this->msl_subdomains as $key => $value) {            
            if($value['msl_subdomain'] == $subDomain) {
                return true;
            }
        }
        
        return false;
    }
    
}

