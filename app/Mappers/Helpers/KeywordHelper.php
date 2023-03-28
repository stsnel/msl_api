<?php
namespace App\Mappers\Helpers;

use App\Models\KeywordSearch;
use App\Datasets\Keywords\KeywordFactory;
use App\Datasets\BaseDataset;

class KeywordHelper
{
    private $vocabularyMapping = [
        'materials' => 'msl_materials',
        'porefluids' => 'msl_porefluids',
        'rockphysics' => 'msl_rockphysics',
        'analogue' => 'msl_analogue',
        'geologicalage' => 'msl_geologicalages',
        'geologicalsetting' => 'msl_geologicalsettings',
        'paleomagnetism' => 'msl_paleomagnetism',
        'geochemistry' => 'msl_geochemistry',
        'microscopy' => 'msl_microscopy'
    ];
    
    private $vocabularySubDomainMapping = [
        'rockphysics' => 'rock and melt physics',
        'analogue' => 'analogue modelling of geologic processes',
        'paleomagnetism' => 'paleomagnetism',
        'geochemistry' => 'geochemistry',
        'microscopy' => 'microscopy and tomography'
    ];       
    
    
    
    public function mapKeywords(BaseDataset $dataset, $keywords, $extractLastTerm = false, $lastTermDelimiter = '>')
    {                
        foreach ($keywords as $keyword) {
            if($extractLastTerm) {
                if(str_contains($keyword, $lastTermDelimiter)) {
                    $splitKeywords = explode($lastTermDelimiter, $keyword);
                    $keyword = end($splitKeywords);
                }
            }
            
            $keyword = trim($keyword);            
            $dataset->tag_string[] = $this->cleanKeyword($keyword);
            
            $searchKeywords = KeywordSearch::where('search_value', strtolower($keyword))->where('version', '1.1')->get();
            
            if(count($searchKeywords) > 0) {
                foreach ($searchKeywords as $searchKeyword) {
                    $keyword = $searchKeyword->keyword;                                                            
                    $datasetKeyword = KeywordFactory::create($keyword);
                    
                    $dataset->addKeyword($datasetKeyword);
                    
                    //add subdomain to dataset if keyword is from specified vocabulary and not excluded
                    if(!$keyword->exclude_domain_mapping) {
                        if(isset($this->vocabularySubDomainMapping[$keyword->vocabulary->name])) {
                            $dataset->addSubDomain($this->vocabularySubDomainMapping[$keyword->vocabulary->name], false);
                        }
                    }
                }
            }            
            
        }
                        
        return $dataset;
    }
    
    public function mapKeywordsFromText(BaseDataset $dataset, $text) 
    {
        $searchKeywords = KeywordSearch::where('exclude_abstract_mapping', false)->where('version', '1.1')->get();
        
        foreach ($searchKeywords as $searchKeyword) {
            if($searchKeyword->search_value !== '') {
                $expr = '/\b' . preg_quote($searchKeyword->search_value, '/') . '\b/i';
                if (preg_match($expr, $text)) {
                    $keyword = $searchKeyword->keyword;
                    
                    $datasetKeyword = KeywordFactory::create($keyword);                    
                    $dataset->addKeyword($datasetKeyword, false);
                    
                    //add subdomain to dataset if keyword is from specified vocabulary and not excluded
                    if(!$keyword->exclude_domain_mapping) {
                        if(isset($this->vocabularySubDomainMapping[$keyword->vocabulary->name])) {
                            $dataset->addSubDomain($this->vocabularySubDomainMapping[$keyword->vocabulary->name], false);
                        }
                    }
                }
            }
        }
        
        return $dataset;
    }
    
    public function extractFromText($text)
    {
        $searchKeywords = KeywordSearch::where('exclude_abstract_mapping', false)->where('version', '1.1')->get();
        $matchedKeywords = [];
        
        foreach ($searchKeywords as $searchKeyword) {
            if($searchKeyword->search_value !== '') {
                $expr = '/\b' . preg_quote($searchKeyword->search_value, '/') . '\b/i';
                if (preg_match($expr, $text)) {
                    $matchedKeywords[] = $searchKeyword->keyword;
                }
            }
        }
                
        return $matchedKeywords;
    }
    
    private function cleanKeyword($string)
    {
        $keyword = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
        if(strlen($keyword) >= 100) {
            $keyword = substr($keyword, 0, 95);
            $keyword = $keyword . "...";
        }
        
        return trim($keyword);
    }
    
    
}
