<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affection extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "affection";
    protected $fillable = [
        'user_id'
        ,'many_times_feel_nervous_id'
        ,'feel_confident_in_life_id'
        ,'im_brave_id'
        ,'feel_tired_last_months_id'
        ,'worried_last_times_id'
        ,'have_determination_want_it_id'
        ,'feel_guilt_did_past_id'
        ,'appasionate_things_i_do_id'
        ,'many_situations_happiness_recent_times_id'
        ,'angry_when_contradict_me_id'
        ,'people_say_moody_id'
        ,'lately_been_situations_angry_id'
        ,'general_feel_strong_id'
        ,'pleasure_experiences_new_things_id'
        ,'feel_satisfied_myself_id'
        ,'irritated_easily_id'
        ,'im_brave_faced_challenge_id'
        ,'im_happy_person_id'
        ,'recent_times_felt_humiliated_id'
        ,'feeling_sad_lately_id'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
