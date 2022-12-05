<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Vocabulary;
use App\Exports\Vocabs\ExcelExport;

class GenerateVocabExports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vocabs:export {version}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates and stores all available vocabulary export formats on disk based on versionnumber.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $vocabularies = Vocabulary::where('version', $this->argument('version'))->get();
        $this->line($vocabularies->count() . " vocabularies found.");
        
        foreach ($vocabularies as $vocabulary) {
            $this->line("processing " . $vocabulary->name . " exports...");
            $path = 'vocabs/' . $vocabulary->name . '/' . $vocabulary->version . '/' . $vocabulary->name . '.xlsx';            
            Excel::store(new ExcelExport($vocabulary), $path, 'public');
            
            
        }        
        
        $this->line("Finished exporting vocabularies.");
        return 0;
    }
}
