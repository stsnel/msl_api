<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKeywordsSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keywords_search', function (Blueprint $table) {
            $table->boolean('exclude_abstract_mapping')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keywords_search', function (Blueprint $table) {
            $table->dropColumn('exclude_abstract_mapping');
        });
    }
}
