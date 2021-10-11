<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RepairLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_log', function (Blueprint $table) {
            $table->id('rl_id');
            $table->integer('amount');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::table('repair_log', function (Blueprint $table) {
            $table->unsignedBigInteger('cd_id');
            $table->foreign('cd_id')->references('cd_id')->on('container_detail');

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
        Schema::dropIfExists('repair_log');
    }
}
