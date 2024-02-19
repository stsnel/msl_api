<?php

namespace Database\Seeders;

use App\Models\Seeder;
use Illuminate\Database\Seeder as dbSeeder;

class SeederSeeder extends dbSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //organization seeder        
        Seeder::updateOrCreate(
            [
                'name' => 'Organization seeder'
            ],
            [
                'name' => 'Organization seeder',
                'description' => 'create/update organizations in ckan',
                'type' => 'organization',
                'options' => [
                    'type' => 'fileSeeder',
                    'filePath' => '/seed-data/organizations.json'
                ]
            ]
        );
        
        //laboratory seeder
        Seeder::updateOrCreate(
            [
                'name' => 'Laboratory seeder'
            ],
            [
                'name' => 'Laboratory seeder',
                'description' => 'create/update laboratories in ckan',
                'type' => 'lab',
                'options' => [
                    'type' => 'fileSeeder',
                    'filePath' => '/seed-data/labs.json'
                ]
            ]
            );
        
    }
       
}
