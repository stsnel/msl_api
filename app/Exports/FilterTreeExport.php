<?php
namespace App\Exports;

use App\Models\Keyword;

class FilterTreeExport
{
    
    
    public function exportInterpreted() {
        $tree = [
            [
                'text' => 'Material',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],            
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_material',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(28, 'msl_enriched_keyword_uri', true)
            ],
            [
                'text' => 'Geological age',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geologicalage',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(32, 'msl_enriched_keyword_uri', false, false)
            ],
            [
                'text' => 'Pore fluid',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_porefluid',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(29, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Geological setting',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geologicalsetting',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(33, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Analogue modelling of geological processes',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_analogue',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(31, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Geochemistry',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geochemistry',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(35, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Microscopy and tomography',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_microscopy',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(36, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Paleomagnetism',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_paleomagnetism',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(34, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Rock and melt physics',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_rockphysic',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(30, 'msl_enriched_keyword_uri')
            ],
            [
                'text' => 'Research Institute',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_lab',
                    'filterValue' => 'true',
                    'includeFacet' => true,
                    'facetName' => 'msl_lab_name'
                ],
                'children' => []
            ],
            [
                'text' => 'Data repository',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_organization',
                    'filterValue' => 'true',
                    'includeFacet' => true,
                    'facetName' => 'organization'
                ],
                'children' => []
            ],
        ];
                
        return (json_encode($tree, JSON_PRETTY_PRINT));
    }
    
    public function exportOriginal() {
        $tree = [
            [
                'text' => 'Material',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_material_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(28, 'msl_original_keyword_uri', true, true)
            ],
            [
                'text' => 'Geological age',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geologicalage_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(32, 'msl_original_keyword_uri', false, false)
            ],
            [
                'text' => 'Pore fluid',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_porefluid_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(29, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Geological setting',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geologicalsetting_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(33, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Analogue modelling of geological processes',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_analogue_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(31, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Geochemistry',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geochemistry_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(35, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Microscopy and tomography',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_microscopy_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(36, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Paleomagnetism',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_paleomagnetism_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(34, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Rock and melt physics',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_rockphysic_original',
                    'filterValue' => 'true'
                ],
                'children' => $this->getVocabAsFilters(30, 'msl_original_keyword_uri', false, true)
            ],
            [
                'text' => 'Research Institute',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_lab',
                    'filterValue' => 'true',
                    'includeFacet' => true,
                    'facetName' => 'msl_lab_name'
                ],
                'children' => []
            ],
            [
                'text' => 'Data repository',
                'state' => [
                    'opened' => false,
                    'disabled' => false,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_organization',
                    'filterValue' => 'true',
                    'includeFacet' => true,
                    'facetName' => 'organization'
                ],
                'children' => []
            ],
        ];
        
        return (json_encode($tree, JSON_PRETTY_PRINT));
    }
    
    
    private function getVocabAsFilters($vocabId, $filterPrefix = "", $sortToplevel = false, $sortChildren = true, $filterSuffix = "") {
        if($sortToplevel) {
            $topNodes = Keyword::where(['vocabulary_id' => $vocabId, 'level' => 1])->orderBy('value', 'asc')->get();
        } else {
            $topNodes = Keyword::where(['vocabulary_id' => $vocabId, 'level' => 1])->get();
        }        
        $vocabFilters = [];
        
        foreach ($topNodes as $node) {
            $filter = [
                'id' => $filterPrefix . $node->id . $filterSuffix,
                'text' => $node->value,
                'state' => [
                    'opened' => false,
                    'disabled' => true,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => $filterPrefix,
                    'filterValue' => $node->uri
                ],
                'children' => $this->getChildren($node, $filterPrefix, $sortChildren, $filterSuffix)                
            ];
            
            $vocabFilters[] = $filter;
        }
        
        return $vocabFilters;        
    }
    
    private function getChildren($keyword, $filterPrefix = "", $sort = true, $filterSuffix = "")
    {
        $children = $keyword->getChildren($sort);
        $childFilters = [];
        
        foreach ($children as $child) {
            $filter = [
                'id' => $filterPrefix . $child->id . $filterSuffix,
                'text' => $child->value,
                'state' => [
                    'opened' => false,
                    'disabled' => true,
                    'selected' => false,
                    'checked' => false
                ],
                'extra' => [
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => $filterPrefix,
                    'filterValue' => $child->uri
                ],
                'children' => $this->getChildren($child, $filterPrefix, $sort, $filterSuffix)
            ];
            
            $childFilters[] = $filter;
        }
        
        return $childFilters;
    }
}

