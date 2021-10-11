<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id('station_id');
            $table->string('station_name');
            $table->string('station_lat');
            $table->string('station_long');
        });

        Schema::table('stations', function (Blueprint $table){
            $table->unsignedBigInteger('tc_id');
            $table->foreign('tc_id')->references('tc_id')->on('telecommunication_centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
