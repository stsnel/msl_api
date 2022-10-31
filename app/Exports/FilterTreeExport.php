<?php
namespace App\Exports;

use App\Models\Keyword;

class FilterTreeExport
{
    
    
    public function export() {
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(1, 'msl_material_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(5, 'msl_geologicalage_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(2, 'msl_porefluid_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(6, 'msl_geologicalsetting_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(4, 'msl_analogue_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(8, 'msl_geochemistry_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(9, 'msl_microscopy_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(7, 'msl_paleomagnetism_')
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
                    'type' => 'node',
                    'url' => '',
                    'filterName' => '',
                    'filterValue' => ''
                ],
                'children' => $this->getVocabAsFilters(3, 'msl_rockphysic_')
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
                    'type' => 'facet',
                    'url' => '',
                    'filterName' => 'msl_lab_name',
                    'filterValue' => ''
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
                    'type' => 'facet',
                    'url' => '',
                    'filterName' => 'organization',
                    'filterValue' => ''
                ],
                'children' => []
            ],
        ];
                
        return (json_encode($tree, JSON_PRETTY_PRINT));
    }
    
    
    private function getVocabAsFilters($vocabId, $filterPrefix = "") {
        $topNodes = Keyword::where(['vocabulary_id' => $vocabId, 'level' => 1])->get();
        $vocabFilters = [];
        
        foreach ($topNodes as $node) {
            $filter = [
                'id' => $filterPrefix . $node->id,
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
                    'filterName' => $filterPrefix . $node->level,
                    'filterValue' => $node->getFullPath()
                ],
                'children' => $this->getChildren($node, $filterPrefix)                
            ];
            
            $vocabFilters[] = $filter;
        }
        
        return $vocabFilters;        
    }
    
    private function getChildren($keyword, $filterPrefix = "")
    {
        $children = $keyword->getChildren();
        $childFilters = [];
        
        foreach ($children as $child) {
            $filter = [
                'id' => $filterPrefix . $child->id,
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
                    'filterName' => $filterPrefix . $child->level,
                    'filterValue' => $child->getFullPath()
                ],
                'children' => $this->getChildren($child, $filterPrefix)
            ];
            
            $childFilters[] = $filter;
        }
        
        return $childFilters;
    }
}

