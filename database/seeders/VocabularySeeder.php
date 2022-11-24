<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaterialKeyword;
use App\Models\Vocabulary;
use App\Models\Keyword;
use App\Models\KeywordSearch;

class VocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //remove current keywords and keywordsearches
        Keyword::truncate();
        KeywordSearch::truncate();
        
        //create materials vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'materials',
                'version' => '1.0'
            ],
            [
                'name' => 'materials', 
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/materials/'
            ]
        );
                        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/materials.json'));
        $vocabData = json_decode($fileString);               
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
        
        //create porefluids vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'porefluids',
                'version' => '1.0'
            ],
            [
                'name' => 'porefluids',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/porefluids/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/porefluids.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
        
        //create rockphysics vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'rockphysics',
                'version' => '1.0'
            ],
            [
                'name' => 'rockphysics',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/rockphysics/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/rockphysics.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
        
        //create analogue modelling vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'analogue',
                'version' => '1.0'
            ],
            [
                'name' => 'analogue',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/analoguemodelling/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/analogue.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            if($topNode->value == "Modeled structure") {
                $this->processNode($topNode, $vocabulary, null, true, true);
            }
            elseif ($topNode->value == "Modeled geomorphological feature") {
                $this->processNode($topNode, $vocabulary, null, true, true);
            } else {
                $this->processNode($topNode, $vocabulary, null, true);
            }         
        }
        
        //create geological age vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'geologicalage',
                'version' => '1.0'
            ],
            [
                'name' => 'geologicalage',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/geologicalage/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/geological-age.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
        
        //create geological settting vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'geologicalsetting',
                'version' => '1.0'
            ],
            [
                'name' => 'geologicalsetting',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/geologicalsetting/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/geological-setting.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
        
        //create paleomagnetism vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'paleomagnetism',
                'version' => '1.0'
            ],
            [
                'name' => 'paleomagnetism',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/paleomagnetism/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/paleomagnetism.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
        
        //create geochemistry settting vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'geochemistry',
                'version' => '1.0'
            ],
            [
                'name' => 'geochemistry',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/geochemistry/'
            ]
        );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/geochemistry.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, false);
        }
        
        //create microscopy vocabulary
        $vocabulary = Vocabulary::updateOrCreate(
            [
                'name' => 'microscopy',
                'version' => '1.0'
            ],
            [
                'name' => 'microscopy',
                'version' => '1.0',
                'uri' => 'http://www.epos-eu.org/multi-scale-laboratories/voc/1.0/microscopy/'
            ]
            );
        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/microscopy.json'));
        $vocabData = json_decode($fileString);
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary, null, true);
        }
    }
    
    private function processNode($node, $vocabulary, $parentId = null, $excludeAbstractMapping = false, $forceExcludeAbstractMapping = false)
    {
                
        $keyword = Keyword::create([
            'parent_id' => $parentId,
            'vocabulary_id' => $vocabulary->id,
            'value' => $node->value,
            'uri' => '',
            'external_uri' => $node->uri,
            'level' => $node->level,
            'hyperlink' => $node->hyperlink
        ]);
        
        $this->generateURI($keyword, $vocabulary);
                        
        KeywordSearch::create([
            'keyword_id' => $keyword->id,
            'search_value' => strtolower($node->value),
            'isSynonym' => false,
            'exclude_abstract_mapping' => $excludeAbstractMapping
        ]);
        
        
        if(count($node->synonyms)) {
            foreach ($node->synonyms as $synonym) {
                KeywordSearch::create([
                    'keyword_id' => $keyword->id,
                    'search_value' => strtolower($synonym),
                    'isSynonym' => true,
                    'exclude_abstract_mapping' => $excludeAbstractMapping
                ]);
            }
        }        
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                if($forceExcludeAbstractMapping) {
                    $this->processNode($subNode, $vocabulary, $keyword->id, true, true);
                } else {                
                    $this->processNode($subNode, $vocabulary, $keyword->id);
                }
            }
        }
    }
    
    private function generateURI($keyword, $vocabulary) {
        $keyword->uri = $vocabulary->uri . $keyword->getFullPath();
        $keyword->save();
    }
}
