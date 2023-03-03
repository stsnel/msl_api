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
                'children' => $this->getVocabAsFilters(1, 'msl_material_', true)
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
                'children' => $this->getVocabAsFilters(5, 'msl_geologicalage_', false, false)
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
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geologicalsetting',
                    'filterValue' => 'true'
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
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_analogue',
                    'filterValue' => 'true'
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
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_geochemistry',
                    'filterValue' => 'true'
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
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_microscopy',
                    'filterValue' => 'true'
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
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_paleomagnetism',
                    'filterValue' => 'true'
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
                    'type' => 'filter',
                    'url' => '',
                    'filterName' => 'msl_has_rockphysic',
                    'filterValue' => 'true'
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
                'children' => $this->getVocabAsFilters(1, 'msl_material_', true, true, '_original')
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
                'children' => $this->getVocabAsFilters(5, 'msl_geologicalage_', false, false, '_original')
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
                'children' => $this->getVocabAsFilters(2, 'msl_porefluid_', false, true, '_original')
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
                'children' => $this->getVocabAsFilters(6, 'msl_geologicalsetting_', false, true, '_original')
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
                'children' => $this->getVocabAsFilters(4, 'msl_analogue_', false, true, '_original')
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
                'children' => $this->getVocabAsFilters(8, 'msl_geochemistry_', false, true, '_original')
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
                'children' => $this->getVocabAsFilters(9, 'msl_microscopy_', false, true, '_original')
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
                'children' => $this->getVocabAsFilters(7, 'msl_paleomagnetism_', false, true, '_original')
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
                'children' => $this->getVocabAsFilters(3, 'msl_rockphysic_', false, true, '_original')
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
                    'filterName' => $filterPrefix . $node->level . $filterSuffix,
                    'filterValue' => $node->getFullPath()
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
                    'filterName' => $filterPrefix . $child->level . $filterSuffix,
                    'filterValue' => $child->getFullPath()
                ],
                'children' => $this->getChildren($child, $filterPrefix, $sort, $filterSuffix)
            ];
            
            $childFilters[] = $filter;
        }
        
        return $childFilters;
    }
}

