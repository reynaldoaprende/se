<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViolenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            
            $table->bigInteger('frequency_my_partner_told_me_grooming_id')->unsigned();
            $table->bigInteger('frequency_my_partner_pushed_me_hard_id')->unsigned();
            $table->bigInteger('frequency_my_partner_gets_angry_what_wants_id')->unsigned();
            $table->bigInteger('frequency_my_partner_criticizes_me_lover_id')->unsigned();
            $table->bigInteger('frequency_my_partner_rejects_have_sex_id')->unsigned();
            $table->bigInteger('frequency_my_partner_monitors_everything_id')->unsigned();
            $table->bigInteger('frequency_my_partner_said_ugly_unattractive_id')->unsigned();
            $table->bigInteger('frequency_my_partner_take_account_sexual_id')->unsigned();
            $table->bigInteger('frequency_my_partner_forbids_friends_id')->unsigned();
            $table->bigInteger('frequency_my_partner_uses_money_control_me_id')->unsigned();
            $table->bigInteger('frequency_my_partner_hit_something_scare_me_id')->unsigned();
            $table->bigInteger('frequency_my_partner_threatened_leave_me_id')->unsigned();
            $table->bigInteger('frequency_i_have_afraid_partner_id')->unsigned();
            $table->bigInteger('frequency_my_partner_has_forced_have_sex_id')->unsigned();
            $table->bigInteger('frequency_my_partner_upset_successes_id')->unsigned();
            $table->bigInteger('frequency_my_partner_has_hit_me_id')->unsigned();
            $table->bigInteger('frequency_my_partner_forbids_work_studying_id')->unsigned();
            $table->bigInteger('frequency_my_partner_verbally_assaults_id')->unsigned();
            $table->bigInteger('frequency_my_partner_angry_children_should_id')->unsigned();
            $table->bigInteger('frequency_my_partner_angry_tell_money_id')->unsigned();
            $table->bigInteger('frequency_my_partner_gets_upset_food_works_id')->unsigned();
            $table->bigInteger('frequency_my_partner_gets_jealous_friends_id')->unsigned();
            $table->bigInteger('frequency_my_partner_manages_money_id')->unsigned();
            $table->bigInteger('frequency_my_partner_blackmails_me_money_id')->unsigned();
            $table->bigInteger('frequency_my_partner_has_come_insult_me_id')->unsigned();
            $table->bigInteger('frequency_my_partner_financially_angry_id')->unsigned();
            $table->bigInteger('frequency_my_partner_made_fun_some_part_body_id')->unsigned();
            $table->bigInteger('frequency_ive_told_hes_blame_our_problems_id')->unsigned();
            $table->bigInteger('frequency_i_have_come_yell_partner_id')->unsigned();
            $table->bigInteger('frequency_i_have_angry_contradicts_disagrees_id')->unsigned();
            $table->bigInteger('frequency_i_have_come_insult_my_partner_id')->unsigned();
            $table->bigInteger('frequency_i_have_threatened_partner_leave_id')->unsigned();
            $table->bigInteger('frequency_when_he_verbally_attack_my_partner_id')->unsigned();
            $table->bigInteger('frequency_i_take_sexual_needs_partner_id')->unsigned();
            $table->bigInteger('frequency_i_have_forbidden_partner_friends_id')->unsigned();
            $table->bigInteger('frequency_i_have_physically_hurt_partner_id')->unsigned();
            $table->bigInteger('frequency_it_bothers_my_partner_spends_money_id')->unsigned();
            $table->bigInteger('frequency_i_have_required_my_partner_spends_id')->unsigned();
            $table->bigInteger('frequency_i_have_told_my_partner_is_ugly_id')->unsigned();

            
            $table->bigInteger('damage_my_partner_told_me_grooming_id')->unsigned();
            $table->bigInteger('damage_my_partner_pushed_me_hard_id')->unsigned();
            $table->bigInteger('damage_my_partner_gets_angry_what_wants_id')->unsigned();
            $table->bigInteger('damage_my_partner_criticizes_me_lover_id')->unsigned();
            $table->bigInteger('damage_my_partner_rejects_have_sex_id')->unsigned();
            $table->bigInteger('damage_my_partner_monitors_everything_id')->unsigned();
            $table->bigInteger('damage_my_partner_said_ugly_unattractive_id')->unsigned();
            $table->bigInteger('damage_my_partner_take_account_sexual_id')->unsigned();
            $table->bigInteger('damage_my_partner_forbids_friends_id')->unsigned();
            $table->bigInteger('damage_my_partner_uses_money_control_me_id')->unsigned();
            $table->bigInteger('damage_my_partner_hit_something_scare_me_id')->unsigned();
            $table->bigInteger('damage_my_partner_threatened_leave_me_id')->unsigned();
            $table->bigInteger('damage_i_have_afraid_partner_id')->unsigned();
            $table->bigInteger('damage_my_partner_has_forced_have_sex_id')->unsigned();
            $table->bigInteger('damage_my_partner_upset_successes_id')->unsigned();
            $table->bigInteger('damage_my_partner_has_hit_me_id')->unsigned();
            $table->bigInteger('damage_my_partner_forbids_work_studying_id')->unsigned();
            $table->bigInteger('damage_my_partner_verbally_assaults_id')->unsigned();
            $table->bigInteger('damage_my_partner_angry_children_should_id')->unsigned();
            $table->bigInteger('damage_my_partner_angry_tell_money_id')->unsigned();
            $table->bigInteger('damage_my_partner_gets_upset_food_works_id')->unsigned();
            $table->bigInteger('damage_my_partner_gets_jealous_friends_id')->unsigned();
            $table->bigInteger('damage_my_partner_manages_money_id')->unsigned();
            $table->bigInteger('damage_my_partner_blackmails_me_money_id')->unsigned();
            $table->bigInteger('damage_my_partner_has_come_insult_me_id')->unsigned();
            $table->bigInteger('damage_my_partner_financially_angry_id')->unsigned();
            $table->bigInteger('damage_my_partner_made_fun_some_part_body_id')->unsigned();
            $table->bigInteger('damage_ive_told_hes_blame_our_problems_id')->unsigned();
            $table->bigInteger('damage_i_have_come_yell_partner_id')->unsigned();
            $table->bigInteger('damage_i_have_angry_contradicts_disagrees_id')->unsigned();
            $table->bigInteger('damage_i_have_come_insult_my_partner_id')->unsigned();
            $table->bigInteger('damage_i_have_threatened_partner_leave_id')->unsigned();
            $table->bigInteger('damage_when_he_verbally_attack_my_partner_id')->unsigned();
            $table->bigInteger('damage_i_take_sexual_needs_partner_id')->unsigned();
            $table->bigInteger('damage_i_have_forbidden_partner_friends_id')->unsigned();
            $table->bigInteger('damage_i_have_physically_hurt_partner_id')->unsigned();
            $table->bigInteger('damage_it_bothers_my_partner_spends_money_id')->unsigned();
            $table->bigInteger('damage_i_have_required_my_partner_spends_id')->unsigned();
            $table->bigInteger('damage_i_have_told_my_partner_is_ugly_id')->unsigned();

            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('frequency_my_partner_told_me_grooming_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_pushed_me_hard_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_gets_angry_what_wants_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_criticizes_me_lover_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_rejects_have_sex_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_monitors_everything_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_said_ugly_unattractive_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_take_account_sexual_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_forbids_friends_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_uses_money_control_me_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_hit_something_scare_me_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_threatened_leave_me_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_afraid_partner_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_has_forced_have_sex_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_upset_successes_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_has_hit_me_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_forbids_work_studying_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_verbally_assaults_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_angry_children_should_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_angry_tell_money_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_gets_upset_food_works_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_gets_jealous_friends_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_manages_money_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_blackmails_me_money_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_has_come_insult_me_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_financially_angry_id')->references('id')->on('details');
            $table->foreign('frequency_my_partner_made_fun_some_part_body_id')->references('id')->on('details');
            $table->foreign('frequency_ive_told_hes_blame_our_problems_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_come_yell_partner_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_angry_contradicts_disagrees_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_come_insult_my_partner_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_threatened_partner_leave_id')->references('id')->on('details');
            $table->foreign('frequency_when_he_verbally_attack_my_partner_id')->references('id')->on('details');
            $table->foreign('frequency_i_take_sexual_needs_partner_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_forbidden_partner_friends_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_physically_hurt_partner_id')->references('id')->on('details');
            $table->foreign('frequency_it_bothers_my_partner_spends_money_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_required_my_partner_spends_id')->references('id')->on('details');
            $table->foreign('frequency_i_have_told_my_partner_is_ugly_id')->references('id')->on('details');


            $table->foreign('damage_my_partner_told_me_grooming_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_pushed_me_hard_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_gets_angry_what_wants_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_criticizes_me_lover_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_rejects_have_sex_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_monitors_everything_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_said_ugly_unattractive_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_take_account_sexual_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_forbids_friends_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_uses_money_control_me_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_hit_something_scare_me_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_threatened_leave_me_id')->references('id')->on('details');
            $table->foreign('damage_i_have_afraid_partner_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_has_forced_have_sex_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_upset_successes_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_has_hit_me_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_forbids_work_studying_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_verbally_assaults_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_angry_children_should_id')->references('id')->on('details');
            $table->foreign('damage_my_partner_angry_tell_money_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_gets_upset_food_works_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_gets_jealous_friends_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_manages_money_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_blackmails_me_money_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_has_come_insult_me_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_financially_angry_id')->references('id')->on('details');
            // $table->foreign('damage_my_partner_made_fun_some_part_body_id')->references('id')->on('details');
            // $table->foreign('damage_ive_told_hes_blame_our_problems_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_come_yell_partner_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_angry_contradicts_disagrees_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_come_insult_my_partner_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_threatened_partner_leave_id')->references('id')->on('details');
            // $table->foreign('damage_when_he_verbally_attack_my_partner_id')->references('id')->on('details');
            // $table->foreign('damage_i_take_sexual_needs_partner_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_forbidden_partner_friends_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_physically_hurt_partner_id')->references('id')->on('details');
            // $table->foreign('damage_it_bothers_my_partner_spends_money_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_required_my_partner_spends_id')->references('id')->on('details');
            // $table->foreign('damage_i_have_told_my_partner_is_ugly_id')->references('id')->on('details');

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
        Schema::dropIfExists('violence');
    }
}
