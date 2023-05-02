<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTblProspectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_prospects', function (Blueprint $table) {
            $table->string('supply_street')->after('place_name')->nullable();
            $table->string('supply_post_code')->after('supply_street')->nullable();
            $table->string('supply_place')->after('supply_post_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
