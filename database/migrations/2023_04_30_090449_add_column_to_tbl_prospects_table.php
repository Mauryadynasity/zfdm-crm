<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTblProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_prospects', function (Blueprint $table) {
            $table->string('invoice_address')->after('admin_id')->nullable();
            $table->string('supply_address')->after('invoice_address')->nullable();
            $table->string('supply_address_checked')->after('supply_address')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tbl_prospects', function (Blueprint $table) {
            $table->dropColumn('new_column');
        });
    }
}
