<?php
namespace App\Datasets\Keywords;

class Microscopy extends Keyword
{
    public $msl_microscopy_combined = '';
    
    public $msl_microscopy_1= '';
    
    public $msl_microscopy_2 = '';
    
    public $msl_microscopy_3 = '';
    
    public $msl_microscopy_4 = '';
    
    public $msl_microscopy_5 = ''; 
    
    protected $levels = [
        1 => 'msl_microscopy_1',
        2 => 'msl_microscopy_2',
        3 => 'msl_microscopy_3',
        4 => 'msl_microscopy_4',
        5 => 'msl_microscopy_5'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_microscopy_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray($original = false) {
        if($original) {
            return [
                'msl_microscopy_combined_original' => $this->msl_microscopy_combined,
                'msl_microscopy_1_original' => ($this->getTopLevel() == 'msl_microscopy_1') ? $this->msl_microscopy_1 : "",
                'msl_microscopy_2_original' => ($this->getTopLevel() == 'msl_microscopy_2') ? $this->msl_microscopy_2 : "",
                'msl_microscopy_3_original' => ($this->getTopLevel() == 'msl_microscopy_3') ? $this->msl_microscopy_3 : "",
                'msl_microscopy_4_original' => ($this->getTopLevel() == 'msl_microscopy_4') ? $this->msl_microscopy_4 : "",
                'msl_microscopy_5_original' => ($this->getTopLevel() == 'msl_microscopy_5') ? $this->msl_microscopy_5 : ""
            ];
        }
        
        return [
            'msl_microscopy_combined' => $this->msl_microscopy_combined,
            'msl_microscopy_1' => $this->msl_microscopy_1,
            'msl_microscopy_2' => $this->msl_microscopy_2,
            'msl_microscopy_3' => $this->msl_microscopy_3,
            'msl_microscopy_4' => $this->msl_microscopy_4,
            'msl_microscopy_5' => $this->msl_microscopy_5
        ];
    }
}

