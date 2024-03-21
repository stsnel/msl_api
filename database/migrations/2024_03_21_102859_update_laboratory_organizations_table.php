<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLaboratoryOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laboratory_organizations', function (Blueprint $table) {
            $table->text('ror_country')->nullable('');
            $table->text('ror_country_code')->nullable('');
            $table->text('ror_website')->nullable('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laboratory_organizations', function (Blueprint $table) {
            $table->dropColumn('ror_country');
            $table->dropColumn('ror_country_code');
            $table->dropColumn('ror_website');
        });
    }
}
