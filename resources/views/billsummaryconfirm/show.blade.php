<?php
  /*
    Pratik
    Date:11-09-18
  */
    error_reporting(0);
?>

@extends('layouts.master')
@section('content')
@php
    $confirmRoute = route($route.'.update',$billsummary[0]->bill_no);
@endphp
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
                  <form id="frm_single" action="{{ $confirmRoute }}" method="post" class="form-horizontal form-label-left">
                    <input type="hidden" name="id" id="id" value="{{ $billsummary[0]->id }}" />
                    <input type="hidden" name="bill_no" id="bill_no" value="{{ $billsummary[0]->bill_no }}" />
                    @method('PUT')
                        @csrf


                      <?php /* <div class="form-group">
                            <label class=" col-md-3 col-sm-3 col-xs-12" > View Vendor Invoice :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a value="{{ $billsummary[0]->bill_no }}" href="{{url('showVendorInvoice/'.$billsummary[0]->bill_no)}}" target="_blank"  class="btn {{ ($viewSummaryDetail->vendorinvoiceid == '1') ? 'btn-success' : 'btn-info' }} btn-sm vendor_invoice_btn"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div> */ ?>
                                              <div class="form-group">
                            <label class=" col-md-3 col-sm-3 col-xs-12" > View Parisishth B :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a value="{{ $billsummary[0]->bill_no }}" href="{{url('showparisishthb/'.$billsummary[0]->bill_no)}}" target="_blank" class="btn {{ ($viewSummaryDetail->parisishthab_id == '1') ? 'btn-success' : 'btn-info' }} btn-info btn-sm parisishthb_btn"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" col-md-3 col-sm-3 col-xs-12" > View Parisishth A :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a value="{{ $billsummary[0]->bill_no }}" href="{{url('showparisishthaa/'.$billsummary[0]->bill_no)}}" target="_blank" class="btn {{ ($viewSummaryDetail->parisishthaa_id == '1') ? 'btn-success' : 'btn-info' }} btn-info btn-sm parisishtha_btn"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" col-md-3 col-sm-3 col-xs-12" > Vendor <span class="error">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select disabled id="vendor_id" name="vendor_id"  class="form-control select2_single col-md-7 col-xs-12 vendor_id">
                                    <option value=""></option>
                                    @foreach($vendor as $key=>$val)
                                        <option {{ ($val->id == $billsummary[0]->vendor_id) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->vendor_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @php $dates = explode(",",$billsummary[0]->billing_period) @endphp
                        <div class="form-group">
                            <label class=" col-md-3 col-sm-3 col-xs-12" >Billing Period<span class="required">*</span>
                            </label>
                           
                              <div class=" col-md-3 col-sm-3 col-xs-12">

                                <input type="text" readonly name="from_date" id="from_date" class="form-control" value="{{date("d-m-Y",strtotime($dates[0]))}}" placeholder="From Date"  />

                            </div>

                            <div class=" col-md-3 col-sm-3 col-xs-12">

                                <input type="text" readonly name="to_date" id="to_date" class="form-control" value="{{date("d-m-Y",strtotime($dates[1]))}}" placeholder="To Date"  />

                            </div>
                        </div>

                        <div id="summayData">
                        <div class="table-responsive" style="width:100%;margin: 0 auto;">
                            <table border="1" class="table table-bordered dttable" cellspacing="0" style="width:1700px;">
                                <tr>
                                    <th style="text-align:center;">अ.क्र</th>
                                    <th style="text-align:center;">महामंडठ्ठाचा देयक क्र</th>
                                    <th style="text-align:center;">मार्ग (वेळापत्रक)</th>
                                    <th style="text-align:center;">पुरवठादाराने दिलेला देयक क्र</th>
                                    <th style="text-align:center;">पुरवठादाराने मागणी केलेली रक्कम रु</th>
                                    <th style="text-align:center;">महामंडठ्ठाने मंजुर केलेली ऐकूण रक्कम रु</th>
                                    <th style="text-align:center;">वसुली रक्कम रु</th>
                                    <th style="text-align:center;">Other Deductions</th>
                                    <th style="text-align:center;">Other Deductions Remarks</th>
                                    <th style="text-align:center;">60 % Deduction</th>
                                    <th style="text-align:center;">60 % Deduction Remarks</th>
                                   <!-- <th style="text-align:center;">Previous Deduction</th>
                                    <th style="text-align:center;">Previous Deduction Remarks</th> -->
                                    <th style="text-align:center;" width="10%">निव्व्ठ्ठ देय रक्कम</th>
                                </tr>
                                @php $total = 0; @endphp
                                @foreach($billsummary as $key=>$val)
                                <tr>
                                    <th style="text-align:center;">
                                        {{ $key+1 }}
                                    </th>

                                    <th style="text-align:center;"><input type="text" name="voucher_no[]" class="form-control" readonly value="{{ $val->gov_voucher_no }}" /></th>

                                    <th width="250px !important;" style="text-align:center;"><input type="text" class="form-control" readonly value="{{ $val->route->fromdepot->name.'-'.$val->route->todepot->name.' ('.$val->route->scheduled_number.' - '.$val->route->scheduled_time.')' }}" /></th>

                                    <th width="150px !important;" style="text-align:center;"><input type="text" class="form-control" readonly value="{{ isset($val->vendorinvoice->invoice_no) ? $val->vendorinvoice->invoice_no : '' }}" /></th>

                                    <th style="text-align:center;"><input type="text" name="vendor_invoice_amt[]" class="form-control" readonly value="{{ $val->vendorinvoice->grand_amount }}" /></th>

                                    <th style="text-align:center;"><input type="text" name="gov_approve_amt[]" class="form-control" readonly value="{{ $val->gov_approve_amt }}" /></th>

                                    <th style="text-align:center;"><input type="text" name="vendor_deduction_amt[]" class="form-control" readonly value="{{ $val->vendor_deduction_amt }}" /></th>

                                    <th style="text-align:center;"><input type="text" readonly name="other_deduction" id="other_deduction" class="form-control amountonly other_deduction" value="{{ $val->other_deduction }}" /></th>
                                        <th style="text-align:center;"><textarea rows="1" name="other_deduction_remark" readonly class="form-control">{{  $val->other_deduction_remark }}</textarea></th>
                                        <th width="150px !important;" style="text-align:center;"><input type="text" readonly name="per_deduction" id="per_deduction" class="form-control amountonly per_deduction" value="{{ $val->per_deduction }}"/></th>
                                        <th width="150px !important;" style="text-align:center;"><textarea rows="1" readonly name="per_deduction_remark" class="form-control">{{ $val->per_deduction_remark }}</textarea></th>
                                      <!-- <th style="text-align:center;">
                                          <input type="text" readonly name="prev_deduction" id="prev_deduction" class="form-control prev_deduction" value="{{ $val->prev_deduction }}" /></th>
                                        <th style="text-align:center;"><textarea readonly rows="1" name="prev_deduction_remark" class="form-control">{{ $val->prev_deduction_remark }}</textarea></th> -->

                                    <th style="text-align:center;"><input type="text" name="final_payable_amt[]" class="form-control" readonly value="{{ $val->final_payable_amt }}" /></th>
                                </tr>
                                @php $total += $val->final_payable_amt; @endphp
                                @endforeach
                                <tr>
                                <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th style="text-align:center;" colspan="2">ऐकुण रक्कम रु</th>

                                    <th><input type="text" class="form-control" id="finalAmount" readonly value="{{ $total }}" /></th>
                                </tr>
                                <tr>
                                    <th colspan="8"></th>
                                    <th><textarea placeholder="Enter Vendor Previous Deduction Remarks" id="vendor_previous_deduction_remarks" name="vendor_previous_deduction_remarks" disabled>{{ $billsummary[0]->vendor_previous_deduction_remarks }}</textarea> </th>
                                    <th  colspan="2">Vendor Previous Deduction</th>
                                    <th><input type="text" readonly class="form-control vendor_deduction amountonly" id="vendor_deduction" name="vendor_deduction"  value="{{ $billsummary[0]->vendor_deduction }}" /></th>
                                </tr>
                                <label id="vendor_deduction-error" class="error" for="vendor_id"></label>
                                <tr>
                                    <th colspan="8"></th>
                                    <th><textarea placeholder="Enter Vendor Reimbursement Remarks"   id="vendor_reimbursement_remark" name="vendor_reimbursement_remark" disabled>{{ $billsummary[0]->vendor_reimbursement_remark }}</textarea> </th>
                                    <th colspan="2">Vendor Reimbursement</th>
                                    <th><input type="text" readonly class="form-control vendor_reimbursement amountonly" id="vendor_reimbursement" name="vendor_reimbursement"  value="{{ $billsummary[0]->vendor_reimbursement }}" /></th>
                                </tr>
                                <label id="vendor_reimbursement-error" class="error" for="vendor_reimbursement"></label>
                                <tr>
                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th style="text-align:center;" colspan="2">TDS</th>
                                    <th ><input type="text" class="form-control" id="tds" readonly value="{{ $billsummary[0]->tds }}" /></th>
                                </tr>
                                <tr>
                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th style="text-align:center;" colspan="2">Grand Total</th>
                                    <th ><input type="text" class="form-control" id="amountafter_tds" readonly value="{{ $billsummary[0]->amount_after_tds }}" /></th>
                                </tr>
                            </table>
                            </div>
                        <div class="ln_solid"></div>

                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a href="{{url("/$route")}}"  class="btn btn-warning" >Cancel </a>
                            @if($confirmStatus == '0')
                                @if($viewSummaryDetail->parisishthaa_id == '1' && $viewSummaryDetail->parisishthab_id == '1')
                                <input type="submit" class="btn btn-success" value="Confirm" />
                                <a class="btn btn-danger" data-backdrop="static" data-toggle="modal" data-id="insert" id="query" data-target="#AddEditModal">Query</a>
                                @endif
                            @endif
                           </div>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddEditModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <button type="button" class="close"
                  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
               Remarks
                </h4>
              </div>
              <!-- Modal Body -->
              <div class="modal-body">
                <form class="form-horizontal" id="frm" method="POST" action="insertremarks" autocomplete="off">
                 @csrf
                  <input type="hidden" name="bill_no" id="bill_no" value="{{$billsummary[0]->bill_no}}" />
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Remark<span class="required"> *</span></label>
                  <div class="col-sm-9">
                    <textarea name="remarks" rows="10" cols="350" style="width:350px !important;"></textarea>
                  </div>
                </div>
                <div class="form-group">
                <label  class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <input type="submit" id="form_btn"   value="Submit" class="btn  btn-primary"/>
                    <button type="button" name="btn_close" class="cancle btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
      </div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function($) {
    $('body').on('click','.vendor_invoice_btn',function(e){
        var id = $(this).attr('value');
        $.ajax({
            type:'POST',
            url:'{{url('vendorconfirmsummary')}}',
            data:{
                id:id,
            },
            success:function(result){
                window.location.reload(true);
            }
        });
    });

    $('body').on('click','.parisishthb_btn',function(e){
        var id = $(this).attr('value');
        $.ajax({
            type:'POST',
            url:'{{url('paribconfirmsummary')}}',
            data:{
                id:id,
            },
            success:function(result){
                window.location.reload(true);
            }
        });
    });

    $('body').on('click','.parisishtha_btn',function(e){
        var id = $(this).attr('value');
        $.ajax({
            type:'POST',
            url:'{{url('pariaconfirmsummary')}}',
            data:{
                id:id,
            },
            success:function(result){
                window.location.reload(true);
            }
        });

    });
    $('#frm').validate({
    errorClass: 'errors',
    rules:
    {
        remarks:{
        required: true,
        maxlength:50,
      },
    },
    messages:
    {
        remarks:{
        required: "Please Enter Remarks",
      },
    },
    submitHandler: function(form) {
      $(this).find(':input[type=submit]').prop('disabled', true);
      form.submit();
    },
    errorPlacement: function(error, element){
      error.appendTo(element.parent("div"));
    },
  });

});
</script>
@endsection
