<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reminder_id')->unsigned();
            $table->timestamp('alert_at');
            $table->tinyInteger('status')->unsigned()->comment('1: waiting, 2: triggered')->default(1);
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
        Schema::drop('alerts');
    }
}
