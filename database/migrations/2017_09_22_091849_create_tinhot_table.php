<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinhotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinhot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTinhot')->unsigned();
            $table->foreign('idTinhot')->references('id')->on('TinTuc');
            $table->string('TieuDe');
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
        Schema::drop('tinhot');
    }
}
