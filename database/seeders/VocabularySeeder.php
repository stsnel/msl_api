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
                'name' => 'materials'
                
            ],
            [
                'name' => 'materials', 
                'uri' => 'https://www.epos-eu.org/multi-scale-laboratories/voc/materials/'                
            ]
        );
                        
        //load jsonData from file
        $fileString = file_get_contents(base_path('database/seeders/datafiles/vocabularies/materials.json'));
        $vocabData = json_decode($fileString);               
        
        //loop over top nodes and add sub-nodes
        foreach ($vocabData as $topNode) {
            $this->processNode($topNode, $vocabulary);
        }
                                       
    }
    
    private function processNode($node, $vocabulary, $parentId = null)
    {
                
        $keyword = Keyword::create([
            'parent_id' => $parentId,
            'vocabulary_id' => $vocabulary->id,
            'value' => $node->value,
            'uri' => $node->uri,
            'level' => $node->level,
            'hyperlink' => $node->hyperlink
        ]);
        
        $this->generateURI($keyword, $vocabulary);
                        
        KeywordSearch::create([
            'keyword_id' => $keyword->id,
            'search_value' => strtolower($node->value),
            'isSynonym' => false
        ]);
        
        if(count($node->synonyms)) {
            foreach ($node->synonyms as $synonym) {
                KeywordSearch::create([
                    'keyword_id' => $keyword->id,
                    'search_value' => strtolower($synonym),
                    'isSynonym' => true
                ]);
            }
        }        
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processNode($subNode, $vocabulary, $keyword->id);
            }
        }
    }
    
    private function generateURI($keyword, $vocabulary) {
        if($keyword->uri == "") {
            $keyword->uri = $vocabulary->name . '>' . $keyword->getFullPath();
            $keyword->save();
        }        
    }
}
