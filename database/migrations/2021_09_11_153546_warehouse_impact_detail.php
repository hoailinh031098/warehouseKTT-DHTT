<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WarehouseImpactDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_impact_detail', function (Blueprint $table) {
            $table->id('wid_id');
            $table->integer('amount');
            $table->timestamps();
        });
        Schema::table('warehouse_impact_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('wi_id');
            $table->foreign('wi_id')->references('wi_id')->on('warehouse_impact');

            $table->unsignedBigInteger('ds_id');
            $table->foreign('ds_id')->references('ds_id')->on('device_status');

            $table->unsignedBigInteger('dl_id');
            $table->foreign('dl_id')->references('dl_id')->on('device_line');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_impact_detail');
    }
}
