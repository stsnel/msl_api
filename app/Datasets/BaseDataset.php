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
    
    public $msl_subdomains_original = [];
    
    public $msl_subdomains_interpreted = [];
    
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
    
    public $msl_collection_period = [];
    
    // vocabulary/keyword related fields
    
    public $msl_materials = [];
    
    public $msl_has_material = false;
    
    public $msl_materials_original = [];
    
    public $msl_has_material_original = false;
    
    public $msl_porefluids = [];
    
    public $msl_has_porefluid = false;
    
    public $msl_porefluids_original = [];
    
    public $msl_has_porefluid_original = false;
    
    public $msl_rockphysics = [];
    
    public $msl_has_rockphysic = false;
    
    public $msl_rockphysics_original = [];
    
    public $msl_has_rockphysic_original = false;
    
    public $msl_analogue = [];
    
    public $msl_has_analogue = false;
    
    public $msl_analogue_original = [];
    
    public $msl_has_analogue_original = false;        
    
    public $msl_geologicalages = [];
    
    public $msl_has_geologicalage = false;
    
    public $msl_geologicalages_original = [];
    
    public $msl_has_geologicalage_original = false;
    
    public $msl_geologicalsettings = [];
    
    public $msl_has_geologicalsetting = false;
    
    public $msl_geologicalsettings_original = [];
    
    public $msl_has_geologicalsetting_original = false;
    
    public $msl_paleomagnetism = [];
    
    public $msl_has_paleomagnetism = false;
    
    public $msl_paleomagnetism_original = [];
    
    public $msl_has_paleomagnetism_original = false;
    
    public $msl_geochemistry = [];
    
    public $msl_has_geochemistry = false;
    
    public $msl_geochemistry_original = [];
    
    public $msl_has_geochemistry_original = false;
    
    public $msl_microscopy = [];
    
    public $msl_has_microscopy = false;
    
    public $msl_microscopy_original = [];
    
    public $msl_has_microscopy_original = false;
    
    public $msl_enriched_keywords = [];
    
    public $msl_original_keywords = [];
    
    public $msl_has_lab = false;
    
    public $msl_has_organization = true;
    
    
    public function addSubDomain($subDomain, $original = true) {
        switch($subDomain) {
            case "rock and melt physics":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'rock and melt physics'];
                }
                if($original) {
                    if(!$this->hasOriginalSubDomain($subDomain)) {
                        $this->msl_subdomains_original[] = ['msl_subdomain_original' => 'rock and melt physics'];
                    }
                } else {
                    if(!$this->hasInterpretedSubDomain($subDomain)) {
                        $this->msl_subdomains_interpreted[] = ['msl_subdomain_interpreted' => 'rock and melt physics'];
                    }
                }
                break;
            
            case "analogue modelling of geologic processes":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'analogue modelling of geologic processes'];
                }
                if($original) {
                    if(!$this->hasOriginalSubDomain($subDomain)) {
                        $this->msl_subdomains_original[] = ['msl_subdomain_original' => 'analogue modelling of geologic processes'];
                    }
                } else {
                    if(!$this->hasInterpretedSubDomain($subDomain)) {
                        $this->msl_subdomains_interpreted[] = ['msl_subdomain_interpreted' => 'analogue modelling of geologic processes'];
                    }
                }
                break;
                
            case "microscopy and tomography":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'microscopy and tomography'];
                }
                if($original) {
                    if(!$this->hasOriginalSubDomain($subDomain)) {
                        $this->msl_subdomains_original[] = ['msl_subdomain_original' => 'microscopy and tomography'];
                    }
                } else {
                    if(!$this->hasInterpretedSubDomain($subDomain)) {
                        $this->msl_subdomains_interpreted[] = ['msl_subdomain_interpreted' => 'microscopy and tomography'];
                    }
                }
                break;
                
            case "paleomagnetism":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'paleomagnetism'];
                }
                if($original) {
                    if(!$this->hasOriginalSubDomain($subDomain)) {
                        $this->msl_subdomains_original[] = ['msl_subdomain_original' => 'paleomagnetism'];
                    }
                } else {
                    if(!$this->hasInterpretedSubDomain($subDomain)) {
                        $this->msl_subdomains_interpreted[] = ['msl_subdomain_interpreted' => 'paleomagnetism'];
                    }
                }
                break;
                
            case "geochemistry":
                if(!$this->hasSubDomain($subDomain)) {
                    $this->msl_subdomains[] = ['msl_subdomain' => 'geochemistry'];
                }
                if($original) {
                    if(!$this->hasOriginalSubDomain($subDomain)) {
                        $this->msl_subdomains_original[] = ['msl_subdomain_original' => 'geochemistry'];
                    }
                } else {
                    if(!$this->hasInterpretedSubDomain($subDomain)) {
                        $this->msl_subdomains_interpreted[] = ['msl_subdomain_interpreted' => 'geochemistry'];
                    }
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
    
    public function hasOriginalSubDomain($subDomain) {
        foreach ($this->msl_subdomains_original as $key => $value) {
            if($value['msl_subdomain_original'] == $subDomain) {
                return true;
            }
        }
        
        return false;
    }
    
    public function hasInterpretedSubDomain($subDomain) {
        foreach ($this->msl_subdomains_interpreted as $key => $value) {
            if($value['msl_subdomain_interpreted'] == $subDomain) {
                return true;
            }
        }
        
        return false;
    }
    
    public function addOriginalKeyword($label, $uri = "", $vocabUri = "") {
        if(!$this->hasOriginalKeyword($uri)) {
            $this->msl_original_keywords[] = [
                'msl_original_keyword_label' => $label,
                'msl_original_keyword_uri' => $uri,
                'msl_original_keyword_vocab_uri' => $vocabUri
            ];
        }
    }
    
    public function addEnrichedKeyword($label, $uri = "", $vocabUri = "") {
        if(!$this->hasEnrichedKeywors($uri)) {
            $this->msl_enriched_keywords[] = [
                'msl_enriched_keyword_label' => $label,
                'msl_enriched_keyword_uri' => $uri,
                'msl_enriched_keyword_vocab_uri' => $vocabUri
            ];
        }
    }
    
    public function hasOriginalKeyword($uri) {
        foreach ($this->msl_original_keywords as $keyword) {
            if($keyword['msl_original_keyword_uri'] == $uri) {
                return true;
            }
        }
        
        return false;
    }
    
    public function hasEnrichedKeywors($uri) {
        foreach ($this->msl_enriched_keywords as $keyword) {
            if($keyword['msl_enriched_keyword_uri'] == $uri) {
                return true;
            }
        }
        
        return false;
    }
    
    public function addKeyword(Keyword $keyword, $includeOriginal = true) {
        switch (true) {
            case $keyword instanceof Material:
                if($includeOriginal) {
                    $this->msl_materials_original[] = $keyword->toArray(true);
                    $this->msl_has_material_original = true;
                }                

                $this->msl_materials[] = $keyword->toArray();
                $this->msl_has_material = true;
                break;
                
            case $keyword instanceof Porefluid:
                if($includeOriginal) {
                    $this->msl_porefluids_original[] = $keyword->toArray(true);
                    $this->msl_has_porefluid_original = true;
                }
                
                $this->msl_porefluids[] = $keyword->toArray();
                $this->msl_has_porefluid = true;
                break;
                
            case $keyword instanceof Rockphysic:
                if($includeOriginal) {
                    $this->msl_rockphysics_original[] = $keyword->toArray(true);
                    $this->msl_has_rockphysic_original = true;
                }
                
                $this->msl_rockphysics[] = $keyword->toArray();
                $this->msl_has_rockphysic = true;
                break;
            
            case $keyword instanceof Analogue:
                if($includeOriginal) {
                    $this->msl_analogue_original[] = $keyword->toArray(true);
                    $this->msl_has_analogue_original = true;
                }
                
                $this->msl_analogue[] = $keyword->toArray();
                $this->msl_has_analogue = true;
                break;
                
            case $keyword instanceof GeologicalAge:
                if($includeOriginal) {
                    $this->msl_geologicalages_original[] = $keyword->toArray(true);
                    $this->msl_has_geologicalage_original = true;
                }
                
                $this->msl_geologicalages[] = $keyword->toArray();
                $this->msl_has_geologicalage = true;
                break;
                
            case $keyword instanceof GeologicalSetting:
                if($includeOriginal) {
                    $this->msl_geologicalsettings_original[] = $keyword->toArray(true);
                    $this->msl_has_geologicalsetting_original = true;
                }
                
                $this->msl_geologicalsettings[] = $keyword->toArray();
                $this->msl_has_geologicalsetting = true;
                break;
                
            case $keyword instanceof Paleomagnetism:
                if($includeOriginal) {
                    $this->msl_paleomagnetism_original[] = $keyword->toArray(true);
                    $this->msl_has_paleomagnetism_original = true;
                }
                
                $this->msl_paleomagnetism[] = $keyword->toArray();
                $this->msl_has_paleomagnetism = true;
                break;
                
            case $keyword instanceof Geochemistry:
                if($includeOriginal) {
                    $this->msl_geochemistry_original[] = $keyword->toArray(true);
                    $this->msl_has_geochemistry_original = true;
                }
                
                $this->msl_geochemistry[] = $keyword->toArray();
                $this->msl_has_geochemistry = true;
                break;
                
            case $keyword instanceof Microscopy:
                if($includeOriginal) {
                    $this->msl_microscopy_original[] = $keyword->toArray(true);
                    $this->msl_has_microscopy_original = true;
                }
                
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

