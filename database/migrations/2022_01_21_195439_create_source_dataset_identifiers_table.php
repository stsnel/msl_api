<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourceDatasetIdentifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_dataset_identifiers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_id');
            $table->integer('response_code')->nullable();
            $table->string('identifier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('source_dataset_identifiers');
    }
}
