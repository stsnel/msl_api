<?php

namespace App\Response;


class RockPhysicsResult extends BaseResult
{    
    public $measuredProperties = [];

    public $apparatus = [];

    public $ancillaryEquipment = [];

    public $poreFluids = [];

    public $inferredDeformationBehaviour = [];



    public function __construct($data) {
        parent::__construct($data);
        
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
