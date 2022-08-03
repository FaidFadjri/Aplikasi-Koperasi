<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bisnis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # create business relation table
        Schema::create('business', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('businessId')->unique()->primary();
            $table->string('nameOfBusiness');
            $table->string('pic');
            $table->foreign('pic')->references('userId')->on('users');
        });

        Schema::create('business_needs', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('stuffId')->unique()->primary();
            $table->string('name');
            $table->string('businessId');
            $table->foreign('businessId')->references('businessId')->on('business');
        });

        Schema::create('business_report', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->id('reportId');
            $table->integer('total');
            $table->string('businessId');
            $table->foreign('businessId')->references('businessId')->on('business');
            $table->dateTime('transaction_date');
            $table->enum('status', ['Pemasukan', 'Penjualan']);
            $table->string('description');
        });


        # create installment relation table
        Schema::create('user_pinjam', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->id('pinjamanId');
            $table->string('userId');
            $table->foreign('userId')->references('businessId')->on('business');
            $table->dateTime('transaction_date');
            $table->enum('status', ['Pemasukan', 'Penjualan']);
            $table->string('description');
        });

        Schema::create('user_cicilan', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->id('cicilanId');
            $table->string('pinjamanId');
            $table->integer('total');
            $table->dateTime('transaction_date');
            $table->integer('tagihan_ke');
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
