<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "unity";
    protected $fillable = [
        'user_id'
        ,'how_often_affected_unexpectedly_id'
        ,'how_often_felt_unable_control_your_life_id'
        ,'how_often_nervous_or_stressed_id'
        ,'how_often_ability_handle_personal_problems_id'
        ,'how_often_things_going_well_you_id'
        ,'how_often_cope_all_things_id'
        ,'how_often_control_difficulties_id'
        ,'how_often_all_under_control_id'
        ,'how_often_angry_out_control_id'
        ,'how_often_difficulties_cannot_overcome_id'
        
        ,'feel_nervous_anxious_id'
        ,'feel_scares_no_reason_id'
        ,'feel_angry_easily_or_panic_id'
        ,'feel_falling_apart_id'
        ,'feel_arms_legs_shake_id'
        ,'feel_bothered_headaches_neck_pain_id'
        ,'feel_week_easily_tired_id'
        ,'feel_hear_beating_fast_id'
        ,'feel_dizziness_bothers_id'
        ,'feel_faint_fainting_spells_id'
        ,'feel_numbness_tingling_fingers_toes_id'
        ,'feel_bother_stomach_aches_id'
        ,'feel_empty_bladder_id'
        ,'feel_red_hot_face_id'
        ,'feel_nightmares_id'

        ,'stop_being_sad_id'
        ,'felt_depressed_id'
        ,'thought_my_life_has_been_failure_id'
        ,'felt_nervous_id'
        ,'was_happy_id'
        ,'felt_alone_id'
        ,'enjoyed_life_id'
        ,'have_crying_crisis_id'
        ,'felt_sad_id'
        ,'felt_couldnt_go_on_id'

        
        ,'have_thought_life_not_worth_living_id'
        ,'have_wished_were_dead_id'
        ,'have_thought_ending_your_life_id'
        ,'have_tried_kill_yourself_id'

        ,'do_you_have_someone_talk_id'
        ,'do_you_have_friend_talk_id'
        ,'do_you_have_someone_family_solve_poblems_id'
        ,'have_friend_solve_personal_problem_id'
        ,'your_parents_show_love_affection_id'
        ,'do_you_have_friend_show_affection_id'
        ,'do_you_trust_family_things_worry_id'
        ,'do_you_trust_friend_things_worry_id'
        ,'someone_family_support_problems_school_id'
        ,'someone_friend_help_homework_work_id'
        ,'someone_friend_support_problems_school_id'
        ,'family_talk_problems_all_supports_id'
        ,'satisfied_support_family_id'
        ,'satisfied_support_friend_id'

        ,'created_user_at'
        ,'deleted_user_at'
        ,'updated_user_at'
        ,'created_at'
        ,'deleted_at'
        ,'updated_at'
    ];
}
