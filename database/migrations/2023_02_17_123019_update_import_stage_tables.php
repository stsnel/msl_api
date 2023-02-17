<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateImportStageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add import id columns to source_datasets and dataset_creates tables
        Schema::table('source_datasets', function (Blueprint $table) {
            $table->unsignedBigInteger('import_id')->after('source_dataset_identifier_id');
        });
        
        
        Schema::table('dataset_creates', function (Blueprint $table) {
            $table->unsignedBigInteger('import_id')->after('source_dataset_id');
        });
        
        // Update newly created columns to contain correct references to imports
        DB::statement('UPDATE epos_msl.source_datasets AS U1, epos_msl.source_dataset_identifiers AS U2 
            SET U1.import_id = U2.import_id
            WHERE U2.id = U1.source_dataset_identifier_id;');
        
        DB::statement('UPDATE epos_msl.dataset_creates AS U1, epos_msl.source_datasets AS U2 
            SET U1.import_id = U2.import_id
            WHERE U2.id = U1.source_dataset_id;');
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('source_datasets', function (Blueprint $table) {
            $table->dropColumn('import_id');
        });
        
        Schema::table('dataset_creates', function (Blueprint $table) {
            $table->dropColumn('import_id');
        });
    }
}
