<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pittsburgh extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "pittsburgh";
    protected $fillable = [
        'user_id'
        ,'time_sleep_night'
        ,'last_month_time_asleep_id'
        ,'last_month_awaing_habitually_morning'
        ,'last_month_hours_sleep_each_night'
        ,'cant_asleep_first_half_hour_id'

        ,'awaking_half_night_id'
        ,'awaking_go_to_bathroom_id'
        ,'cant_breathe_well_id'
        ,'cough_loudly_id'
        ,'cold_feel_id'
        ,'heat_feel_id'
        ,'have_nightmares_id'
        ,'have_smells_id'
        ,'other_reasons_id'
        ,'take_pill_id'
        ,'last_month_problems_stay_awake_id'
        ,'last_month_enthusiasm_id'
        ,'last_month_sleep_quality_id'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
