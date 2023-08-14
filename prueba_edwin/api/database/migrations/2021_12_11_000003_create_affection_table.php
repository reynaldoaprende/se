<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger("many_times_feel_nervous_id")->unsigned();
        $table->bigInteger("feel_confident_in_life_id")->unsigned();
        $table->bigInteger("im_brave_id")->unsigned();
        $table->bigInteger("feel_tired_last_months_id")->unsigned();
        $table->bigInteger("worried_last_times_id")->unsigned();
        $table->bigInteger("have_determination_want_it_id")->unsigned();
        $table->bigInteger("feel_guilt_did_past_id")->unsigned();
        $table->bigInteger("appasionate_things_i_do_id")->unsigned();
        $table->bigInteger("many_situations_happiness_recent_times_id")->unsigned();
        $table->bigInteger("angry_when_contradict_me_id")->unsigned();
        $table->bigInteger("people_say_moody_id")->unsigned();
        $table->bigInteger("lately_been_situations_angry_id")->unsigned();
        $table->bigInteger("general_feel_strong_id")->unsigned();
        $table->bigInteger("pleasure_experiences_new_things_id")->unsigned();
        $table->bigInteger("feel_satisfied_myself_id")->unsigned();
        $table->bigInteger("irritated_easily_id")->unsigned();
        $table->bigInteger("im_brave_faced_challenge_id")->unsigned();
        $table->bigInteger("im_happy_person_id")->unsigned();
        $table->bigInteger("recent_times_felt_humiliated_id")->unsigned();
        $table->bigInteger("feeling_sad_lately_id")->unsigned();


            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign("many_times_feel_nervous_id")->references('id')->on('details');
        $table->foreign("feel_confident_in_life_id")->references('id')->on('details');
        $table->foreign("im_brave_id")->references('id')->on('details');
        $table->foreign("feel_tired_last_months_id")->references('id')->on('details');
        $table->foreign("worried_last_times_id")->references('id')->on('details');
        $table->foreign("have_determination_want_it_id")->references('id')->on('details');
        $table->foreign("feel_guilt_did_past_id")->references('id')->on('details');
        $table->foreign("appasionate_things_i_do_id")->references('id')->on('details');
        $table->foreign("many_situations_happiness_recent_times_id")->references('id')->on('details');
        $table->foreign("angry_when_contradict_me_id")->references('id')->on('details');
        $table->foreign("people_say_moody_id")->references('id')->on('details');
        $table->foreign("lately_been_situations_angry_id")->references('id')->on('details');
        $table->foreign("general_feel_strong_id")->references('id')->on('details');
        $table->foreign("pleasure_experiences_new_things_id")->references('id')->on('details');
        $table->foreign("feel_satisfied_myself_id")->references('id')->on('details');
        $table->foreign("irritated_easily_id")->references('id')->on('details');
        $table->foreign("im_brave_faced_challenge_id")->references('id')->on('details');
        $table->foreign("im_happy_person_id")->references('id')->on('details');
        $table->foreign("recent_times_felt_humiliated_id")->references('id')->on('details');
        $table->foreign("feeling_sad_lately_id")->references('id')->on('details');

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
