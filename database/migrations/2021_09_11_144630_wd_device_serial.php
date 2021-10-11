<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WdDeviceSerial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wd_device_serial', function (Blueprint $table) {
            $table->id('wdds_id');
            $table->string('serial_number');
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('wd_device_serial', function (Blueprint $table) {
            $table->unsignedBigInteger('wd_id');
            $table->foreign('wd_id')->references('wd_id')->on('warehouse_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wd_device_serial');
    }
}
