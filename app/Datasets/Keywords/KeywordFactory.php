<?php
namespace App\Datasets\Keywords;

class KeywordFactory
{
    
    public static function create($keyword) 
    {
        switch ($keyword->vocabulary->name) {
            case 'materials':                
                return new Material($keyword);
                
            case 'porefluids':
                return new Porefluid($keyword);
                
            case 'rockphysics':
                return new Rockphysic($keyword);
                
            case 'analogue':
                return new Analogue($keyword);
                
            case 'geologicalage':
                return new GeologicalAge($keyword);
                
            case 'geologicalsetting':
                return new GeologicalSetting($keyword);
                
            default:
                throw new \Exception('invalid vocabularyname');
        }
    }
}
