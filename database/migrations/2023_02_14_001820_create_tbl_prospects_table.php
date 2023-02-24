<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_prospects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name', 99)->nullable();
            $table->string('title', 99)->nullable();
            $table->string('first_name', 99)->nullable();
            $table->string('cust_name', 99)->nullable();
            $table->string('cust_email', 99)->nullable();
            $table->string('cust_address', 99)->nullable();
            $table->string('postcode', 99)->nullable();
            $table->string('place_name', 99)->nullable();
            $table->string('cust_phone', 99)->nullable();
            $table->string('wants_offer', 99)->nullable();
            $table->string('no_employee', 199)->nullable();
            $table->string('cust_msg', 199)->nullable();
            $table->string('device_type', 199)->nullable();
            $table->string('packet', 199)->nullable();
            $table->string('cust_source', 199)->nullable();
            $table->string('callback', 199)->nullable();
            $table->string('date_of_contact', 199)->nullable();
            $table->string('protocol', 199)->nullable();
            $table->string('no_device', 199)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->bigInteger('owner_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('owner_id')->references('id')->on('tbl_admin');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_prospects');
    }
}
