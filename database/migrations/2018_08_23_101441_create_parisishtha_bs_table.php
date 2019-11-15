<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParisishthaBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parisishtha_bs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('depot_id');
            $table->string('billing_period');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('vendorinvoice_id');
            $table->string('voucher_no');
            $table->date('voucher_date');
            $table->unsignedInteger('vehicle_id');
            $table->longText('kms');
            $table->longText('diesel_ltr');
            $table->longText('diese_per_ltr_price');
            $table->longText('adblue');
            $table->longText('adblue_price');
            $table->longText('breaddown_charge');
            $table->longText('vor_exp');
            $table->longText('parking_exp');
            $table->longText('hault_tax');
            $table->float('other_exp',10,2);
            $table->string('total_km');
            $table->string('diesel_as_per_gov');
            $table->string('extra_filled_diesel');
            $table->string('extra_diesel_charged');
            $table->boolean('is_vendor_confirm')->default(0);
            $table->boolean('is_parisishtha_a_created')->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('depot_id')->references('id')->on('depots');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('vendorinvoice_id')->references('id')->on('vendorinvoices');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parisishtha_bs');
    }
}
