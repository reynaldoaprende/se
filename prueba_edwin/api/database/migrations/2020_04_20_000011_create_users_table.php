<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('document')->unsigned();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('enabled')->nullable();
            
    
            $table->bigInteger('created_user_at')->nullable();
            $table->bigInteger('deleted_user_at')->nullable();
            $table->bigInteger('updated_user_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('last_form_code')->nullable();
            $table->bigInteger('consent_id')->unsigned();
            $table->date('consent_date')->nullable();

            
            $table->rememberToken();

            // $table->foreign('gender_id')
            //         ->references('id')
            //         ->on('details')
            //         ->onDelete('cascade');

            // $table->foreign('document_type_id')
            //         ->references('id')
            //         ->on('details')
            //         ->onDelete('cascade');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
