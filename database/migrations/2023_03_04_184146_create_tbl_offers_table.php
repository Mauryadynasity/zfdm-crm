<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('additional_option_id', 99)->nullable();
            $table->string('admin_id', 99)->nullable();
            $table->string('prospact_id', 99)->nullable();
            $table->string('number_of_employee', 99)->nullable();
            $table->string('number_of_advised', 99)->nullable();
            $table->string('piece_prise', 99)->nullable();
            $table->string('prise', 99)->nullable();
            $table->string('an_notation', 99)->nullable();
            $table->enum('status', ['pending', 'active'])->default('pending');
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
        Schema::dropIfExists('tbl_offers');
    }
}
