<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VerifyRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_request', function (Blueprint $table) {
            $table->id('vr_id');
            $table->string('vr_name');
            $table->integer('confirm');
            $table->timestamps();
        });
        Schema::table('verify_request', function (Blueprint $table) {
            $table->unsignedBigInteger('wi_id');
            $table->foreign('wi_id')->references('wi_id')->on('warehouse_impact');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verify_request');
    }
}
