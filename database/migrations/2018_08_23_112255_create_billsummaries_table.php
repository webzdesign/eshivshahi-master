<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billsummaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parisishtha_a_id');
            $table->string('gov_voucher_no');
            $table->unsignedInteger('vehicle_id');
            $table->unsignedInteger('vendorinvoice_id');
            $table->float('vendor_invoice_amt',10,2);
            $table->float('gov_approve_amt',10,2);
            $table->float('vendor_deduction_amt',10,2);
            $table->float('final_payable_amt',10,2);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('parisishtha_a_id')->references('id')->on('parisishtha_as');
            $table->foreign('vendorinvoice_id')->references('id')->on('vendorinvoices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billsummaries');
    }
}
