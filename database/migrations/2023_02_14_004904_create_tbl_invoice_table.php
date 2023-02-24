<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prospect_id', 99)->nullable();
            $table->date('invoice_no', 99)->nullable();
            $table->date('invoice_date', 99)->nullable();
            $table->date('modify_date', 99)->nullable();
            $table->date('due_date', 99)->nullable();
            $table->string('vat', 99)->nullable();
            $table->string('remote', 99)->nullable();
            $table->string('cloud', 99)->nullable();
            $table->string('chips', 99)->nullable();
            $table->float('invoice_amount', 8,2)->nullable();

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
        Schema::dropIfExists('tbl_invoice');
    }
}
