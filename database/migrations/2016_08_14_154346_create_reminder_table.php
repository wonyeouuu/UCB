<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note');
            $table->integer('user_id')->unsigned();
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->tinyInteger('frequency')->unsigned()->comment('1: 1/day, 2: 2/day, 3: 3/day, 4: 4/day, 5: 3/week, 6: 1/2days, 7: 1/3days, 8: 1/week, 9: 1/28days');
            $table->string('days')->nullable()->comment('save days as string represent array');
            $table->string('times')->nullable()->comment('save times as string represent array');
            $table->integer('reminder_before')->unsigned()->comment('reminder before x seconds');
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
        Schema::drop('reminders');
    }
}
