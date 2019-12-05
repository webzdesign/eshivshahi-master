<?php
/*
    Pratik
    Date:10-09-18
*/
?>
@extends('layouts.master')
@section('content')
@php
$btn = 'Submit';
$route = url("/$route");
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
                  <form id="frm_single" method="post"  action ="{{$route}}"   class="form-horizontal form-label-left" autocomplete="off">

                    @csrf
                  @foreach($parisishthaadata as $parisishthaa)
                        <div class="form-group">
                            <label class=" col-md-2 col-sm-3 col-xs-12" >अागार :
                            </label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthaa->depot->name }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>

                            <label class=" col-md-2 col-sm-3 col-xs-12" >देयकाचा कालावधी : </label>
                            @php
                                $billingPeriode = explode(",",$parisishthaa->billing_period);
                            @endphp
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ date("d-m-Y",strtotime($billingPeriode[0])) }}" class="form-control  col-md-7 col-xs-12" style="width:100%;">
                            </div>

                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ date("d-m-Y",strtotime($billingPeriode[1])) }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" col-md-2 col-sm-3 col-xs-12" >बस पुरवठादाराचे नांव :
                            </label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthaa->vendor->vendor_name  }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>

                            <label class=" col-md-2 col-sm-3 col-xs-12" >बस पुरवठादाराने दिलेला देयक क्र:</label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly  @if($vendorInvoiceFlag == 1) value="{{ $parisishthaa->vendorinvoice->invoice_no }}" @endif  class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" col-md-2 col-sm-3 col-xs-12" >मार्ग (वेळापत्रक) :
                            </label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthaa->route->fromdepot->name.'-'.$parisishthaa->route->todepot->name.' ('.$parisishthaa->route->scheduled_number.' - '.$parisishthaa->route->scheduled_time.')' }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>

                            <label class=" col-md-2 col-sm-3 col-xs-12" >महामंडळाचा देयक क्र :</label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthaa->voucher_no }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>
                        </div>

                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>(अ) देय रक्कम</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">अ.क्र</th>
                                    <th style="text-align:center;">तपशील</th>
                                    <th style="text-align:center;">एकुण किमी</th>
                                    <th style="text-align:center;">सरासरी</th>
                                    <th style="text-align:center;">दर</th>
                                    <th style="text-align:center;">रक्कम</th>
                                    <th style="text-align:center;">एकुण रक्कम (रु)</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">१</th>
                                    <th style="text-align:center;">सार्थ किमी प्रमाणे देय रक्कम</th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->total_kms }}" name="actualKm" id="actualKm" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="averageKm" id="averageKm" value="{{ $parisishthaa->avg_kms }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="rate" id="rate" value="{{ $parisishthaa->per_km_rate }}" class="form-control decimalonly" /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="amount" id="amount" value="{{ $parisishthaa->amount }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="finalAmount" value="{{ $parisishthaa->total_amount }}" id="finalAmount" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">२</th>
                                    <th style="text-align:center;">मासिक सरासरी वजावट / प्रतिपूर्ती</th>
                                    <th style="text-align:center;"><input readonly type="text" name="pActualKm" id="pActualKm" value="{{ $parisishthaa->avg_km_as_per_contract }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="pAverageKm" id="pAverageKm"  value="{{ $parisishthaa->avg_km_total_as_per_contract }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="pRate" id="pRate" value="{{ $parisishthaa->rate_for_avg_km }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="pAmount" id="pAmount" value="{{ $parisishthaa->amount_for_avg_km }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="pFinalAmount" value="{{ $parisishthaa->total_amount_for_avg }}" id="pFinalAmount" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">३</th>
                                    <th style="text-align:center;">डीझेल बचतची देय रक्कम</th>
                                    <th style="text-align:center;" colspan="2"><input readonly type="text" value="{{ $parisishthaa->diesel_amt }}" name="diselAmount" id="diselAmount" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input type="text" readonly name="dRate" value="{{ $parisishthaa->diesel_rate }}" id="dRate" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="dAmount" value="{{ $parisishthaa->diesel_amount }}" id="dAmount" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="dFinalAmount" value="{{ $parisishthaa->diesel_final_amount }}" id="dFinalAmount" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">(अ) ऐकुण देय रक्कम </th>
                                    <th style="text-align:center;" colspan="4"><input readonly type="text" name="totalAmount" value="{{ $parisishthaa->amountWoDeduct }}" id="totalAmount" class="form-control decimalonly " /></th>
                                    <th style="text-align:center;"></th>
                                </tr>
                            </thead>
                        </table>
                        <div class="form-group">
                            <label class=" col-md-2 col-sm-3 col-xs-12" >(ब) वसुली </label>
                        </div>

                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>अ.क्र</th>
                                    <th>तपशील</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">१</th>
                                    <th style="text-align:center;">जादा पुरविलेल्या डिझेलची वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->extra_diesel_amt }}" name="extra_diesel_amt" id="extra_diesel_amt" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">२</th>
                                    <th style="text-align:center;">Ad Blue वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->adblue_charge }}" name="adblue_charge" id="adblue_charge" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">३</th>
                                    <th style="text-align:center;">वाहन बिघाड</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->vehical_exp }}" name="vehical_exp" id="vehical_exp" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">४</th>
                                    <th style="text-align:center;">मार्ग बंध वाहने वसुली (VOR)</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->vor_exp }}" name="vor_exp" id="vor_exp" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">५</th>
                                    <th style="text-align:center;">पार्किंग वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->parking_charge }}" name="parking_charge" id="parking_charge" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">६</th>
                                    <th style="text-align:center;">थांबा वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa->hault_tax }}" name="hault_tax" id="hault_tax" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">७</th>
                                    <th style="text-align:center;">Washing Charge</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text"  value="{{ $parisishthaa->wash_exp }}" name="wash_exp" id="wash_exp" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">८</th>
                                    <th style="text-align:center;">इतर वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text"  value="{{ $parisishthaa->other_exp }}" name="other_exp" id="other_exp" class="form-control decimalonly " /></th>
                                </tr>

                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">(ब) ऐकुण वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input type="text" readonly value="{{ $parisishthaa->total_tax }}" name="subTotal" id="subTotal" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">निव्व्ठ्ठ दय रक्कम (अ-ब)</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" name="finalAmountTotal" value="{{ $parisishthaa->amount_payable }}" id="finalAmountTotal" class="form-control decimalonly " /></th>
                                </tr>

                            </thead>
                        </table>
                        <hr style="border-top: 4px solid #afa5a5">
                        @endforeach
                        <div class="ln_solid"></div>

                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                            <a href="{{$route}}"  class="btn btn-warning" >Cancel </a>

                           </div>
                      </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

@endsection
