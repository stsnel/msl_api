<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataRepository;
use App\Models\Importer;

class ImportingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gfz = DataRepository::create([
            'name' => 'GFZ Potsdam',
            'ckan_name' => 'gfz-potsdam'
        ]);
        
        Importer::create([
            'name' => 'GFZ importer',
            'description' => 'import GFZ Potsdam data using OAI',
            'type' => 'OAI',
            'options' => [
                "endpoint" => "https://doidb.wdc-terra.org/oaip/oai" ,
                "metadataPrefix" => "iso19139",
                "setDefinition" => "~P3E9c3ViamVjdCUzQSUyMm11bHRpLXNjYWxlK2xhYm9yYXRvcmllcyUyMg"
            ],
            'data_repository_id' => $gfz->id
        ]);
    }
}
