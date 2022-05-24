<?php

namespace App\Response;

use App\Response\Elements\CollectionPeriod;
use App\Response\Elements\Contributor;
use App\Response\Elements\CoveredPeriod;
use App\Response\Elements\Author;
use App\Response\Elements\Download;
use App\Response\Elements\Pid;
use App\Response\Elements\Reference;
use App\Response\Elements\Spatial;

class BaseResult
{
    public $title = "";
    
    public $name = "";
    
    public $portalLink = "";

    public $pid = [];

    public $license = "";

    public $version = "";

    public $source = "";

    public $publisher = "";

    public $subdomain = [];

    public $description = "";

    public $publicationDate = "";

    public $citation = "";

    public $creators = [];

    public $contributors = [];

    public $references = [];

    public $laboratories = [];

    public $materials = [];   

    public $spatial = [];

    public $locations = [];

    public $coveredPeriods = [];

    public $collectionPeriods = [];

    public $maintainer = "";

    public $downloads = [];
    
    public $researchAspects = [];
    


    public function __construct($data, $context) {        
        if(isset($data['title'])) {
            $this->title = $data['title'];
        }
        
        if(isset($data['name'])) {
            $this->name = $data['name'];
            $this->portalLink = config('ckan.ckan_root_url') . 'data-publication/' . $data['name'];
        }

        if(isset($data['msl_pids'])) {
            if(count($data['msl_pids']) > 0) {
                foreach ($data['msl_pids'] as $pidData) {
                    $this->pid[] = new Pid($pidData);
                }
            }
        }

        if(isset($data['license_id'])) {
            $this->license = $data['license_id'];
        }

        if(isset($data['msl_version'])) {
            $this->version = $data['msl_version'];
        }

        if(isset($data['msl_source'])) {
            $this->source = $data['msl_source'];
        }

        if(isset($data['owner_org'])) {
            $this->publisher = $data['owner_org'];
        }

        if(isset($data['msl_subdomains'])) {
            if(count($data['msl_subdomains']) > 0) {
                foreach ($data['msl_subdomains'] as $subDomainDataValue) {
                    $this->subdomain[] = $subDomainDataValue['msl_subdomain'];
                }
            }
        }        
        
        if(isset($data['group'])) {
            $this->subdomain = $data['group'];
        }

        if(isset($data['notes'])) {
            $this->description = $data['notes'];
        }

        if(isset($data['msl_publication_date'])) {
            $this->publicationDate = $data['msl_publication_date'];
        }

        if(isset($data['msl_citation'])) {
            $this->citation = $data['msl_citation'];
        }

        if(isset($data['msl_authors'])) {
            if(count($data['msl_authors']) > 0) {
                foreach ($data['msl_authors'] as $authorData) {
                    $this->creators[] = new Author($authorData);
                }
            }
        }

        if(isset($data['msl_contributors'])) {
            if(count($data['msl_contributors']) > 0) {
                foreach ($data['msl_contributors'] as $contributorData) {
                    $this->contributors[] = new Contributor($contributorData);
                }
            }
        }

        if(isset($data['msl_references'])) {
            if(count($data['msl_references']) > 0) {
                foreach ($data['msl_references'] as $referenceData) {
                    $this->references[] = new Reference($referenceData);
                }
            }
        }

        if(isset($data['msl_laboratories'])) {
            if(count($data['msl_laboratories']) > 0) {
                foreach ($data['msl_laboratories'] as $laboratoryData) {
                    if(isset($laboratoryData['msl_lab_name'])) {
                        $this->laboratories[] = $laboratoryData['msl_lab_name'];
                    }
                }
            }
        }

        if(isset($data['msl_materials'])) {
            if(count($data['msl_materials']) > 0) {
                foreach ($data['msl_materials'] as $materialData) {
                    if(isset($materialData['msl_material_combined'])) {
                        $this->materials[] = $this->extractEndTerm($materialData['msl_material_combined']);
                    }
                }
            }
            $this->materials = array_values(array_unique($this->materials));
        }        

        if(isset($data['msl_spatial_coordinates'])) {
            if(count($data['msl_spatial_coordinates']) > 0) {
                foreach ($data['msl_spatial_coordinates'] as $spatialData) {
                    $this->spatial[] = new Spatial($spatialData);
                }
            }
        }

        if(isset($data['msl_geolocations'])) {
            if(count($data['msl_geolocations']) > 0) {
                foreach ($data['msl_geolocations'] as $geoLocationData) {
                    if(isset($geoLocationData['msl_geolocation_place'])) {
                        $this->locations[] = $geoLocationData['msl_geolocation_place'];
                    }
                }
            }
        }

        if(isset($data['msl_covered_period'])) {
            if(count($data['msl_covered_period']) > 0) {
                foreach ($data['msl_covered_period'] as $coveredPeriodData) {
                    $this->coveredPeriods[] = new CoveredPeriod($coveredPeriodData);
                }
            }
        }

        if(isset($data['msl_collection_period'])) {
            if(count($data['msl_collection_period']) > 0) {
                foreach ($data['msl_collection_period'] as $collectionPeriodData) {
                    $this->collectionPeriods[] = new CollectionPeriod($collectionPeriodData);
                }
            }
        }

        if(isset($data['maintainer'])) {
            $this->maintainer = $data['maintainer'];
        }

        if(isset($data['msl_downloads'])) {
            if(count($data['msl_downloads']) > 0) {
                foreach ($data['msl_downloads'] as $downloadData) {
                    $this->downloads[] = new Download($downloadData);
                }
            }
        }
        
        //set researchaspects based on context(calling api function)
        switch ($context) {
            case 'rockPhysics':
                $this->researchAspects = $this->getRockPhysicsKeywords($data);              
                break;            
            case 'analogue':
                $this->researchAspects = $this->getAnalogueKeywords($data);
                break;
            case 'paleo':
                
                break;
            case 'microscopy':
                
                break;
            case 'geochemistry':
                
                break;
            case 'all':
                $keywords = [];
                
                $keywords = array_merge($keywords, $this->getRockPhysicsKeywords($data));
                $keywords = array_merge($keywords, $this->getAnalogueKeywords($data));
                $keywords = array_values(array_unique($keywords));
                
                $this->researchAspects = $keywords;                                
                break;
        }        

    }
    
    private function getRockPhysicsKeywords($data) {        
        $topNodes = ['Measured property', 'Inferred deformation behavior'];
        $keywords = [];                
        
        if(isset($data['msl_rockphysics'])) {
            if(count($data['msl_rockphysics']) > 0) {                
                foreach ($data['msl_rockphysics'] as $keywordData) {                        
                    if(isset($keywordData['msl_rockphysic_combined'])) {
                        $term = $keywordData['msl_rockphysic_combined'];
                        
                        if(str_contains($term, '>')) {
                            $terms = explode('>', $term);
                            if(in_array($terms[0], $topNodes)) {
                                $keywords[] = trim($terms[count($terms) - 1]);
                            }                            
                        }                        
                    }
                }
            }
            $keywords = array_values(array_unique($keywords));
        }
        
        return $keywords;
    }
    
    private function getAnalogueKeywords($data) {
        $topNodes = ['Modeled structure', 'Modeled geomorphological feature', 'Measured property'];
        $keywords = [];
        
        if(isset($data['msl_analogue'])) {
            if(count($data['msl_analogue']) > 0) {                
                foreach ($data['msl_analogue'] as $keywordData) {
                    if(isset($keywordData['msl_analogue_combined'])) {
                        $term = $keywordData['msl_analogue_combined'];
                        
                        if(str_contains($term, '>')) {
                            $terms = explode('>', $term);
                            if(in_array($terms[0], $topNodes)) {
                                $keywords[] = trim($terms[count($terms) - 1]);
                            }
                        }
                    }
                }
            }
            $keywords = array_values(array_unique($keywords));
        }
        
        return $keywords;
    }
    
    
    private function extractEndTerm($term) {
        if(str_contains($term, '>')) {
            $terms = explode('>', $term);
            return trim($terms[count($terms) - 1]);
        }
        return $term;
    }
}
