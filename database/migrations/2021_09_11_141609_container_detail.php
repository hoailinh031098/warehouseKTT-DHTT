<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContainerDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_detail', function (Blueprint $table) {
            $table->id('cd_id');
            $table->integer('amount');
            $table->timestamps();
        });
        Schema::table('container_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('container_id');
            $table->foreign('container_id')->references('container_id')->on('container');

            $table->unsignedBigInteger('dl_id');
            $table->foreign('dl_id')->references('dl_id')->on('device_line');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit');

            $table->unsignedBigInteger('cs_id');
            $table->foreign('cs_id')->references('cs_id')->on('container_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('container_detail');
    }
}
