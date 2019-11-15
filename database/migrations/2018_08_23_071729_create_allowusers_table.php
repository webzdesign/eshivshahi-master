<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllowusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowusers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usertype_id');
            $table->unsignedInteger('accesstype_id');
            $table->unsignedInteger('no_of_users');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('usertype_id')->references('id')->on('usertypes');
            $table->foreign('accesstype_id')->references('id')->on('accesstypes');
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
        Schema::dropIfExists('allowusers');
    }
}
