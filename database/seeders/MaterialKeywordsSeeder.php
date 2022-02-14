<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaterialKeyword;

class MaterialKeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //load json containing keyword structure
        $jsonString = file_get_contents(base_path('database/seeders/datafiles/materials.json'));
        $importData = json_decode($jsonString);
        
        //loop over top nodes and add sub-nodes
        foreach ($importData as $topNode) {
            $this->processNode($topNode);
        }
                        
    }
    
    private function processNode($node, $parentId = null)
    {
        $keyword = MaterialKeyword::create([
            'parent_id' => $parentId,
            'value' => $node->value,
            'searchvalue' => strtolower($node->value)
        ]);
        
        if(count($node->subTerms)) {
            foreach ($node->subTerms as $subNode) {
                $this->processNode($subNode, $keyword->id);
            }
        }
    }
}
