<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WarehouseDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_detail', function (Blueprint $table) {
            $table->id('wd_id');
            $table->integer('amount');
            $table->timestamps();
        });
        Schema::table('warehouse_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('warehouse_id')->on('warehouse');

            $table->unsignedBigInteger('dl_id');
            $table->foreign('dl_id')->references('dl_id')->on('device_line');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit');

            $table->unsignedBigInteger('ds_id');
            $table->foreign('ds_id')->references('ds_id')->on('device_status');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_detail');
    }
}
