<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeviceLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_line', function (Blueprint $table) {
            $table->id('dl_id');
            $table->string('dl_name')->unique();
            // $table->string('device_id');
        });
        Schema::table('device_line', function (Blueprint $table) {
            $table->unsignedBigInteger('device_id');
        
            $table->foreign('device_id')->references('device_id')->on('device');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_line');
    }
}
