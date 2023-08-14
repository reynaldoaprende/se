<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cicardian extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "cicardian";
    protected $fillable = [
        'user_id'
        ,'awake_hour_id'
        ,'bed_down_hour_id'
        ,'warning_alarm_clock_id'
        ,'easy_awake_id'
        ,'awake_first_half_hour_id'
        ,'awake_appetite_first_half_hour_id'
        ,'awake_feeling_first_half_hour_id'
        ,'awake_not_commited_bed_down_id'
        ,'awake_exercise_internal_clock_id'
        ,'tired_bed_down_hour_id'
        ,'performance_plan_test_hour_id'
        ,'tired_sleep_id'
        ,'bed_down_later_habitual_awake_id'
        ,'stay_awake_guard_id'
        ,'heavy_labor_id'
        ,'heavy_exercise_id'
        ,'choose_schedule_id'
        ,'max_welfare_id'
        ,'morning_evening_id'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
