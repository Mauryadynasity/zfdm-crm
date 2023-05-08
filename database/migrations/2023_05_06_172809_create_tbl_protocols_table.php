<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_protocols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prospect_id', 99)->nullable();
            $table->string('admin_id', 99)->nullable();
            $table->string('messages', 99)->nullable();
            $table->date('date')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_protocols');
    }
}
