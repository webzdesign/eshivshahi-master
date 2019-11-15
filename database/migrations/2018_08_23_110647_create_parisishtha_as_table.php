<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParisishthaAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parisishtha_as', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parisishtha_b_id');
            $table->unsignedInteger('depot_id');
            $table->string('billing_period');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('vendorinvoice_id');
            $table->string('voucher_no');
            $table->date('voucher_date');
            $table->unsignedInteger('vehicle_id');
            $table->string('total_kms');
            $table->string('avg_kms');
            $table->string('per_km_rate');
            $table->float('amount',10,2);
            $table->float('total_amount',10,2);
            $table->string('avg_km_as_per_contract');
            $table->float('avg_km_total_as_per_contract',10,2);
            $table->float('rate_for_avg_km',10,2);
            $table->float('amount_for_avg_km',10,2);
            $table->float('total_amount_for_avg',10,2);
            $table->float('extra_diesel_amt',10,2);
            $table->float('vehical_exp',10,2);
            $table->float('other_exp',10,2);
            $table->float('parking_charge',10,2);
            $table->float('total_tax',10,2);
            $table->float('total_deduct',10,2);
            $table->float('amount_payable',10,2);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('depot_id')->references('id')->on('depots');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('vendorinvoice_id')->references('id')->on('vendorinvoices');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('parisishtha_b_id')->references('id')->on('parisishtha_bs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parisishtha_as');
    }
}
