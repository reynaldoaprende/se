<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePittsburghTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pittsburgh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            
            $table->dateTime('time_sleep_night');
            $table->bigInteger('last_month_time_asleep_id')->unsigned();
            $table->dateTime('last_month_awaing_habitually_morning');
            $table->integer('last_month_hours_sleep_each_night');
            $table->bigInteger('cant_asleep_first_half_hour_id')->unsigned();

            $table->bigInteger('awaking_half_night_id')->unsigned();
            $table->bigInteger('awaking_go_to_bathroom_id')->unsigned();
            $table->bigInteger('cant_breathe_well_id')->unsigned();
            $table->bigInteger('cough_loudly_id')->unsigned();
            $table->bigInteger('cold_feel_id')->unsigned();
            $table->bigInteger('heat_feel_id')->unsigned();
            $table->bigInteger('have_nightmares_id')->unsigned();
            $table->bigInteger('have_smells_id')->unsigned();
            $table->bigInteger('other_reasons_id')->unsigned();
            $table->bigInteger('take_pill_id')->unsigned();
            $table->bigInteger('last_month_problems_stay_awake_id')->unsigned();
            $table->bigInteger('last_month_enthusiasm_id')->unsigned();
            $table->bigInteger('last_month_sleep_quality_id')->unsigned();

            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('last_month_time_asleep_id')->references('id')->on('details');
            $table->foreign('cant_asleep_first_half_hour_id')->references('id')->on('details');
            $table->foreign('awaking_half_night_id')->references('id')->on('details');
            $table->foreign('awaking_go_to_bathroom_id')->references('id')->on('details');
            $table->foreign('cant_breathe_well_id')->references('id')->on('details');
            $table->foreign('cough_loudly_id')->references('id')->on('details');
            $table->foreign('cold_feel_id')->references('id')->on('details');
            $table->foreign('heat_feel_id')->references('id')->on('details');
            $table->foreign('have_nightmares_id')->references('id')->on('details');
            $table->foreign('have_smells_id')->references('id')->on('details');
            $table->foreign('other_reasons_id')->references('id')->on('details');
            $table->foreign('take_pill_id')->references('id')->on('details');
            $table->foreign('last_month_problems_stay_awake_id')->references('id')->on('details');
            $table->foreign('last_month_enthusiasm_id')->references('id')->on('details');
            $table->foreign('last_month_sleep_quality_id')->references('id')->on('details');

            $table->foreign('created_user_at')->references('id')->on('users');
            $table->foreign('deleted_user_at')->references('id')->on('users');
            $table->foreign('updated_user_at')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pittsburgh');
    }
}
