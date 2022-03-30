<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataRepository;
use App\Models\Importer;

class ImportCsicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csic = DataRepository::create([
            'name' => 'CSIC',
            'ckan_name' => 'csic'
        ]);
        
        Importer::create([
            'name' => 'CSIC importer',
            'description' => 'imports csic data using directory listing and datacite',
            'type' => 'datacite',
            'options' => [
                'importProcessor' => [
                    'type' => 'directoryListing',
                    'options' => [
                        'directoryPath' => '/import-data/yoda/converted.json',
                        'recursive' => 'true',
                    ]                    
                ],
                'identifierProcessor' => [
                    'type' => 'fileRetrieval',
                    'options' => []
                ],
                'sourceDatasetProcessor' => [
                    'type' => 'CsicMapper',
                    'options' => []
                ]
            ],
            'data_repository_id' => $csic->id
        ]);
    }
}
