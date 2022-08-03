<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KoperasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # create user relation table
        Schema::create('user_role', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('roleId')->primary()->unique();
            $table->string('position');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('userId')->primary()->unique();
            $table->string('email');
            $table->string('password');
            $table->string('username');
            $table->string('roleId');
            $table->foreign('roleId')->references('roleId')->on('user_role');
            $table->string('phone');
            $table->string('address');
        });

        Schema::create('user_savings', function (Blueprint $table) {
            $table->id('savingId');
            $table->string('userId');
            $table->string('tabungan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
