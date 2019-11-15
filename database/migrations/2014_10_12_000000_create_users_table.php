<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('division_id');
            $table->unsignedInteger('depot_id');
            $table->unsignedInteger('usertype_id');
            $table->unsignedInteger('accesstype_id');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('depot_id')->references('id')->on('depots');
            $table->foreign('usertype_id')->references('id')->on('usertypes');
            $table->foreign('accesstype_id')->references('id')->on('accesstypes');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
