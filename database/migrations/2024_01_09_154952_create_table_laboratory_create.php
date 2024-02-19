<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLaboratoryCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_creates', function (Blueprint $table) {
            $table->id();
            $table->string('laboratory_type');
            $table->json('laboratory');
            $table->integer('response_code')->nullable();
            $table->text('response_body')->nullable();
            $table->dateTime('processed')->nullable();
            $table->string('processed_type')->nullable();
            $table->unsignedBigInteger('seed_id');
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
        Schema::dropIfExists('laboratory_creates');
    }
}
