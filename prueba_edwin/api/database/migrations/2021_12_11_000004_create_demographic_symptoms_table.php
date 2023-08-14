<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemographicSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demographic_symptoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("demographic_id")->unsigned();
            $table->bigInteger("symptoms_last_week_id")->unsigned();

            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('demographic_id')->references('id')->on('demographics');
            $table->foreign('symptoms_last_week_id')->references('id')->on('details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demographic_symptoms');
    }
}
