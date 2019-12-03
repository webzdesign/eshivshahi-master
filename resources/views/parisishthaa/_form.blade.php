<?php
/*
    Pratik
    Date:11-09-18
*/
?>
@extends('layouts.master')
@section('content')
@php
$btn = 'Update';
$backRoute = url("/$route");
$route = url("/$route/".$parisishthab->id);
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

                  @method('PUT')
                    <input type="hidden" name="id" value="{{$parisishthaa[0]->id}}">

                    @csrf

                        <input type="hidden" name="parisisthab_id" value="{{$parisishthab->id}}">

                        <div class="form-group">
                            <label class=" col-md-2 col-sm-3 col-xs-12" >अागार :
                            </label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthab->depot->name }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>

                            <label class=" col-md-2 col-sm-3 col-xs-12" >देयकाचा कालावधी : </label>
                            @php
                                $billingPeriode = explode(",",$parisishthab->billing_period);
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
                                <input type="text" readonly value="{{ $parisishthab->vendor->vendor_name  }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>

                            <label class=" col-md-2 col-sm-3 col-xs-12" >बस पुरवठादाराने दिलेला देयक क्र:</label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly @if($vendorInvoiceFlag == 1) value="{{ $parisishthab->vendorinvoice->invoice_no }}" @endif class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" col-md-2 col-sm-3 col-xs-12" >मार्ग (वेळापत्रक) :
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthab->route->fromdepot->name.'-'.$parisishthab->route->todepot->name.' ('.$parisishthab->route->scheduled_number.' - '.$parisishthab->route->scheduled_time.')' }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
                            </div>

                            <label class=" col-md-2 col-sm-3 col-xs-12" >महामंडळाचा देयक क्र :</label>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input type="text" readonly value="{{ $parisishthab->voucher_no }}" class="form-control  col-md-7 col-xs-12 " style="width:100%;">
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
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->total_kms }}" name="actualKm" id="actualKm" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="averageKm" value="{{ $parisishthaa[0]->avg_kms }}" id="averageKm" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input type="text" readonly name="rate" id="rate" value="{{ $parisishthaa[0]->per_km_rate }}" class="form-control decimalonly" /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="amount" value="{{ $parisishthaa[0]->amount }}" id="amount" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->total_amount }}" name="finalAmount" id="finalAmount" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">२</th>
                                    <th style="text-align:center;">मासिक सरासरी वजावट / प्रतिपूर्ती</th>

                                    <th style="text-align:center;"><input type="text" name="pActualKm" id="pActualKm" value="{{ $parisishthaa[0]->avg_km_as_per_contract }}" class="form-control decimalonly " readonly/></th>

                                    <th style="text-align:center;"><input type="text" name="pAverageKm" id="pAverageKm" value="{{ $parisishthaa[0]->avg_km_total_as_per_contract }}" class="form-control decimalonly " readonly/></th>

                                    <th style="text-align:center;"><input type="text" name="pRate" id="pRate" value="{{ $parisishthaa[0]->rate_for_avg_km }}" class="form-control decimalonly " readonly/></th>

                                    <th style="text-align:center;"><input readonly type="text" name="pAmount" value="{{ $parisishthaa[0]->amount_for_avg_km }}" id="pAmount" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="pFinalAmount" value="{{ $parisishthaa[0]->total_amount_for_avg }}" id="pFinalAmount" class="form-control decimalonly " /></th>

                                </tr>
                                <tr>
                                    @php
                                        if($parisishthab->extra_filled_diesel < 0){
                                            $extra_diesel_charged = $parisishthab->extra_filled_diesel;
                                            $dieselPerLtr = explode(",",$parisishthab->diese_per_ltr_price);
                                            $totaldiesel = array_sum($dieselPerLtr);
                                            $averageDiesel = $totaldiesel/count($dieselPerLtr);

                                            $extra_diesel_charged = ($extra_diesel_charged/2);
                                        }
                                        else{
                                            $extra_diesel_charged = 0;
                                            $averageDiesel = 0;
                                        }
                                    @endphp
                                    <th style="text-align:center;">३</th>
                                    <th style="text-align:center;">डीझेल बचतची देय रक्कम</th>

                                    <th style="text-align:center;" colspan="2"><input type="text" name="diselAmount" value="{{ $parisishthaa[0]->diesel_amt }}" id="diselAmount" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input type="text" name="dRate" id="dRate" value="{{ $parisishthaa[0]->diesel_rate }}" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="dAmount" value="{{ $parisishthaa[0]->diesel_amount }}" id="dAmount" class="form-control decimalonly " /></th>

                                    <th style="text-align:center;"><input readonly type="text" name="dFinalAmount" value="{{ $parisishthaa[0]->diesel_final_amount }}" id="dFinalAmount" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">(अ) ऐकुण देय रक्कम </th>
                                    <th style="text-align:center;" colspan="4"><input readonly type="text" value="{{ $parisishthaa[0]->amountWoDeduct }}" name="totalAmount" id="totalAmount" class="form-control decimalonly " /></th>
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
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->extra_diesel_amt }}" name="extra_diesel_amt" id="extra_diesel_amt" class="form-control decimalonly " /></th>
                                </tr>
                                @php
                                if($parisishthab->extra_diesel_charged < 0){
                                    $extra_diesel_charged = $parisishthab->extra_diesel_charged;
                                    $dieselPerLtr = explode(",",$parisishthab->diese_per_ltr_price);
                                    $totaldiesel = array_sum($dieselPerLtr);
                                    $averageDiesel = $totaldiesel/count($dieselPerLtr);

                                    $extra_diesel_charged = ($extra_diesel_charged/2) * $averageDiesel;
                                }
                                else{
                                    $extra_diesel_charged = 0;
                                }
                                @endphp
                                <tr>
                                    <th style="text-align:center;">२</th>
                                    <th style="text-align:center;">Ad Blue/अॅडब्लू वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->adblue_charge }}" name="adblue_charge" id="adblue_charge" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">३</th>
                                    <th style="text-align:center;">वाहन बिघाड</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->vehical_exp }}" name="vehical_exp" id="vehical_exp" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">४</th>
                                    <th style="text-align:center;">मार्ग बंध वाहने वसुली (VOR)</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->vor_exp }}" name="vor_exp" id="vor_exp" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">५</th>
                                    <th style="text-align:center;">पार्किंग वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->parking_charge }}" name="parking_charge" id="parking_charge" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">६</th>
                                    <th style="text-align:center;">थांबा वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" value="{{ $parisishthaa[0]->hault_tax }}" name="hault_tax" id="hault_tax" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">७</th>
                                    <th style="text-align:center;">Washing Charge/धुण्याचे शुल्क</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text"  value="{{ $parisishthaa[0]->wash_exp }}" name="wash_exp" id="wash_exp" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">८</th>
                                    <th style="text-align:center;">इतर वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text"  value="{{ $parisishthaa[0]->other_exp }}" name="other_exp" id="other_exp" class="form-control decimalonly" /></th>
                                </tr>

                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">(ब) ऐकुण वसुली</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input type="text" readonly value="{{ $parisishthaa[0]->total_tax }}" name="subTotal" id="subTotal" class="form-control decimalonly " /></th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">निव्व्ठ्ठ दय रक्कम (अ-ब)</th>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;"><input readonly type="text" name="finalAmountTotal" id="finalAmountTotal" value="{{ $parisishthaa[0]->amount_payable }}" class="form-control decimalonly " /></th>
                                </tr>

                            </thead>
                        </table>


                        <div class="ln_solid"></div>

                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<input type="hidden" name="publish_flag" id="publish_flag" value="" />
                            <a href="{{ $backRoute }}"  class="btn btn-warning" >Cancel </a>
                            <button type="submit" onclick="setFlag(0)" class="btn btn-primary">{{ $btn }}</button>
                            <button type="submit"  onclick="setFlag(1)" class="btn btn-primary">Update And Submit</button>
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

    $('body').on('keyup','#actualKm,#rate,#pActualKm,#pRate,#diselAmount,#dRate',function(e){
        var actualKm = $('#actualKm').val();
        var rate = $('#rate').val();
        var pActualKm = $('#pActualKm').val();
        var pRate = $('#pRate').val();
        var diselAmount = $('#diselAmount').val();
        var dRate = $('#dRate').val();
        var subTotal = $('#subTotal').val();

        if(isNaN(actualKm) || actualKm == ''){
            actualKm = 0;
        }
        if(isNaN(rate) || rate == ''){
            rate = 0;
        }
        if(isNaN(pActualKm) || pActualKm == ''){
            pActualKm = 0;
        }
        if(isNaN(pRate) || pRate == ''){
            pRate = 0;
        }
        if(isNaN(diselAmount) || diselAmount == ''){
            diselAmount = 0;
        }
        if(isNaN(dRate) || dRate == ''){
            dRate = 0;
        }
       /* if(isNaN(saving_disel) || saving_disel == ''){
            saving_disel = 0;
        } */

        var finalAmount = parseFloat(actualKm)*parseFloat(rate);
        $('#amount').val(finalAmount.toFixed(2));
        $('#finalAmount').val(finalAmount.toFixed(2));

        var pFinalAmount = $('#pFinalAmount').val();

        var dFinalAmount = parseFloat(diselAmount)*parseFloat(dRate);
        $('#dAmount').val(dFinalAmount.toFixed(2));
        $('#dFinalAmount').val(dFinalAmount.toFixed(2));

        var finalTotal = parseFloat(finalAmount)+parseFloat(pFinalAmount)+parseFloat(dFinalAmount);

        $('#totalAmount').val(finalTotal.toFixed(2));

       // var finalAmountTotal = finalTotal-subTotal;
       var withoutSavingdeselTotal = finalTotal-subTotal;
      // var finalAmountTotal =  withoutSavingdeselTotal + parseFloat(saving_disel);
        var finalAmountTotal =  withoutSavingdeselTotal;
        $('#finalAmountTotal').val(finalAmountTotal.toFixed(2));
    });
    $('#rate').trigger('keyup');


    $('#frm_single').validate({
        rules:
        {
            averageKm:{required: true,},
            rate:{required: true,},
            pActualKm:{required: true,},
            pAverageKm:{required: true,},
            pRate:{required: true,},
        },
        messages:
        {
            averageKm:{required:"Please Enter Average KM",},
            rate:{required:"Please Enter Rate",},
            pActualKm:{required:"Please Enter KM",},
            pAverageKm:{required:"Please Enter Average KM",},
            pRate:{required:"Please Enter Rate",},
        },
        submitHandler: function(form){
            $(':input[type="submit"]').prop('disabled', true);
            form.submit();
        },
    });
});
function setFlag(p){
		$("#publish_flag").val(p);
	}
</script>

@endsection