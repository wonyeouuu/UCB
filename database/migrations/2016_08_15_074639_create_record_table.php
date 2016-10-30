<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('symptom');
            $table->tinyInteger('relapse')->unsigned()->comment('1: on, 2: off');
            $table->decimal('edss', 10, 1)->unsigned();
            $table->string('mri');
            $table->integer('t25fw')->unsigned();
            $table->integer('msws')->unsigned();
            $table->timestamp('date');
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
        Schema::drop('records');
    }
}
