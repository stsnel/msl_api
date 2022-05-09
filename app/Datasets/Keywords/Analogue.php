<?php
namespace App\Datasets\Keywords;

class Analogue
{
    public $msl_analogue_combined = '';
    
    public $msl_analogue_1 = '';
    
    public $msl_analogue_2 = '';
    
    public $msl_analogue_3 = '';
    
    public $msl_analogue_4 = '';
    
    public $msl_analogue_5 = '';

    
    private $levels = [
        1 => 'msl_analogue_1',
        2 => 'msl_analogue_2',
        3 => 'msl_analogue_3',
        4 => 'msl_analogue_4',
        5 => 'msl_analogue_5'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_analogue_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray() {
        return [
            'msl_analogue_combined' => $this->msl_analogue_combined,
            'msl_analogue_1' => $this->msl_analogue_1,
            'msl_analogue_2' => $this->msl_analogue_2,
            'msl_analogue_3' => $this->msl_analogue_3,
            'msl_analogue_4' => $this->msl_analogue_4,
            'msl_analogue_5' => $this->msl_analogue_5
        ];
    }
}

