<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
                'uri' => 'https://epos-msl.uu.nl/voc/materials/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/porefluids/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/rockphysics/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/analoguemodelling/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/geologicalage/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/geologicalsetting/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/paleomagnetism/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/geochemistry/1.0/'
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
                'uri' => 'https://epos-msl.uu.nl/voc/microscopy/1.0/'
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
            'hyperlink' => $node->hyperlink,
            'label' => $node->value
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
        $keyword->uri = $vocabulary->uri . $this->cleanUri($keyword->getFullPath());
        $keyword->save();
    }
    
    private function cleanUri($string) {
        //lowercase
        $out = Str::lower($string);
        
        //replace '(' with ' '
        $out = Str::replace('(', ' ', $out);
        
        //trim
        $out = trim($out);
        
        //replace accents
        $out = $this->remove_accents($out);
        
        //remove extra whitespaces
        $out = preg_replace('/\s+/', ' ', $out);
        
        //replace whitespace with '_'
        $out = Str::replace(' ', '_', $out);
        
        //replace '>' with '-'
        $out = Str::replace('>', '-', $out);
        
        //remove all non alpha-numeric, ' ', '-', '_'
        $out = preg_replace("/[^A-Za-z0-9 _-]/", '', $out);
        
        //trim '_'
        $out = trim($out, '_');
        
        return $out;
    }
    
    function remove_accents($string) {
        if ( !preg_match('/[\x80-\xff]/', $string) )
            return $string;
            
            $chars = array(
                // Decompositions for Latin-1 Supplement
                chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
                chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
                chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
                chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
                chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
                chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
                chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
                chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
                chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
                chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
                chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
                chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
                chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
                chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
                chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
                chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
                chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
                chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
                chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
                chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
                chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
                chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
                chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
                chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
                chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
                chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
                chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
                chr(195).chr(191) => 'y',
                // Decompositions for Latin Extended-A
                chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
                chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
                chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
                chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
                chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
                chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
                chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
                chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
                chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
                chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
                chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
                chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
                chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
                chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
                chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
                chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
                chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
                chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
                chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
                chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
                chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
                chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
                chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
                chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
                chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
                chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
                chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
                chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
                chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
                chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
                chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
                chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
                chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
                chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
                chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
                chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
                chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
                chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
                chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
                chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
                chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
                chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
                chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
                chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
                chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
                chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
                chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
                chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
                chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
                chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
                chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
                chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
                chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
                chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
                chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
                chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
                chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
                chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
                chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
                chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
                chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
                chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
                chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
                chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
            );
            
            $string = strtr($string, $chars);
            
            return $string;
    }
}
