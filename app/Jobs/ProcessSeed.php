<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Seed;
use App\Models\OrganizationCreate;
use App\Models\LaboratoryCreate;


class ProcessSeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $seed;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Seed $seed)
    {
        $this->seed = $seed;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $seeder = $this->seed->seeder;
        
        if($seeder->type == "organization") {
            if($seeder->options['type'] == 'fileSeeder') {
                $filePath = $seeder->options['filePath'];
                
                if(Storage::disk()->exists($filePath)) {
                    $jsonEntries = json_decode(Storage::get($filePath), true);
                    
                    foreach ($jsonEntries as $jsonEntry) {
                        $organizationCreate = OrganizationCreate::create([
                            'organization_type' => 'organization',
                            'organization' => $jsonEntry,
                            'seed_id' => $this->seed->id
                        ]);
                        
                        ProcessOrganizationCreate::dispatch($organizationCreate);
                    }
                }
            }
        } elseif ($seeder->type == "lab") {
            if($seeder->options['type'] == 'fileSeeder') {
                $filePath = $seeder->options['filePath'];
                
                if(Storage::disk()->exists($filePath)) {
                    $jsonEntries = json_decode(Storage::get($filePath), true);
                    
                    foreach ($jsonEntries as $jsonEntry) {
                        $LaboratoryCreate = LaboratoryCreate::create([
                            'laboratory_type' => 'organization',
                            'laboratory' => $jsonEntry,
                            'seed_id' => $this->seed->id
                        ]);
                        
                        ProcessLaboratoryCreate::dispatch($LaboratoryCreate);
                    }
                }
            }
        } else {
            throw new \Exception('Invalid Seeder configuration.');
        }

    }    
}
