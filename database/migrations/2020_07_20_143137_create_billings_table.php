<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tenant_id');
            $table->string('tenant_name');
            $table->integer('merchant_id');
            $table->string('merchant_name');
            $table->string('merchant_email');
            $table->string('billing_number');
            $table->string('billing_periode');
            $table->string('billing_price');
            $table->string('billing_total');
            $table->string('billing_status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
