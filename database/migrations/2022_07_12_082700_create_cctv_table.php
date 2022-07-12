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
        Schema::create('cctv', function (Blueprint $table) {
            $table->primary('id');
            $table->string('name');
            $table->string('location');
            $table->text('liveViewUrl');
            $table->boolean('isPing');
            $table->boolean('isLogin');
            $table->boolean('isLiveView');
            $table->boolean('isOpenvpn');
            $table->bigInteger('rt');
            $table->bigInteger('rw');
            $table->string('kelurahan');
            $table->kecamatan('kecamatan');
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
