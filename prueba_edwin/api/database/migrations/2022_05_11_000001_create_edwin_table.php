<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdwinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edwin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('xxxx_id')->unsigned();
            $table->bigInteger('yyyy_id')->unsigned();

            $table->bigInteger('created_user_at')->unsigned();
            $table->bigInteger('deleted_user_at')->unsigned()->nullable();
            $table->bigInteger('updated_user_at')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at');

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('xxxx_id')->references('id')->on('details');
            $table->foreign('yyyy_id')->references('id')->on('details');

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
        Schema::dropIfExists('edwin');
    }
}
