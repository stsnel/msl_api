<?php
namespace App\Datasets\Keywords;

class Paleomagnetism extends Keyword
{
    public $msl_paleomagnetism_combined = '';
    
    public $msl_paleomagnetism_1 = '';
    
    public $msl_paleomagnetism_2 = '';
    
    public $msl_paleomagnetism_3 = '';
    
    public $msl_paleomagnetism_4 = '';
    
    public $msl_paleomagnetism_5 = '';
    
    protected $levels = [
        1 => 'msl_paleomagnetism_1',
        2 => 'msl_paleomagnetism_2',
        3 => 'msl_paleomagnetism_3',
        4 => 'msl_paleomagnetism_4',
        5 => 'msl_paleomagnetism_5'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_paleomagnetism_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray($original = false) {
        if($original) {
            return [
                'msl_paleomagnetism_combined_original' => $this->msl_paleomagnetism_combined,
                'msl_paleomagnetism_1_original' => ($this->getTopLevel() == 'msl_paleomagnetism_1') ? $this->msl_paleomagnetism_1 : "",
                'msl_paleomagnetism_2_original' => ($this->getTopLevel() == 'msl_paleomagnetism_2') ? $this->msl_paleomagnetism_2 : "",
                'msl_paleomagnetism_3_original' => ($this->getTopLevel() == 'msl_paleomagnetism_3') ? $this->msl_paleomagnetism_3 : "",
                'msl_paleomagnetism_4_original' => ($this->getTopLevel() == 'msl_paleomagnetism_4') ? $this->msl_paleomagnetism_4 : "",
                'msl_paleomagnetism_5_original' => ($this->getTopLevel() == 'msl_paleomagnetism_5') ? $this->msl_paleomagnetism_5 : ""
            ];
        }
        
        return [
            'msl_paleomagnetism_combined' => $this->msl_paleomagnetism_combined,
            'msl_paleomagnetism_1' => $this->msl_paleomagnetism_1,
            'msl_paleomagnetism_2' => $this->msl_paleomagnetism_2,
            'msl_paleomagnetism_3' => $this->msl_paleomagnetism_3,
            'msl_paleomagnetism_4' => $this->msl_paleomagnetism_4,
            'msl_paleomagnetism_5' => $this->msl_paleomagnetism_5
        ];
    }
}

