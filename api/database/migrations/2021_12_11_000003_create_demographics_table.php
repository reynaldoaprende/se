<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demographics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("family_id")->nullable()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->integer('age');
            $table->bigInteger('document_type_id')->unsigned();
            $table->string('document');
            $table->bigInteger('gender_id')->unsigned();
            $table->bigInteger('birthdate_place_id')->unsigned();
            $table->date('birthdate');
            $table->bigInteger('civil_status_id')->unsigned();
            $table->string("occupation");
            $table->bigInteger("scholarship_id")->unsigned();
            // $table->string("city");
            $table->bigInteger('city_id')->unsigned();
            $table->string("email");
            $table->string("socioeconomic");
            $table->bigInteger("pandemic_affectation_way_id")->unsigned();
            $table->boolean("sick_covid");
            $table->boolean("vaccinate_covid");
            $table->boolean("relative_covid");
            $table->bigInteger("applied_vaccine_id")->nullable()->unsigned();
            $table->boolean("full_dose")->nullable();
            $table->bigInteger("reason_not_vaccinated_id")->nullable()->unsigned();
            $table->boolean("disability");
            $table->bigInteger("disability_type_id")->nullable()->unsigned();
            $table->bigInteger("psychoactive_substances_id")->unsigned();
            $table->bigInteger("symptoms_last_week_id")->unsigned()->nullable();
            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('birthdate_place_id')->references('id')->on('locations');
            $table->foreign('city_id')->references('id')->on('locations');

            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('document_type_id')->references('id')->on('details');
            $table->foreign('gender_id')->references('id')->on('details');
            $table->foreign('civil_status_id')->references('id')->on('details');
            $table->foreign('scholarship_id')->references('id')->on('details');
            $table->foreign('pandemic_affectation_way_id')->references('id')->on('details');
            $table->foreign('applied_vaccine_id')->references('id')->on('details');
            $table->foreign('reason_not_vaccinated_id')->references('id')->on('details');
            $table->foreign('disability_type_id')->references('id')->on('details');
            $table->foreign('psychoactive_substances_id')->references('id')->on('details');
            $table->foreign('symptoms_last_week_id')->references('id')->on('details');
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
        Schema::dropIfExists('demographics');
    }
}
