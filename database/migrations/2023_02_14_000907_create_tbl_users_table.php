<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->bigIncrements('owner_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 99)->nullable();
            $table->string('sim_id')->nullable();
            $table->string('password')->nullable();
            $table->integer('salt')->nullable();
            $table->string('lang')->nullable();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('role_id')->references('id')->on('tbl_roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
}
