<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaterialKeyword;
use App\Models\ApparatusKeyword;
use App\Models\AncillaryEquipmentKeyword;
use App\Models\PoreFluidKeyword;
use App\Models\MeasuredPropertyKeyword;
use App\Models\InferredDeformationBehaviorKeyword;

class RockPhysicsKeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //load apparatus keywords
        $jsonString = file_get_contents(base_path('database/seeders/datafiles/rockphysics/Apparatus.json'));
        $importData = json_decode($jsonString);
        
        foreach ($importData as $topNode) {
            $this->processApparatusNode($topNode);
        }
                 
        //load ancillary equipment keywords
        $jsonString = file_get_contents(base_path('database/seeders/datafiles/rockphysics/Ancillary equipment.json'));
        $importData = json_decode($jsonString);
        
        foreach ($importData as $topNode) {
            $this->processAncillaryEquipmentNode($topNode);
        }
                
        //load pore fluid keywords
        $jsonString = file_get_contents(base_path('database/seeders/datafiles/rockphysics/Pore fluid.json'));
        $importData = json_decode($jsonString);
        
        foreach ($importData as $topNode) {
            $this->processPoreFluidNode($topNode);
        }
        
        //load measured property keywords
        $jsonString = file_get_contents(base_path('database/seeders/datafiles/rockphysics/Measured property.json'));
        $importData = json_decode($jsonString);
        
        foreach ($importData as $topNode) {
            $this->processMeasuredPropertyNode($topNode);
        }
        
        //load inferred deformation behavior keywords
        $jsonString = file_get_contents(base_path('database/seeders/datafiles/rockphysics/Inferred deformation behavior.json'));
        $importData = json_decode($jsonString);
        
        foreach ($importData as $topNode) {
            $this->processInferredDeformationBehaviorNode($topNode);
        }
        
    }
    
    private function processApparatusNode($node, $parentId = null)
    {
        $keyword = ApparatusKeyword::create([
            'parent_id' => $parentId,
            'value' => $node->value,
            'searchvalue' => strtolower($node->value)
        ]);
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processApparatusNode($subNode, $keyword->id);
            }
        }
    }
    
    private function processAncillaryEquipmentNode($node, $parentId = null)
    {
        $keyword = AncillaryEquipmentKeyword::create([
            'parent_id' => $parentId,
            'value' => $node->value,
            'searchvalue' => strtolower($node->value)
        ]);
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processAncillaryEquipmentNode($subNode, $keyword->id);
            }
        }
    }
    
    private function processPoreFluidNode($node, $parentId = null)
    {
        $keyword = PoreFluidKeyword::create([
            'parent_id' => $parentId,
            'value' => $node->value,
            'searchvalue' => strtolower($node->value)
        ]);
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processPoreFluidNode($subNode, $keyword->id);
            }
        }
    }
    
    private function processMeasuredPropertyNode($node, $parentId = null)
    {
        $keyword = MeasuredPropertyKeyword::create([
            'parent_id' => $parentId,
            'value' => $node->value,
            'searchvalue' => strtolower($node->value)
        ]);
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processMeasuredPropertyNode($subNode, $keyword->id);
            }
        }
    }
    
    private function processInferredDeformationBehaviorNode($node, $parentId = null)
    {
        $keyword = InferredDeformationBehaviorKeyword::create([
            'parent_id' => $parentId,
            'value' => $node->value,
            'searchvalue' => strtolower($node->value)
        ]);
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processInferredDeformationBehaviorNode($subNode, $keyword->id);
            }
        }
    }
}
