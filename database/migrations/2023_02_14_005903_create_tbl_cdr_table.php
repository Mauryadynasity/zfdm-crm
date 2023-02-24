<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cdr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('src', 99)->nullable();
            $table->string('call_type', 99)->nullable();
            $table->string('hangup_cause', 99)->nullable();
            $table->string('is_customer', 99)->nullable();
            $table->string('description', 99)->nullable();
            $table->string('duration', 99)->nullable();
            $table->string('call_date', 99)->nullable();
            $table->string('email', 99)->nullable();
            $table->string('name', 99)->nullable();
            $table->string('company_name', 99)->nullable();
            $table->string('comment', 99)->nullable();

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
        Schema::dropIfExists('tbl_cdr');
    }
}
