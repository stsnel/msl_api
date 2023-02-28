<?php
namespace App\Datasets;

use app\Datasets\Keywords\Keyword;
use App\Datasets\Keywords\Material;
use App\Datasets\Keywords\Porefluid;
use App\Datasets\Keywords\Rockphysic;
use App\Datasets\Keywords\Analogue;
use App\Datasets\Keywords\GeologicalAge;
use App\Datasets\Keywords\GeologicalSetting;
use App\Datasets\Keywords\Paleomagnetism;
use App\Datasets\Keywords\Geochemistry;
use App\Datasets\Keywords\Microscopy;

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
    
    public $msl_publisher;
    
    public $msl_citation;
    
    // vocabulary/keyword related fields
    
    public $msl_materials = [];
    
    public $msl_has_material = false;
    
    public $msl_porefluids = [];
    
    public $msl_has_porefluid = false;
    
    public $msl_rockphysics = [];
    
    public $msl_has_rockphysic = false;
    
    public $msl_analogue = [];
    
    public $msl_has_analogue = false;
    
    public $msl_collection_period = [];
    
    public $msl_geologicalages = [];
    
    public $msl_has_geologicalage = false;
    
    public $msl_geologicalsettings = [];
    
    public $msl_has_geologicalsetting = false;
    
    public $msl_paleomagnetism = [];
    
    public $msl_has_paleomagnetism = false;
    
    public $msl_geochemistry = [];
    
    public $msl_has_geochemistry = false;
    
    public $msl_microscopy = [];
    
    public $msl_has_microscopy = false;
    
    public $msl_has_lab = false;
    
    public $msl_has_organization = true;
    
    
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
    
    public function addKeyword(Keyword $keyword) {
        switch (true) {
            case $keyword instanceof Material:
                $this->msl_materials[] = $keyword->toArray();
                $this->msl_has_material = true;
                break;
                
            case $keyword instanceof Porefluid:
                $this->msl_porefluids[] = $keyword->toArray();
                $this->msl_has_porefluid = true;
                break;
                
            case $keyword instanceof Rockphysic:
                $this->msl_rockphysics[] = $keyword->toArray();
                $this->msl_has_rockphysic = true;
                break;
            
            case $keyword instanceof Analogue:
                $this->msl_analogue[] = $keyword->toArray();
                $this->msl_has_analogue = true;
                break;
                
            case $keyword instanceof GeologicalAge:
                $this->msl_geologicalages[] = $keyword->toArray();
                $this->msl_has_geologicalage = true;
                break;
                
            case $keyword instanceof GeologicalSetting:
                $this->msl_geologicalsettings[] = $keyword->toArray();
                $this->msl_has_geologicalsetting = true;
                break;
                
            case $keyword instanceof Paleomagnetism:
                $this->msl_paleomagnetism[] = $keyword->toArray();
                $this->msl_has_paleomagnetism = true;
                break;
                
            case $keyword instanceof Geochemistry:
                $this->msl_geochemistry[] = $keyword->toArray();
                $this->msl_has_geochemistry = true;
                break;
                
            case $keyword instanceof Microscopy:
                $this->msl_microscopy[] = $keyword->toArray();
                $this->msl_has_microscopy = true;
                break;
                
            default:
                throw new \Exception('invalid keyword type added');                   
        }
        
    }
    
    public function addLab($lab) {
        $this->msl_laboratories[] = $lab;
        $this->msl_has_lab = true;
    }
    
}

