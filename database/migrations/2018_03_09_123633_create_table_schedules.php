<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('from_place_id')->unsigned();
            $table->integer('to_place_id')->unsigned();
            $table->enum('type',['BUS','TRAIN']);
            $table->enum('status',['AVIABLE','UNAVIABLE']);
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->string('distance', 20);
            $table->string('sped', 7);
            $table->foreign('from_place_id')->references('id')->on('places');
            $table->foreign('to_place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
