<?php
namespace App\Datasets\Keywords;

class Geochemistry extends Keyword
{
    public $msl_geochemistry_combined = '';
    
    public $msl_geochemistry_1 = '';
    
    public $msl_geochemistry_2 = '';
    
    public $msl_geochemistry_3 = '';
    
    public $msl_geochemistry_4 = '';

    
    private $levels = [
        1 => 'msl_geochemistry_1',
        2 => 'msl_geochemistry_2',
        3 => 'msl_geochemistry_3',
        4 => 'msl_geochemistry_4'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_geochemistry_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray($original = false) {
        if($original) {
            return [
                'msl_geochemistry_combined_original' => $this->msl_geochemistry_combined,
                'msl_geochemistry_1_original' => $this->msl_geochemistry_1,
                'msl_geochemistry_2_original' => $this->msl_geochemistry_2,
                'msl_geochemistry_3_original' => $this->msl_geochemistry_3,
                'msl_geochemistry_4_original' => $this->msl_geochemistry_4
            ];
        }
        
        return [
            'msl_geochemistry_combined' => $this->msl_geochemistry_combined,
            'msl_geochemistry_1' => $this->msl_geochemistry_1,
            'msl_geochemistry_2' => $this->msl_geochemistry_2,
            'msl_geochemistry_3' => $this->msl_geochemistry_3,
            'msl_geochemistry_4' => $this->msl_geochemistry_4
        ];
    }
}

