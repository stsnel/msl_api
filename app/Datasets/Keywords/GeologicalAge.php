<?php
namespace App\Datasets\Keywords;

class GeologicalAge extends Keyword
{
    public $msl_geologicalage_combined = '';
    
    public $msl_geologicalage_1 = '';
    
    public $msl_geologicalage_2 = '';
    
    public $msl_geologicalage_3 = '';
    
    public $msl_geologicalage_4 = '';
    
    public $msl_geologicalage_5 = '';
    
    public $msl_geologicalage_6 = '';
    
    protected $levels = [
        1 => 'msl_geologicalage_1',
        2 => 'msl_geologicalage_2',
        3 => 'msl_geologicalage_3',
        4 => 'msl_geologicalage_4',
        5 => 'msl_geologicalage_5',
        6 => 'msl_geologicalage_6'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_geologicalage_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray($original = false) {
        if($original) {
            return [
                'msl_geologicalage_combined_original' => $this->msl_geologicalage_combined,
                'msl_geologicalage_1_original' => ($this->getTopLevel() == 'msl_geologicalage_1') ? $this->msl_geologicalage_1 : "",
                'msl_geologicalage_2_original' => ($this->getTopLevel() == 'msl_geologicalage_2') ? $this->msl_geologicalage_2 : "",
                'msl_geologicalage_3_original' => ($this->getTopLevel() == 'msl_geologicalage_3') ? $this->msl_geologicalage_3 : "",
                'msl_geologicalage_4_original' => ($this->getTopLevel() == 'msl_geologicalage_4') ? $this->msl_geologicalage_4 : "",
                'msl_geologicalage_5_original' => ($this->getTopLevel() == 'msl_geologicalage_5') ? $this->msl_geologicalage_5 : "",
                'msl_geologicalage_6_original' => ($this->getTopLevel() == 'msl_geologicalage_6') ? $this->msl_geologicalage_6 : ""
            ];
        }
        
        return [
            'msl_geologicalage_combined' => $this->msl_geologicalage_combined,
            'msl_geologicalage_1' => $this->msl_geologicalage_1,
            'msl_geologicalage_2' => $this->msl_geologicalage_2,
            'msl_geologicalage_3' => $this->msl_geologicalage_3,
            'msl_geologicalage_4' => $this->msl_geologicalage_4,
            'msl_geologicalage_5' => $this->msl_geologicalage_5,
            'msl_geologicalage_6' => $this->msl_geologicalage_6
        ];
    }
}

