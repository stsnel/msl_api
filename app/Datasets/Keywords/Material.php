<?php
namespace App\Datasets\Keywords;

class Material extends Keyword
{
    public $msl_material_combined = '';
    
    public $msl_material_1 = '';
    
    public $msl_material_2 = '';
    
    public $msl_material_3 = '';
    
    public $msl_material_4 = '';
    
    public $msl_material_5 = '';
    
    private $levels = [
        1 => 'msl_material_1',
        2 => 'msl_material_2',
        3 => 'msl_material_3',
        4 => 'msl_material_4',
        5 => 'msl_material_5'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_material_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray($original = false) {
        if($original) {
            return [
                'msl_material_combined_original' => $this->msl_material_combined,
                'msl_material_1_original' => $this->msl_material_1,
                'msl_material_2_original' => $this->msl_material_2,
                'msl_material_3_original' => $this->msl_material_3,
                'msl_material_4_original' => $this->msl_material_4,
                'msl_material_5_original' => $this->msl_material_5
            ];
        }
        
        return [
            'msl_material_combined' => $this->msl_material_combined,
            'msl_material_1' => $this->msl_material_1,
            'msl_material_2' => $this->msl_material_2,
            'msl_material_3' => $this->msl_material_3,
            'msl_material_4' => $this->msl_material_4,
            'msl_material_5' => $this->msl_material_5
        ];
    }
}

