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
            $table->string('invoice_addres')->after('admin_id')->nullable();
            $table->string('supply_addres')->after('invoice_addres')->nullable();
            $table->string('supply_addres_checked')->after('supply_addres')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tbl_prospects', function (Blueprint $table) {
            $table->dropColumn('new_column');
        });
    }
}
