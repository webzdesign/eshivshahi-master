<?php

  /*

    Pratik

    Date:10-09-18

  */



?>



@extends('layouts.master')

@section('content')

    @if($action=='insert')

         @php

            $btn = 'Save';

            $formUrl = route('billsummary.store');

        @endphp

    @elseif($action=='update')

         @php

            $btn = 'Update';

            $formUrl = route('billsummary.update',$result[0]->id);

         @endphp

    @endif



<div class="right_col" role="main">

          <div class="">

            <div class="page-title">

              <div class="title_left">



              </div>

              <div class="title_right">



              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>{{ $modulename }}</h2>

                    <div class="clearfix"></div>

                  </div>



                  <div class="x_content">

                  <form id="frm_single" method="post"  action="{{ $formUrl }}"   class="form-horizontal form-label-left" autocomplete="off">

                  @if($action=='update')

                        @method('PUT')

                        <input type="hidden" name="id" value="{{$result[0]->id}}">

                  @endif

                             @csrf



                        <div class="form-group">

                            <label class=" col-md-3 col-sm-3 col-xs-12" > Select Vendor <span class="error">*</span>

                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <select id="vendor_id" name="vendor_id"  class="form-control select2_single col-md-7 col-xs-12 vendor_id">

                                    <option value=""></option>

                                    @foreach($vendor as $key=>$val)

                                        <option @if($action == 'update'){{ ($val->id == $result[0]->vendor_id) ? 'selected' : '' }} @endif value="{{ $val->id }}">{{ $val->vendor_name }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>



                        <?php /*<div class="form-group">

                            <label class=" col-md-3 col-sm-3 col-xs-12" > Select Vehicle<span class="error">*</span>

                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <select id="vehicle_id" name="vehicle_id"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id">

                                    <option value=""></option>

                                    @if($action == 'update')

                                        @foreach($vehicle as $key=>$val)

                                            <option {{ ($val->id == $result->vehicle_id) ? 'selected' : '' }}>{{ $val->vehicle_no }}</option>

                                        @endforeach

                                    @endif

                                </select>

                            </div>

                        </div> */ ?>

                        @if($action=='update' || $action=='view')

                            @php $dates = explode(",",$result[0]->billing_period) @endphp

                        @endif



                        <div class="form-group">

                            <label class=" col-md-3 col-sm-3 col-xs-12" >Billing Period<span class="required">*</span>

                            </label>

                            <div class=" col-md-3 col-sm-3 col-xs-12">

                                <input type="text" readonly name="from_date" id="from_date" class="datepicker form-control" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($dates[0]))}}@endif" @if($action == 'update' || $action == 'view') disabled @endif placeholder="From Date"  />

                            </div>

                            <div class=" col-md-3 col-sm-3 col-xs-12">

                                <input type="text" readonly name="to_date" id="to_date" class="datepicker form-control" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($dates[1]))}}@endif" @if($action == 'update' || $action == 'view') disabled @endif placeholder="To Date"  />

                            </div>

                        </div>



                        <div id="summayData">

                        <div class="table-responsive" style="width:100%;margin: 0 auto;">

                            <table border="1" class="table table-bordered dttable" cellspacing="0" style="width:1800px;">

                                <tr>

                                    <th style="text-align:center;">अ.क्र</th>

                                    <th width="150px !important;" style="text-align:center;">महामंडठ्ठाचा देयक क्र</th>

                                    <th width="310px !important;" style="text-align:center;">मार्ग (वेळापत्रक)</th>

                                    <th style="text-align:center;">पुरवठादाराने दिलेला देयक क्र</th>

                                    <th style="text-align:center;">पुरवठादाराने मागणी केलेली रक्कम रु</th>

                                    <th style="text-align:center;">महामंडठ्ठाने मंजुर केलेली ऐकूण रक्कम रु</th>

                                    <th style="text-align:center;">वसुली रक्कम रु</th>

                                    <th style="text-align:center;">Other Deductions</th>

                                    <th width="140px !important;" style="text-align:center;">Other Deductions Remarks</th>

                                    <th width="150px !important;" style="text-align:center;">60 % Deduction</th>

                                    <th width="150px !important;" style="text-align:center;">60 % Deduction Remarks</th>

                                 <!-- <th style="text-align:center;">Previous Deduction</th>

                                    <th style="text-align:center;">Previous Deduction Remarks</th> -->

                                    <th style="text-align:center;" width="10%">निव्व्ठ्ठ देय रक्कम</th>

                                </tr>



                                @if($action == 'update')

                                @php

                                    $total = 0;

                                @endphp

                                <?php //echo count($parisishthaa);// echo"<pre>";print_r($val);exit; ?>

                                @foreach($result as $k=> $val)

                                <?php //echo"<pre>";print_r($val);exit; ?>

                                    <tr>

                                        <th style="text-align:center;">

                                        <input type="hidden" id="parisishtha_a_id[]" name="parisishtha_a_id[]" class="form-control parisishtha_a_id" value="{{ $val->parisishtha_a_id}}" />



                                        <input type="hidden" id="parisishtha_b_id[]" name="parisishtha_b_id[]" class="form-control parisishtha_b_id" value="{{ $val->parisishtha_b_id }}" />



                                        <input type="hidden" id="vehicle_id[]" name="vehicle_id[]" class="form-control" value="{{ $val->vehicle_id }}" />

                                        <input type="hidden" id="vendorinvoice_id[]" name="vendorinvoice_id[]" class="form-control" value="{{ $val->vendorinvoice_id }}" />



                                        {{ $k+1 }}</th>

                                        <th style="text-align:center;"><input type="text" name="voucher_no[]" class="form-control" readonly value="{{ $val->parisisthab->voucher_no }}" /></th>



                                        <th style="text-align:center;"><input type="text" class="form-control" readonly value="{{ $val->route->fromdepot->name.'-'.$val->route->todepot->name.' ('.$val->route->scheduled_number.' - '.$val->route->scheduled_time.')' }}" /></th>



                                        <th style="text-align:center;"><input type="text" class="form-control" readonly value="{{ isset($val->vendorinvoice->invoice_no) ? $val->vendorinvoice->invoice_no : '' }}" /></th>



                                        <th style="text-align:center;"><input type="text" name="vendor_invoice_amt[]" class="form-control" readonly value="{{ isset($val->vendorinvoice->grand_amount) ? $val->vendorinvoice->grand_amount : '' }}" /></th>



                                        <th style="text-align:center;"><input type="text" name="gov_approve_amt[]" id="gov_approve_amt" class="form-control gov_approve_amt" readonly value="{{ $val->gov_approve_amt }}" /></th>



                                        <th style="text-align:center;"><input type="text" name="vendor_deduction_amt[]" id="vendor_deduction_amt" class="form-control vendor_deduction_amt" readonly value="{{ $val->vendor_deduction_amt }}" /></th>







                                        <th style="text-align:center;"><input type="text" name="other_deduction[]" id="other_deduction" class="form-control amountonly other_deduction" value="{{ $val->other_deduction }}" /></th>

                                        <th style="text-align:center;"><textarea rows="1" name="other_deduction_remark[]" class="form-control">{{  $val->other_deduction_remark }}</textarea></th>

                                        <th style="text-align:center;"><input type="text" name="per_deduction[]" id="per_deduction" class="form-control amountonly per_deduction" value="{{ $val->per_deduction }}"/></th>

                                        <th style="text-align:center;"><textarea rows="1" name="per_deduction_remark[]" class="form-control">{{ $val->per_deduction_remark }}</textarea></th>

                                    <!-- <th style="text-align:center;"><input type="text" name="prev_deduction[]" id="prev_deduction" class="form-control prev_deduction" value="{{ $val->prev_deduction }}" /></th>

                                        <th style="text-align:center;"><textarea rows="1" name="prev_deduction_remark[]" class="form-control">{{ $val->prev_deduction_remark }}</textarea></th> -->


                                        <th style="text-align:center;"><input type="text" name="final_payable_amt[]" id="final_payable_amt" class="form-control final_payable_amt" readonly value="{{ $val->final_payable_amt }}" /></th>

                                    </tr>

                                    @php

                                        $total += $val->final_payable_amt;

                                    @endphp

                                @endforeach

                                <tr>

                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>

                                    <th style="" colspan="2">ऐकुण रक्कम रु</th>


                                    <th><input type="text" class="form-control finalAmount" id="finalAmount" name="finalAmount" readonly value="{{ $total }}" /></th>

                                </tr>

                                <tr>

                                    <th colspan="8"></th>
                                    <th> <textarea placeholder="Enter Vendor Previous Deduction Remarks"   id="vendor_previous_deduction_remarks" name="vendor_previous_deduction_remarks">{{ $result[0]->vendor_previous_deduction_remarks }}</textarea> </th>
                                    <th  colspan="2">Vendor Previous Deduction</th>

                                    <th><input type="text" class="form-control vendor_deduction amountonly" id="vendor_deduction" name="vendor_deduction"  value="{{ $result[0]->vendor_deduction }}" /></th>

                                </tr>

                                <label id="vendor_deduction-error" class="error" for="vendor_id"></label>

                                <tr>

                                    <th colspan="8"></th>
                                    <th> <textarea placeholder="Enter Vendor Reimbursement Remarks"   id="vendor_reimbursement_remark" name="vendor_reimbursement_remark">{{ $result[0]->vendor_reimbursement_remark }}</textarea> </th>
                                    <th colspan="2">Vendor Reimbursement</th>

                                    <th ><input type="text" class="form-control vendor_reimbursement amountonly" id="vendor_reimbursement" name="vendor_reimbursement"  value="{{ $result[0]->vendor_reimbursement }}" /></th>

                                </tr>

                                <label id="vendor_reimbursement-error" class="error" for="vendor_reimbursement"></label>

                                <tr>

                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th colspan="2">TDS</th>

                                    <th ><input type="text" class="form-control tds" id="tds" name="tds"  value="{{ $result[0]->tds }}" /></th>

                                </tr>

                                <tr>

                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th colspan="2">Grand Total</th>

                                    <th ><input type="text" class="form-control amountafter_tds" id="amountafter_tds" name="amountafter_tds" readonly value="{{ $result[0]->amount_after_tds }}" /></th>

                                </tr>



                                @else

                                    <tr>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                      <!-- <th></th>

                                        <th></th> -->

                                    </tr>

                                @endif

                            </table>

                            </div>

                        </div>

                        <div class="ln_solid"></div>



                        <div class="form-group">

                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                           <input type="hidden" name="publish_flag" id="publish_flag" value="" />

                            <a href="{{url("/$route")}}"  class="btn btn-warning" >Cancel </a>



                            <button type="submit" onclick="setFlag(0)" class="btn btn-primary">{{ $btn }}</button>

                            <button type="submit"  onclick="setFlag(1)" class="btn btn-primary">{{ $btn }} And Submit</button>

                           </div>

                      </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



@endsection

@section('script')

<script type="text/javascript">

jQuery(document).ready(function($){



    function totalFunction(){

        var payAmount = $(".final_payable_amt").map(function(){return $(this).val();}).get().join(",");
		var finalPayAmount = payAmount;
		arrpayAmount = finalPayAmount.split(',');
		var totalamount=0;
		for(i=0; i < arrpayAmount.length; i++)
		{
			if(arrpayAmount[i]!='')
			{
				totalamount += parseFloat(arrpayAmount[i]);
			}
		}

		if(isNaN(totalamount) || totalamount == '')
        {
            totalamount=0;
        }
        $('body').find('#finalAmount').val(totalamount.toFixed(2));
    }

    $('body').on('keyup','.tds, .vendor_deduction, .vendor_reimbursement',function(e){

        var tds =  $("#tds").val();
        var finalamount = $("#finalAmount").val();
        var vendor_deduction = $("#vendor_deduction").val();
        var vendor_reimbursement = $("#vendor_reimbursement").val();

        if(isNaN(tds) || tds == ''){
            tds = 0;
        }

        if(isNaN(finalamount) || finalamount == ''){
            finalamount = 0;
        }

        if(isNaN(vendor_deduction) || vendor_deduction == ''){
            vendor_deduction = 0;
        }

        if(isNaN(vendor_reimbursement) || vendor_reimbursement == ''){
            vendor_reimbursement = 0;
        }

        var amt_after_tds = parseFloat(finalamount) - parseFloat(vendor_deduction) + parseFloat(vendor_reimbursement) - parseFloat(tds);

        $("input[name='amountafter_tds']").val(amt_after_tds);
    });


    $('body').on('keyup', '#other_deduction,#per_deduction,#prev_deduction',function(e){

        var other_deduction = $(this).closest('tr').find('#other_deduction').val();
        var per_deduction = $(this).closest('tr').find('#per_deduction').val();
        var prev_deduction = $(this).closest('tr').find('#prev_deduction').val();
        var gov_approve_amt = $(this).closest('tr').find('#gov_approve_amt').val();
        var vendor_deduction_amt = $(this).closest('tr').find('#vendor_deduction_amt').val();

        if(isNaN(other_deduction) || other_deduction ==''){
            other_deduction = 0;
        }

        if(isNaN(per_deduction) || per_deduction ==''){
            per_deduction = 0;
        }

        if(isNaN(prev_deduction) || prev_deduction ==''){
            prev_deduction = 0;
        }

        if(isNaN(gov_approve_amt) || gov_approve_amt ==''){
            gov_approve_amt = 0;
        }

        if(isNaN(vendor_deduction_amt) || vendor_deduction_amt ==''){
            vendor_deduction_amt = 0;
        }

        var total = parseFloat(gov_approve_amt)-parseFloat(vendor_deduction_amt)-parseFloat(other_deduction)-parseFloat(per_deduction)-parseFloat(prev_deduction);

        if(isNaN(total) || total == ''){
            total = 0;
        }

        $(this).closest('tr').find('#final_payable_amt').val(total);
        totalFunction();
        $('.tds').trigger('keyup');
    });

    $("body").on("change","#vendor_id",function(){
        var vendor_id =  $("#vendor_id").val();

        $.ajax({
            type:'POST',
            url:'{{ url('getvehicleData') }}',
            data:{
                vendor_id:vendor_id
            },
            success:function(result){
                $("#vehicle_id").empty().html(result);
            }
        });
    });


    $("body").on("change","#vendor_id,#from_date,#to_date",function(){

        var vendor_id = $("#vendor_id").val();
        var from_date = $("#from_date").val();
        var to_date = $('#to_date').val();

        if(vendor_id == '' || from_date == '' || to_date == ''){
            return false;
        }else{
            $.ajax({
                type:'POST',
                url:'{{url('getBillSummay')}}',
                data:{
                    vendor_id:vendor_id,
                    from_date:from_date,
                    to_date:to_date
                },
                success:function(result){
                    $("#summayData").empty().html(result);
                    $(".vendor_deduction").trigger('keyup');
                }

            });
        }
    });



    $('#frm_single').validate({
        rules:
        {
            vendor_id:{required: true,},
            vehicle_id:{required: true,},
            approvalStatus:{required: true,},
        },
        messages:
        {
            vendor_id:{required:"Please Select Vendor",},
            vehicle_id:{required:"Please Select Vehicle",},
            approvalStatus:{required:"Please Select Approval Or not.",},
        },
        errorPlacement: function(error, element) {
			error.appendTo(element.parent("div"));
		},
    });

    $('#frm_single').on('submit', function(e){
		e.preventDefault();
		var form = this;
		if($("#frm_single").valid() )
		{
            var dataCheck = $("#finalAmount").val();
            if(dataCheck == 0){
                alert("Bill Not Available.");
                return false;
            }else{
                var publishFlag = $('#publish_flag').val();
                if(publishFlag == 1){
                    var parisishtha_a_id =$(".parisishtha_a_id").map(function(){return $(this).val();}).get().join(",");

                    var parisishtha_b_id =$(".parisishtha_b_id").map(function(){return $(this).val();}).get().join(",");

                    $.ajax({
                        type:'POST',
                        url:'{{url('/checkinvoiceab')}}',
                        data:{
                            parisishtha_a_id:parisishtha_a_id,parisishtha_b_id:parisishtha_b_id
                        },
                        success:function(res){
                            if(res == '1'){

                                alert("Please Save And Submit From Parisishth A And B.")

                            }else{
                                $(':input[type="submit"]').prop('disabled', true);
                                form.submit();
                            }
                        }
                    });

                }else{

                    $(':input[type="submit"]').prop('disabled', true);
                    form.submit();
                }
            }
        }else{

            return false;

        }
    });
});

jQuery.validator.addMethod("jquerynumber", function(value, element) {
    return this.optional(element) || /^[0-9]+$/i.test(value);
});

function setFlag(p){
    $("#publish_flag").val(p);
}

</script>

@endsection