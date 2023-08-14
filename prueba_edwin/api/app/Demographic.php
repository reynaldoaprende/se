<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
        ,'family_id'
        ,'name'
        ,'age'
        ,'document_type_id'
        ,'document'
        ,'gender_id'
        ,'birthdate_place_id'
        ,'birthdate'
        ,'civil_status_id'
        ,"occupation"
        ,"scholarship_id"
        ,"city_id"
        ,"email"
        ,"socioeconomic"
        ,"pandemic_affectation_way_id"
        ,"sick_covid"
        ,"vaccinate_covid"
        ,"relative_covid"
        ,"applied_vaccine_id"
        ,"full_dose"
        ,"reason_not_vaccinated_id"
        ,"disability"
        ,"disability_type_id"
        ,"psychoactive_substances_id"
        ,"symptoms_last_week_id"

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];

    public function location()
    {
        return $this->belongsTo('App\Location','birthdate_place_id')->with("state");
    }

    public function city()
    {
        return $this->belongsTo('App\Location','city_id')->with("state");
    }

    public function demographic_symptoms()
    {
        return $this->belongsToMany('App\Detail','demographic_symptoms','demographic_id','symptoms_last_week_id');
    }
}
