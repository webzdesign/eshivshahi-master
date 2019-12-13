<?php

  /*

    Pratik

    Date:11-09-18

  */



?>



@extends('layouts.master')

@section('content')

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

                  <form id="frm_single" method="post" class="form-horizontal form-label-left">

                             @csrf

                        <div class="form-group">

                            <label class=" col-md-3 col-sm-3 col-xs-12" > Select Vendor <span class="error">*</span>

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

                            <table border="1" class="table table-bordered dttable" cellspacing="0" style="width:1800px;">

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

                                 <!--   <th style="text-align:center;">Previous Deduction</th>

                                    <th style="text-align:center;">Previous Deduction Remarks</th> -->

                                    <th style="text-align:center;" width="10%">निव्व्ठ्ठ देय रक्कम</th>

                                </tr>

                                @foreach($billsummary as $key=>$val)

                                <tr>

                                    <th style="text-align:center;">

                                        {{ $key+1 }}

                                    </th>



                                    <th style="text-align:center;"><input type="text" name="voucher_no[]" class="form-control" readonly value="{{ $val->gov_voucher_no }}" /></th>



                                    <th width="300px !important;" style="text-align:center;"><input type="text" class="form-control" readonly value="{{ $val->route->fromdepot->name.'-'.$val->route->todepot->name.' ('.$val->route->scheduled_number.' - '.$val->route->scheduled_time.')' }}" /></th>



                                    <th width="150px !important;" style="text-align:center;"><input type="text" class="form-control" readonly value="{{ isset($val->vendorinvoice->invoice_no) ? $val->vendorinvoice->invoice_no : '' }}" /></th>



                                    <th style="text-align:center;"><input type="text" name="vendor_invoice_amt[]" class="form-control" readonly value="{{ $val->vendorinvoice->grand_amount }}" /></th>



                                    <th style="text-align:center;"><input type="text" name="gov_approve_amt[]" class="form-control" readonly value="{{ $val->gov_approve_amt }}" /></th>



                                    <th style="text-align:center;"><input type="text" name="vendor_deduction_amt[]" class="form-control" readonly value="{{ $val->vendor_deduction_amt }}" /></th>



                                    <th style="text-align:center;"><input type="text" readonly name="other_deduction" id="other_deduction" class="form-control amountonly other_deduction" value="{{ $val->other_deduction }}" /></th>

                                        <th style="text-align:center;"><textarea rows="1" name="other_deduction_remark" readonly class="form-control">{{  $val->other_deduction_remark }}</textarea></th>

                                        <th width="150px !important;" style="text-align:center;"><input type="text" readonly name="per_deduction" id="per_deduction" class="form-control amountonly per_deduction" value="{{ $val->per_deduction }}"/></th>

                                        <th width="150px !important;" style="text-align:center;"><textarea rows="1" readonly name="per_deduction_remark" class="form-control">{{ $val->per_deduction_remark }}</textarea></th>

                                        <!--  <th style="text-align:center;"><input type="text" readonly name="prev_deduction" id="prev_deduction" class="form-control prev_deduction" value="{{ $val->prev_deduction }}" /></th>

                                        <th style="text-align:center;"><textarea readonly rows="1" name="prev_deduction_remark" class="form-control">{{ $val->prev_deduction_remark }}</textarea></th>  -->



                                    <th style="text-align:center;"><input type="text" name="final_payable_amt[]" class="form-control" readonly value="{{ $val->final_payable_amt }}" /></th>

                                </tr>
                                @php
                                $total += $val->final_payable_amt;
                                @endphp
                                @endforeach

                                <tr>
                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th style="text-align:center;" colspan="2">ऐकुण रक्कम रु</th>

                                    <th colspan="2"><input type="text" class="form-control" id="finalAmount" readonly value="{{ $total }}" /></th>

                                </tr>

                                <tr>
                                  <th colspan="8"></th>
                                  <th> <textarea placeholder="Enter Vendor Previous Deduction Remarks" id="vendor_previous_deduction_remarks" name="vendor_previous_deduction_remarks" disabled>{{ $billsummary[0]->vendor_previous_deduction_remarks }}</textarea> </th>

                                  <th style="text-align:center;" colspan="2">Vendor Previous Deduction</th>
                                  <th colspan="2"><input type="text" class="form-control" name="vendor_deduction" id="vendor_deduction"  value="{{ $billsummary[0]->vendor_deduction }}" readonly/></th>
                                </tr>
                                <tr>
                                  <th colspan="8"></th>
                                  <th> <textarea placeholder="Enter Vendor Reimbursement Remarks"   id="vendor_reimbursement_remark" name="vendor_reimbursement_remark" disabled>{{ $billsummary[0]->vendor_reimbursement_remark }}</textarea> </th>
                                  <th style="text-align:center;" colspan="2">Vendor Reimbursement</th>
                                  <th colspan="2"><input type="text" class="form-control" name="vendor_reimbursement" id="vendor_reimbursement"  value="{{ $billsummary[0]->vendor_reimbursement }}" readonly/></th>
                                </tr>

                                <tr>
                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th style="text-align:center;" colspan="2">TDS</th>
                                    <th colspan="2"><input type="text" class="form-control" id="tds" readonly value="{{ $billsummary[0]->tds }}" /></th>
                                </tr>

                                <tr>

                                    <th colspan="8"></th>
                                    <th style="text-align:center;"> - </th>
                                    <th style="text-align:center;" colspan="2">Grand Total</th>

                                    <th colspan="2"><input type="text" class="form-control" id="amountafter_tds" readonly value="{{ $billsummary[0]->amount_after_tds }}" /></th>

                                </tr>

                            </table>

                            </div>

                        </div>

                        <div class="ln_solid"></div>



                        <div class="form-group">

                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                            <a href="{{url("/$route")}}"  class="btn btn-warning" >Cancel </a>

                           </div>

                      </div>

                      @if(count($data)>0)

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                      <thead>

                        <tr>

                          <th>Sr no.</th>

                          <th>User Name</th>

                          <th>Updated Date</th>

                          <th>Updated Time</th>

                        </tr>

                      </thead>

                      <tbody>

                        @foreach($data as $key=>$history)

                          <tr>

                              <td>{{$key+1}}</td>

                              <td>{{ $history->first_name.' '.$history->last_name}}</td>

                              <td>{{ date('d-m-Y',strtotime($history->updated_at))}}</td>

                              <td>{{ date('H:i',strtotime($history->updated_at))}}</td>

                          </tr>

                        @endforeach

                      </tbody>

                      <tfoot>

                      </tfoot>

                    </table>

                    @endif

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

@endsection

