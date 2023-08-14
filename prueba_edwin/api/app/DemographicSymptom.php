<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemographicSymptom extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "demographic_id"
        ,"symptoms_last_week_id"

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
