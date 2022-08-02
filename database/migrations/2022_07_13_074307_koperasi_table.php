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

        // Schema::create('user_savings', function (Blueprint $table) {
        //     $table->integer('savingId')->unique()->primary()->autoIncrement();
        //     $table->string('userId');
        //     $table->foreign('userId')->references('userId')->on('users');
        //     $table->string('position');
        // });

        // # create business relation table
        // Schema::create('business', function (Blueprint $table) {
        //     $table->string('businessId')->unique()->primary();
        //     $table->string('nameOfBusiness');
        //     $table->string('pic');
        //     $table->foreign('pic')->references('userId')->on('users');
        // });

        // Schema::create('business_needs', function (Blueprint $table) {
        //     $table->string('stuffId')->unique()->primary();
        //     $table->string('name');
        //     $table->string('businessId');
        //     $table->foreign('businessId')->references('businessId')->on('business');
        // });

        // Schema::create('business_report', function (Blueprint $table) {
        //     $table->integer('reportId')->unique()->primary()->autoIncrement();
        //     $table->integer('total');
        //     $table->string('businessId');
        //     $table->foreign('businessId')->references('businessId')->on('business');
        //     $table->dateTime('transaction_date');
        //     $table->enum('status', ['Pemasukan', 'Penjualan']);
        //     $table->string('description');
        // });


        // # create installment relation table
        // Schema::create('user_pinjam', function (Blueprint $table) {
        //     $table->integer('pinjamanId')->unique()->primary()->autoIncrement();
        //     $table->string('userId');
        //     $table->foreign('userId')->references('businessId')->on('business');
        //     $table->dateTime('transaction_date');
        //     $table->enum('status', ['Pemasukan', 'Penjualan']);
        //     $table->string('description');
        // });

        // Schema::create('user_cicilan', function (Blueprint $table) {
        //     $table->integer('cicilanId')->unique()->primary()->autoIncrement();
        //     $table->string('pinjamanId');
        //     $table->foreign('pinjamanId')->references('pinjamanId')->on('user_pinjam');
        //     $table->integer('total');
        //     $table->dateTime('transaction_date');
        //     $table->integer('tagihan_ke');
        // });
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
