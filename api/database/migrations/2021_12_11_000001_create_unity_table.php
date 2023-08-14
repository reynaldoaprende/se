<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();

            $table->bigInteger('how_often_affected_unexpectedly_id')->unsigned();
            $table->bigInteger('how_often_felt_unable_control_your_life_id')->unsigned();
            $table->bigInteger('how_often_nervous_or_stressed_id')->unsigned();
            $table->bigInteger('how_often_ability_handle_personal_problems_id')->unsigned();
            $table->bigInteger('how_often_things_going_well_you_id')->unsigned();
            $table->bigInteger('how_often_cope_all_things_id')->unsigned();
            $table->bigInteger('how_often_control_difficulties_id')->unsigned();
            $table->bigInteger('how_often_all_under_control_id')->unsigned();
            $table->bigInteger('how_often_angry_out_control_id')->unsigned();
            $table->bigInteger('how_often_difficulties_cannot_overcome_id')->unsigned();
            
            $table->bigInteger('feel_nervous_anxious_id')->unsigned();
            $table->bigInteger('feel_scares_no_reason_id')->unsigned();
            $table->bigInteger('feel_angry_easily_or_panic_id')->unsigned();
            $table->bigInteger('feel_falling_apart_id')->unsigned();
            $table->bigInteger('feel_arms_legs_shake_id')->unsigned();
            $table->bigInteger('feel_bothered_headaches_neck_pain_id')->unsigned();
            $table->bigInteger('feel_week_easily_tired_id')->unsigned();
            $table->bigInteger('feel_hear_beating_fast_id')->unsigned();
            $table->bigInteger('feel_dizziness_bothers_id')->unsigned();
            $table->bigInteger('feel_faint_fainting_spells_id')->unsigned();
            $table->bigInteger('feel_numbness_tingling_fingers_toes_id')->unsigned();
            $table->bigInteger('feel_bother_stomach_aches_id')->unsigned();
            $table->bigInteger('feel_empty_bladder_id')->unsigned();
            $table->bigInteger('feel_red_hot_face_id')->unsigned();
            $table->bigInteger('feel_nightmares_id')->unsigned();

            $table->bigInteger('stop_being_sad_id')->unsigned();
            $table->bigInteger('felt_depressed_id')->unsigned();
            $table->bigInteger('thought_my_life_has_been_failure_id')->unsigned();
            $table->bigInteger('felt_nervous_id')->unsigned();
            $table->bigInteger('was_happy_id')->unsigned();
            $table->bigInteger('felt_alone_id')->unsigned();
            $table->bigInteger('enjoyed_life_id')->unsigned();
            $table->bigInteger('have_crying_crisis_id')->unsigned();
            $table->bigInteger('felt_sad_id')->unsigned();
            $table->bigInteger('felt_couldnt_go_on_id')->unsigned();

            
            $table->bigInteger('have_thought_life_not_worth_living_id')->unsigned();
            $table->bigInteger('have_wished_were_dead_id')->unsigned();
            $table->bigInteger('have_thought_ending_your_life_id')->unsigned();
            $table->bigInteger('have_tried_kill_yourself_id')->unsigned();

            $table->bigInteger('do_you_have_someone_talk_id')->unsigned();
            $table->bigInteger('do_you_have_friend_talk_id')->unsigned();
            $table->bigInteger('do_you_have_someone_family_solve_poblems_id')->unsigned();
            $table->bigInteger('have_friend_solve_personal_problem_id')->unsigned();
            $table->bigInteger('your_parents_show_love_affection_id')->unsigned();
            $table->bigInteger('do_you_have_friend_show_affection_id')->unsigned();
            $table->bigInteger('do_you_trust_family_things_worry_id')->unsigned();
            $table->bigInteger('do_you_trust_friend_things_worry_id')->unsigned();
            $table->bigInteger('someone_family_support_problems_school_id')->unsigned();
            $table->bigInteger('someone_friend_help_homework_work_id')->unsigned();
            $table->bigInteger('someone_friend_support_problems_school_id')->unsigned();
            $table->bigInteger('family_talk_problems_all_supports_id')->unsigned();
            $table->bigInteger('satisfied_support_family_id')->unsigned();
            $table->bigInteger('satisfied_support_friend_id')->unsigned();





            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            /*Foreigns keys*/
            $table->foreign('how_often_affected_unexpectedly_id')->references('id')->on('details');
            $table->foreign('how_often_felt_unable_control_your_life_id')->references('id')->on('details');
            $table->foreign('how_often_nervous_or_stressed_id')->references('id')->on('details');
            $table->foreign('how_often_ability_handle_personal_problems_id')->references('id')->on('details');
            $table->foreign('how_often_things_going_well_you_id')->references('id')->on('details');
            $table->foreign('how_often_cope_all_things_id')->references('id')->on('details');
            $table->foreign('how_often_control_difficulties_id')->references('id')->on('details');
            $table->foreign('how_often_all_under_control_id')->references('id')->on('details');
            $table->foreign('how_often_angry_out_control_id')->references('id')->on('details');
            $table->foreign('how_often_difficulties_cannot_overcome_id')->references('id')->on('details');
            
            $table->foreign('feel_nervous_anxious_id')->references('id')->on('details');
            $table->foreign('feel_scares_no_reason_id')->references('id')->on('details');
            $table->foreign('feel_angry_easily_or_panic_id')->references('id')->on('details');
            $table->foreign('feel_falling_apart_id')->references('id')->on('details');
            $table->foreign('feel_arms_legs_shake_id')->references('id')->on('details');
            $table->foreign('feel_bothered_headaches_neck_pain_id')->references('id')->on('details');
            $table->foreign('feel_week_easily_tired_id')->references('id')->on('details');
            $table->foreign('feel_hear_beating_fast_id')->references('id')->on('details');
            $table->foreign('feel_dizziness_bothers_id')->references('id')->on('details');
            $table->foreign('feel_faint_fainting_spells_id')->references('id')->on('details');
            $table->foreign('feel_numbness_tingling_fingers_toes_id')->references('id')->on('details');
            $table->foreign('feel_bother_stomach_aches_id')->references('id')->on('details');
            $table->foreign('feel_empty_bladder_id')->references('id')->on('details');
            $table->foreign('feel_red_hot_face_id')->references('id')->on('details');
            $table->foreign('feel_nightmares_id')->references('id')->on('details');

            $table->foreign('stop_being_sad_id')->references('id')->on('details');
            $table->foreign('felt_depressed_id')->references('id')->on('details');
            $table->foreign('thought_my_life_has_been_failure_id')->references('id')->on('details');
            $table->foreign('felt_nervous_id')->references('id')->on('details');
            $table->foreign('was_happy_id')->references('id')->on('details');
            $table->foreign('felt_alone_id')->references('id')->on('details');
            $table->foreign('enjoyed_life_id')->references('id')->on('details');
            $table->foreign('have_crying_crisis_id')->references('id')->on('details');
            $table->foreign('felt_sad_id')->references('id')->on('details');
            $table->foreign('felt_couldnt_go_on_id')->references('id')->on('details');

            
            $table->foreign('have_thought_life_not_worth_living_id')->references('id')->on('details');
            $table->foreign('have_wished_were_dead_id')->references('id')->on('details');
            $table->foreign('have_thought_ending_your_life_id')->references('id')->on('details');
            $table->foreign('have_tried_kill_yourself_id')->references('id')->on('details');

            $table->foreign('do_you_have_someone_talk_id')->references('id')->on('details');
            $table->foreign('do_you_have_friend_talk_id')->references('id')->on('details');
            $table->foreign('do_you_have_someone_family_solve_poblems_id')->references('id')->on('details');
            $table->foreign('have_friend_solve_personal_problem_id')->references('id')->on('details');
            $table->foreign('your_parents_show_love_affection_id')->references('id')->on('details');
            $table->foreign('do_you_have_friend_show_affection_id')->references('id')->on('details');
            $table->foreign('do_you_trust_family_things_worry_id')->references('id')->on('details');
            $table->foreign('do_you_trust_friend_things_worry_id')->references('id')->on('details');
            $table->foreign('someone_family_support_problems_school_id')->references('id')->on('details');
            $table->foreign('someone_friend_help_homework_work_id')->references('id')->on('details');
            $table->foreign('someone_friend_support_problems_school_id')->references('id')->on('details');
            $table->foreign('family_talk_problems_all_supports_id')->references('id')->on('details');
            $table->foreign('satisfied_support_family_id')->references('id')->on('details');
            $table->foreign('satisfied_support_friend_id')->references('id')->on('details');
            
            $table->foreign('user_id')->references('id')->on('users');
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
