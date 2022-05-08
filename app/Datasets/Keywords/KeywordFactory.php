<?php
namespace App\Datasets\Keywords;

class KeywordFactory
{
    
    public static function create($keyword) 
    {
        switch ($keyword->vocabulary->name) {
            case 'materials':                
                return new Material($keyword);
                
            default:
                throw new \Exception('invalid vocabularyname');
        }
    }
}

