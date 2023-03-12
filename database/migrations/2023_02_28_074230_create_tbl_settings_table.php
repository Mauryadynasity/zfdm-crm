<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name', 99)->nullable();
            $table->string('person_name', 99)->nullable();
            $table->string('website_url', 99)->nullable();
            $table->string('company_logo', 99)->nullable();
            $table->string('phone', 99)->nullable();
            $table->string('mobile_number', 99)->nullable();
            $table->string('landline_number', 99)->nullable();
            $table->string('email', 99)->nullable();
            $table->string('company_address', 99)->nullable();
            $table->string('streat_name_1', 99)->nullable();
            $table->string('streat_name_2', 99)->nullable();
            $table->string('streat_name_3', 99)->nullable();
            $table->string('place_code', 99)->nullable();
            $table->string('place_name', 99)->nullable();
            $table->string('country', 99)->nullable();
            $table->string('bank_name', 99)->nullable();
            $table->string('account_number', 99)->nullable();
            $table->string('ifsc_code', 99)->nullable();
            $table->string('branch_address', 99)->nullable();
            $table->string('tax_number', 99)->nullable();
            $table->string('tax_identification_no', 99)->nullable();
            $table->string('admin_id', 99)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

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
        Schema::dropIfExists('tbl_settings');
    }
}
