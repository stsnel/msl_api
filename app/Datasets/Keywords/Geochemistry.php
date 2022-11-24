<?php
namespace App\Datasets\Keywords;

class Geochemistry
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
    
    public function toArray() {
        return [
            'msl_geochemistry_combined' => $this->msl_geochemistry_combined,
            'msl_geochemistry_1' => $this->msl_geochemistry_1,
            'msl_geochemistry_2' => $this->msl_geochemistry_2,
            'msl_geochemistry_3' => $this->msl_geochemistry_3,
            'msl_geochemistry_4' => $this->msl_geochemistry_4
        ];
    }
}

