<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Device extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->id('device_id');
            $table->string('device_name')->unique();
            // $table->string('dg_id');
        });
        Schema::table('device', function (Blueprint $table) {
            $table->unsignedBigInteger('dg_id');
        
            $table->foreign('dg_id')->references('dg_id')->on('device_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device');
    }
}
