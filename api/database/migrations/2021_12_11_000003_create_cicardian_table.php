<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCicardianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicardian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('awake_hour_id')->unsigned();
        $table->bigInteger('bed_down_hour_id')->unsigned();
        $table->bigInteger('warning_alarm_clock_id')->unsigned();
        $table->bigInteger('easy_awake_id')->unsigned();
        $table->bigInteger('awake_first_half_hour_id')->unsigned();
        $table->bigInteger('awake_appetite_first_half_hour_id')->unsigned();
        $table->bigInteger('awake_feeling_first_half_hour_id')->unsigned();
        $table->bigInteger('awake_not_commited_bed_down_id')->unsigned();
        $table->bigInteger('awake_exercise_internal_clock_id')->unsigned();
        $table->bigInteger('tired_bed_down_hour_id')->unsigned();
        $table->bigInteger('performance_plan_test_hour_id')->unsigned();
        $table->bigInteger('tired_sleep_id')->unsigned();
        $table->bigInteger('bed_down_later_habitual_awake_id')->unsigned();
        $table->bigInteger('stay_awake_guard_id')->unsigned();
        $table->bigInteger('heavy_labor_id')->unsigned();
        $table->bigInteger('heavy_exercise_id')->unsigned();
        $table->bigInteger('choose_schedule_id')->unsigned();
        $table->bigInteger('max_welfare_id')->unsigned();
        $table->bigInteger('morning_evening_id')->unsigned();

            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('awake_hour_id')->references('id')->on('details');
        $table->foreign('bed_down_hour_id')->references('id')->on('details');
        $table->foreign('warning_alarm_clock_id')->references('id')->on('details');
        $table->foreign('easy_awake_id')->references('id')->on('details');
        $table->foreign('awake_first_half_hour_id')->references('id')->on('details');
        $table->foreign('awake_appetite_first_half_hour_id')->references('id')->on('details');
        $table->foreign('awake_feeling_first_half_hour_id')->references('id')->on('details');
        $table->foreign('awake_not_commited_bed_down_id')->references('id')->on('details');
        $table->foreign('awake_exercise_internal_clock_id')->references('id')->on('details');
        $table->foreign('tired_bed_down_hour_id')->references('id')->on('details');
        $table->foreign('performance_plan_test_hour_id')->references('id')->on('details');
        $table->foreign('tired_sleep_id')->references('id')->on('details');
        $table->foreign('bed_down_later_habitual_awake_id')->references('id')->on('details');
        $table->foreign('stay_awake_guard_id')->references('id')->on('details');
        $table->foreign('heavy_labor_id')->references('id')->on('details');
        $table->foreign('heavy_exercise_id')->references('id')->on('details');
        $table->foreign('choose_schedule_id')->references('id')->on('details');
        $table->foreign('max_welfare_id')->references('id')->on('details');
        $table->foreign('morning_evening_id')->references('id')->on('details');

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
        Schema::dropIfExists('cicardian');
    }
}
