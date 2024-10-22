<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Laboratory;
use App\Models\LaboratoryUpdateGroupFast;
use App\Models\LaboratoryUpdateFast;
use App\Models\LaboratoryOrganization;
use App\Models\LaboratoryContactPerson;
use App\Models\LaboratoryManager;
use App\Models\LaboratoryEquipment;
use App\Models\LaboratoryKeyword;


class ProcessLaboratoryUpdateGroupFast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $laboratoryUpdateGroupFast;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LaboratoryUpdateGroupFast $laboratoryUpdateGroupFast)
    {
        $this->laboratoryUpdateGroupFast = $laboratoryUpdateGroupFast;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        LaboratoryOrganization::truncate();
        LaboratoryContactPerson::truncate();
        LaboratoryManager::truncate();
        LaboratoryEquipment::truncate();        

        $labs = Laboratory::whereNotNull('fast_id')->get();
        
        foreach ($labs as $lab) {            
            $laboratoryUpdateFast = LaboratoryUpdateFast::create([
                'laboratory_update_group_fast_id' => $this->laboratoryUpdateGroupFast->id,
                'laboratory_id' => $lab->id
            ]);
            
            ProcessLaboratoryUpdateFast::dispatch($laboratoryUpdateFast);
        }
                
    }    
}
