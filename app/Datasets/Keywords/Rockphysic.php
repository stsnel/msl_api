<?php
namespace App\Datasets\Keywords;

class Rockphysic
{
    public $msl_rockphysic_combined = '';
    
    public $msl_rockphysic_1 = '';
    
    public $msl_rockphysic_2 = '';
    
    public $msl_rockphysic_3 = '';
    
    public $msl_rockphysic_4 = ''; 

    
    private $levels = [
        1 => 'msl_rockphysic_1',
        2 => 'msl_rockphysic_2',
        3 => 'msl_rockphysic_3',
        4 => 'msl_rockphysic_4'
    ];
            
    
    public function __construct($keyword = null) {
        if($keyword) {                      
            $keywordHierarchy = $keyword->getFullHierarchy();
            
            foreach ($keywordHierarchy as $keywordInHierarchy) {
                $this->{$this->levels[$keywordInHierarchy->level]} = $keywordInHierarchy->getFullPath();
            }
            
            $this->msl_rockphysic_combined = $keyword->getFullPath();
        }
    }
    
    public function toArray() {
        return [
            'msl_rockphysic_combined' => $this->msl_rockphysic_combined,
            'msl_rockphysic_1' => $this->msl_rockphysic_1,
            'msl_rockphysic_2' => $this->msl_rockphysic_2,
            'msl_rockphysic_3' => $this->msl_rockphysic_3,
            'msl_rockphysic_4' => $this->msl_rockphysic_4
        ];
    }
}

