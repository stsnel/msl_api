<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Laboratory;
use App\fast\Fast;
use App\Models\LaboratoryUpdateFast;


class ProcessLaboratoryUpdateFast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $laboratoryUpdateFast;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(LaboratoryUpdateFast $laboratoryUpdateFast)
    {
        $this->laboratoryUpdateFast = $laboratoryUpdateFast;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        $lab = $this->laboratoryUpdateFast->laboratory;
        
        $fast = new Fast();        
        $result = $fast->facilityRequest($lab->fast_id);
        
        if($result->response_code == 200) {
            $data = $result->response_body['data'];
                        
            $lab->name = $data['name'];
            $lab->description = $data['description'];
            if(isset($data['description_html'])) {
                $lab->description_html = $data['description_html'];
            }
            
            $lab->save();
            
            $this->laboratoryUpdateFast->response_code = $result->response_code;
            $this->laboratoryUpdateFast->source_laboratory_data = $data;
            $this->laboratoryUpdateFast->save();
        } else {
            $this->laboratoryUpdateFast->response_code = $result->response_code;
            $this->laboratoryUpdateFast->save();
        }
        

    }    
}
