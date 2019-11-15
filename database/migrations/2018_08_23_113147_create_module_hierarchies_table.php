<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleHierarchiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_hierarchies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id');
            $table->unsignedInteger('usertype_id');
            $table->unsignedInteger('type');
            $table->unsignedInteger('hierarchy_sequence');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('usertype_id')->references('id')->on('usertypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_hierarchies');
    }
}
