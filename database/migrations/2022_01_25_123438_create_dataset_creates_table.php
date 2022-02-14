<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetCreatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_creates', function (Blueprint $table) {
            $table->id();
            $table->string('dataset_type');
            $table->json('dataset');
            $table->integer('response_code')->nullable();
            $table->text('response_body')->nullable();
            $table->dateTime('processed')->nullable();
            $table->string('processed_type')->nullable();
            $table->unsignedBigInteger('source_dataset_id');
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
        Schema::dropIfExists('dataset_creates');
    }
}
