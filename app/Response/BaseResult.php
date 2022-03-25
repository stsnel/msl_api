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

    public $subdomain = "";

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
    
    
    public $measuredProperties = [];
    
    public $apparatus = [];
    
    public $ancillaryEquipment = [];
    
    public $poreFluids = [];
    
    public $inferredDeformationBehaviour = [];


    public function __construct($data) {
        if(isset($data['title'])) {
            $this->title = $data['title'];
        }
        
        if(isset($data['name'])) {
            $this->name = $data['name'];
            $this->portalLink = config('ckan.ckan_root_url') . 'rockphysics/' . $data['name'];
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
                    if(isset($materialData['msl_material'])) {
                        $this->materials[] = $materialData['msl_material'];
                    }
                }
            }
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
        
        
        if(isset($data['msl_rock_measured_properties'])) {
            if(count($data['msl_rock_measured_properties']) > 0) {
                foreach ($data['msl_rock_measured_properties'] as $measuredPropertyData) {
                    if(isset($measuredPropertyData['msl_rock_measured_property'])) {
                        $this->measuredProperties[] = $measuredPropertyData['msl_rock_measured_property'];
                    }
                }
            }
        }
        
        if(isset($data['msl_rock_apparatusses'])) {
            if(count($data['msl_rock_apparatusses']) > 0) {
                foreach ($data['msl_rock_apparatusses'] as $apparatusData) {
                    if(isset($apparatusData['msl_rock_apparatus'])) {
                        $this->apparatus[] = $apparatusData['msl_rock_apparatus'];
                    }
                }
            }
        }
        
        if(isset($data['msl_rock_ancillary_equipments'])) {
            if(count($data['msl_rock_ancillary_equipments']) > 0) {
                foreach ($data['msl_rock_ancillary_equipments'] as $ancillaryEquipmentData) {
                    if(isset($ancillaryEquipmentData['msl_rock_ancillary_equipment'])) {
                        $this->ancillaryEquipment[] = $ancillaryEquipmentData['msl_rock_ancillary_equipment'];
                    }
                }
            }
        }
        
        if(isset($data['msl_rock_pore_fluids'])) {
            if(count($data['msl_rock_pore_fluids']) > 0) {
                foreach ($data['msl_rock_pore_fluids'] as $poreFluidData) {
                    if(isset($poreFluidData['msl_rock_pore_fluid'])) {
                        $this->poreFluids[] = $poreFluidData['msl_rock_pore_fluid'];
                    }
                }
            }
        }
        
        if(isset($data['msl_rock_inferred_deformation_behaviors'])) {
            if(count($data['msl_rock_inferred_deformation_behaviors']) > 0) {
                foreach ($data['msl_rock_inferred_deformation_behaviors'] as $inferredDeformationBehaviorData) {
                    if(isset($inferredDeformationBehaviorData['msl_rock_inferred_deformation_behavior'])) {
                        $this->inferredDeformationBehaviour[] = $inferredDeformationBehaviorData['msl_rock_inferred_deformation_behavior'];
                    }
                }
            }
        }
    }
}
