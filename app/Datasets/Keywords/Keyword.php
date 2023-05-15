<?php
namespace app\Datasets\Keywords;

class Keyword
{
    
    protected function getTopLevel()
    {
        $levels = $this->levels;
        krsort($levels);        
        foreach ($levels as $levelKey => $levelValue) {
            if($this->$levelValue !== "") {
                return $levelValue;
            }            
        }
        
        throw new \Exception('keyword has no top level');
    }
}

