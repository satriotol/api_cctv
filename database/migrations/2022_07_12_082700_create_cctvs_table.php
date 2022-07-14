<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cctvs', function (Blueprint $table) {
            $table->id();
            $table->longText('relation_id');
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->text('liveViewUrl')->nullable();
            $table->boolean('isPing')->nullable();
            $table->boolean('isLogin')->nullable();
            $table->boolean('isLiveView')->nullable();
            $table->boolean('isOpenvpn')->nullable();
            $table->bigInteger('rt')->nullable();
            $table->bigInteger('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cctv');
    }
};
