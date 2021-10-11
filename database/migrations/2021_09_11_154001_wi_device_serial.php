<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WiDeviceSerial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wi_device_serial', function (Blueprint $table) {
            $table->id('wids_id');
            $table->string('serial_number');
            $table->timestamps();
        });
        Schema::table('wi_device_serial', function (Blueprint $table) {
            $table->unsignedBigInteger('wid_id');
            $table->foreign('wid_id')->references('wid_id')->on('warehouse_impact_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wi_device_serial');
    }
}
