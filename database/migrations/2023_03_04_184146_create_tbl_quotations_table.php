<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('additional_option_id', 99)->nullable();
            $table->string('admin_id', 99)->nullable();
            $table->string('prospact_id', 99)->nullable();
            $table->string('number_of_position', 99)->nullable();
            $table->string('article_description', 99)->nullable();
            $table->string('prise_per_article', 99)->nullable();
            $table->string('number_of_article', 99)->nullable();
            $table->string('price', 99)->nullable();
            $table->string('quotation_number', 99)->nullable();
            $table->date('quotation_date')->nullable();
            $table->string('ust_number', 99)->nullable();
            $table->string('sub_total', 99)->nullable();
            $table->string('grand_total', 99)->nullable();
            $table->string('comments', 255)->nullable();
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
        Schema::dropIfExists('tbl_quotations');
    }
}
