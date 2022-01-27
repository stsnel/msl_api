<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DatasetCreate;
use App\Models\SourceDataset;
use App\Mappers\GfzMapper;

class ProcessSourceDataset implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $sourceDataset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SourceDataset $sourceDataset)
    {
        $this->sourceDataset = $sourceDataset;
    }
    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mapper = new GfzMapper();
        $dataset = $mapper->map($this->sourceDataset);
        
        $datasetCreate = DatasetCreate::create([
            'dataset_type' => 'rockphysics',
            'dataset' => (array)$dataset,
            'source_dataset_id' => $this->sourceDataset->id
        ]);
        
        if($datasetCreate) {
            ProcessDatasetCreate::dispatch($datasetCreate);
            
            $this->sourceDataset->status = 'succes';
            $this->sourceDataset->save();
        }
    }
}
