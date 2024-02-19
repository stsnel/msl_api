<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrganizationCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_creates', function (Blueprint $table) {
            $table->id();
            $table->string('organization_type');
            $table->json('organization');
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
        Schema::dropIfExists('organization_creates');
    }
}
