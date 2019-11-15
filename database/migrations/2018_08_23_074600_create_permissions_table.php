<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usertype_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('module_id');
            $table->boolean('create')->default(0);
            $table->boolean('view')->default(0);
            $table->boolean('approve_disapprove')->default(0);
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('usertype_id')->references('id')->on('usertypes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
