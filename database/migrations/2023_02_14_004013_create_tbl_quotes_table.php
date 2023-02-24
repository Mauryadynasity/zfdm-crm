<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prospect_id', 99)->nullable();
            $table->string('quote_no', 99)->nullable();
            $table->date('quote_date', 99)->nullable();
            $table->string('invoice_name', 99)->nullable();

            $table->timestamps();
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
        Schema::dropIfExists('tbl_quotes');
    }
}
