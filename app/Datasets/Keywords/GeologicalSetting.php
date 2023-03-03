<?php
namespace App\Datasets\Keywords;

class GeologicalSetting extends Keyword
{
    public $msl_geologicalsetting_combined = '';
    
    public $msl_geologicalsetting_1 = '';
    
    public $msl_geologicalsetting_2 = '';
    
    public $msl_geologicalsetting_3 = '';
    
    public $msl_geologicalsetting_4 = '';
    
    
    private $levels = [
        1 => 'msl_geologicalsetting_1',
        2 => 'msl_geologicalsetting_2',
        3 => 'msl_geologicalsetting_3',
        4 => 'msl_geologicalsetting_4'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_geologicalsetting_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray($original = false) {
        if($original) {
            return [
                'msl_geologicalsetting_combined_original' => $this->msl_geologicalsetting_combined,
                'msl_geologicalsetting_1_original' => $this->msl_geologicalsetting_1,
                'msl_geologicalsetting_2_original' => $this->msl_geologicalsetting_2,
                'msl_geologicalsetting_3_original' => $this->msl_geologicalsetting_3,
                'msl_geologicalsetting_4_original' => $this->msl_geologicalsetting_4
            ];
        }
        
        return [
            'msl_geologicalsetting_combined' => $this->msl_geologicalsetting_combined,
            'msl_geologicalsetting_1' => $this->msl_geologicalsetting_1,
            'msl_geologicalsetting_2' => $this->msl_geologicalsetting_2,
            'msl_geologicalsetting_3' => $this->msl_geologicalsetting_3,
            'msl_geologicalsetting_4' => $this->msl_geologicalsetting_4
        ];
    }
}

