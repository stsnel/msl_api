<?php
namespace App\Exports;

use App\Models\Keyword;

class FilterTreeExport
{
    
    
    public function export() {
        $tree = [[
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
            'children' => []
        ]];
                
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

