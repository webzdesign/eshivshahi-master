<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendorinvoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vendor_id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('billing_period');
            $table->unsignedInteger('division_id');
            $table->unsignedInteger('depot_id');
            $table->unsignedInteger('vehicle_id');
            $table->longText('date');
            $table->longText('route');
            $table->longText('kms');
            $table->longText('rate');
            $table->longText('amount');
            $table->longText('remark');
            $table->float('total_kms',8,2);
            $table->float('total_amount',8,2);
            $table->boolean('is_approved')->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('depot_id')->references('id')->on('depots');
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendorinvoices');
    }
}
