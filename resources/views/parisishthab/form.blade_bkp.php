<?php
  /*
    Hardik
    Date:24-8-18
  */

  /*
  Modified
    Puja
    Date:30-8-18
  */


?>

@extends('layouts.master')
@section('content')
@php  $redirect = $route; @endphp

@if($action=='insert')

   @php  $btn = 'Save & Submit'; @endphp
   @php  $button = 'Save'; @endphp
   @php  $route=route('parisishthab.store'); @endphp

@elseif($action=='update')

    @php $btn = 'Update & Submit'; @endphp
    @php  $button = 'Update'; @endphp
    @php  $route=route('parisishthab.update',Crypt::encryptString($parisishthab->id)); @endphp

@else
@php  $button = 'View'; @endphp
@php $btn = 'View'; @endphp

@endif
<style>
.btn-xs{
	padding:6px 11px;

}
</style>
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

                  <form id="frm_single" method="post" autocomplete="off" action ="{{$route}}"   class="form-horizontal form-label-left">
                    @if($action=='update')
                        @method('PUT')

                    @endif
                       @csrf
                       <input type="hidden" name="id" value="{{isset($parisishthab->id)?$parisishthab->id:''}}">
                        <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Select Vendor<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="vendor_id" name="vendor_id"  class="form-control select2_single col-md-7 col-xs-12 vendor_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" @if(isset($parisishthab->vendor_id)){{$parisishthab->vendor_id==$vendor->id?'selected':''}}@endif>{{$vendor->vendor_name}}</option>
                                        @endforeach
                                    <select>
                                </div>
                            </div>
                              <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Invoice No<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="invoice_no" id="invoice_no" class=" form-control col-md-7 col-xs-12"  value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Select Vehicle<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="vehicle_id" name="vehicle_id"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($vehicle as $vehicle_val)
                                         <option value="{{$vehicle_val->id}}"  @if($action=='update') {{ $vehicle_val->id==$result->vehicle_id?'selected':''}} @else {{ $vehicle_val->id==old('vehicle_id')?'selected':''}}  @endif>{{$vehicle_val->vehicle_no}}</option>
                                        @endforeach
                                    <select>
                                     @if ($errors->has('vehicle_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('vehicle_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Depot<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="depot_name" id="depot_name" class=" form-control col-md-7 col-xs-12"  value="{{isset($parisishthab['depot']->name)?$parisishthab['depot']->name:''}}" readonly>
                                    <input type="hidden" name="depot_id" id="depot_id" value="{{isset($parisishthab->depot_id)?$parisishthab->depot_id:''}}">
                                     @if ($errors->has('depot_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('depot_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            @if($action=='update' || $action=='view')
                            @php	$dates = explode(",",$parisishthab->billing_period) @endphp
                            @endif
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Billing Period<span class="required">*</span>
                                </label>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="from_date" id="from_date" class="datepicker form-control" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($dates[0]))}}@endif" placeholder="From Date" readonly />
                                    @if ($errors->has('billing_period'))
                                    <span class="error">
                                     <b> {{ $errors->first('billing_period') }}</b>
                                    </span>
                                     @endif
                                </div>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="to" id="to" class="datepicker form-control" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($dates[1]))}}@endif" placeholder="To Date" readonly />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Voucher No
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="voucher_no" name="voucher_no"  class="form-control col-md-7 col-xs-12	voucher_no" value="{{isset($parisishthab->voucher_no)?$parisishthab->voucher_no:''}}">
                                    @if ($errors->has('voucher_no'))
                                    <span class="error">
                                     <b> {{ $errors->first('voucher_no') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

                             <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Voucher Date<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="voucher_date" name="voucher_date"  class="datepicker form-control col-md-7 col-xs-12	voucher_date" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($parisishthab->voucher_date))}}@endif">
                                    @if ($errors->has('voucher_date'))
                                    <span class="error">
                                     <b> {{ $errors->first('voucher_date') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>


                            <table id="parishishtha_b" class="table table-bordered" >
                                <thead>
                                    <tr>
                                    <th width="10%">Date/दिनांक<span class="required">*</span></th>
                                    <th width="8%">Kms/सार्थ किमी<span class="required">*</span></th>
                                    <th width="8%">Diesel Ltr/पुरीविलेले डिझेल (लिटर)<span class="required">*</span></th>
                                    <th width="8%">Diesel Per Ltr Price/डिझेल दर प्रति लिटर
रू<span class="required">*</span></th>
                                    <th width="8%">Ad Blue</th>
                                    <th width="5%">AdBlue Price</th>
                                    <th width="8%">Bread Down Charge/वाहन बिघाड रक्कम</th>
                                    <th width="8%">Vor. Exp/मार्ग बंद वहाने वसुली</th>
                                    <th width="8%">Parking Exp. /पार्किंग वीज इ. रक्कम <span class="required">*</span></th>
                                    <th width="8%">Hault Tax/थांबा वसुली रक्कम</th>
                                    <th width="8%">Other Exp./इतर वसुली रक्कम<span class="required"></span></th>
                                    <th width="12%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($action=='insert')
                                    <tr class="parishishtha_b">
                                        <td><input type="text" id="date_pb[0]" name="date_pb[0]"  class="date_pb form-control"></td>
                                        <td><input type="text" id="kms[0]" name="kms[0]"  class="decimalonly kms form-control" /></td>
                                        <td><input type="text" data-precision="2" id="diesel_ltr[0]" name="diesel_ltr[0]"  class="decimalonly form-control  diesel_ltr"></td>
                                        <td><input type="text" id="diese_per_ltr_price[0]" name="diese_per_ltr_price[0]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2"></td>
                                        <td><input type="text" id="adblue[0]" name="adblue[0]"  class="form-control adblue decimalonly" data-precision="2"></td>
                                        <td><input type="text" id="adblue_price[0]" name="adblue_price[0]"  class="form-control  adblue_price decimalonly" data-precision="2"></td>
                                        <td><input type="text" id="breaddown_charge[0]" name="breaddown_charge[0]"  class="numberonly form-control  breaddown_charge" ></td>
                                        <td><input type="text" id="vor_exp[0]" name="vor_exp[0]"  class="numberonly form-control vor_exp"></td>
                                        <td><input type="text" id="parking_exp[0]" name="parking_exp[0]"  class="numberonly form-control  parking_exp"></td>
                                        <td><input type="text" id="hault_exp[0]" name="hault_exp[0]"  class=" numberonly form-control  hault_exp"></td>
                                        <td><input type="text" id="other_exp[0]" name="other_exp[0]"  class=" numberonly form-control  other_exp"></td>
                                        <td>
                                            <span class="user-actions">
                                                <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                <button tabindex="1" type="button" class="btn btn-danger  btn-xs minus">-</button>
                                            </span>
                                        </td>
                                    </tr>
                                    @else
                                    @php
                                    $date = explode(",",$parisishthab->date);
                                    $kms = explode(",",$parisishthab->kms);
                                    $diesel_ltr = explode(",",$parisishthab->diesel_ltr);
                                    $diese_per_ltr_price = explode(",",$parisishthab->diese_per_ltr_price);
                                    $adblue = explode(",",$parisishthab->adblue);
                                    $adblue_price = explode(",",$parisishthab->adblue_price);
                                $breaddown_charge = explode(",",$parisishthab->breaddown_charge);
                                    $vor_exp = explode(",",$parisishthab->vor_exp);
                                    $parking_exp = explode(",",$parisishthab->parking_exp);
                                    $hault_tax = explode(",",$parisishthab->hault_tax);
                                    $other_exp = explode(",",$parisishthab->other_exp);
                                    @endphp

                                    @for($i=0;$i<count($date);$i++)

                                    <tr class="parishishtha_b">
                                        <td><input type="text" id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>
                                        <td><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control" value="{{$kms[$i]}}" /></td>
                                        <td><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr" value="{{$diesel_ltr[$i]}}"></td>
                                        <td><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                        <td><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly" data-precision="2" value="{{$adblue[$i]}}"></td>
                                        <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                        <td><input type="text" id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge" value="{{$breaddown_charge[$i]}}" ></td>
                                        <td><input type="text" id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp" value={{$vor_exp[$i]}}></td>
                                        <td><input type="text" id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp" value={{$parking_exp[$i]}} ></td>
                                        <td><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp" value="{{$hault_tax[$i]}}"></td>
                                        <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp"></td>
                                        <td>
                                            <span class="user-actions">
                                                <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button>
                                            </span>
                                        </td>
                                    </tr>
                                    @endfor
                                    @endif
                                    <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td><input type="text" class="form-control"  name="total_kms" id="total_kms" value="" disabled></td>
                                        <td><input type="text" class="form-control" name="total_diesel" id="total_diesel" value="" disabled></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control" name="total_parking_exp" id="total_parking_exp" disabled></td>
                                        <td></td>
                                        <td><input type="text" class="form-control" name="total_other_exp" id="total_other_exp" disabled></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </tbody>
                             </table>
                             <table class="table table-bordered">
                             <tr>
                                <th>Total Kms/ एकुण किमी</th>
                                <th>Total Filled Diesel/ प्रत्यक्ष पुरीविलेले डिझेल (लिटर)</th>
                                <th>Diesel According to Gov./ महामंडळने पुरवावयाचे डिझेल</th>
                                <th>Extra Diesel Filled/ जादा/कमी पुरीविलेले डिझेल</th>
                             </tr>
                             <tr>
                             <td><input type="text" class="form-control"  name="kms_total" id="kms_total" readonly></td>
                             <td><input type="text" class="form-control"  name="diesel_total" id="diesel_total" readonly></td>
                             <td><input type="text" data-precision="2" class="decimalonly form-control"  name="gov_diesel" id="gov_diesel" value="@if($action=='update' || $action=='view') {{$parisishthab->diesel_as_per_gov}} @endif" ></td>
                             <td><input type="text" class="form-control"  name="extra_diesel" id="extra_diesel" readonly></td>
                             </tr>
                            <tr>
                                <th colspan="3" style="text-align:right;">Extra Filled Diesel Charges / जादा पुरीविलेले डिझेलची वसुली</th>
                                <td width="10%"><input type="text" class="form-control"  name="extra_diesel_charge" id="extra_diesel_charge" readonly ></td>
                            </tr>
                             </table>

                            <div class="ln_solid"></div>

                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           @if($action !='view')
                           <input type="submit" name="save"  id="save" class="btn btn-primary" value="{{$button}}" />
                           <input type="submit" name="save_submit" id="save_submit" class="btn btn-success" value="{{$btn}}" >
                           @endif
                            <a href="{{url($redirect)}}"  class="btn btn-warning" >Cancel </a>

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
    var d = new Date();
    $('#voucher_date').datepicker({
        format:'dd-mm-yy',
        autoclose:true,
    }).datepicker('setDate',d);

        //form date and to date on change
        $('#from_date,#to').datepicker({
            format: 'dd-mm-yyyy',
            autoclose:true,
        }).on('changeDate', function(e) {
            if($("#from_date").val()!='' && $("#to").val()!=''){
                DateDiff($("#from_date").val(),$("#to").val());
            }
        });
        // on change end
        /** variable for validation */
        var validate_date = {
            required: true,
            messages: {
                required: "Please Select date",
            }
        }
        var validate_kms = {
            required: true,
            messages: {
                required: "Please Enter Kms",
            }
        }
        var validate_diesel_ltr = {
            required: true,
            messages: {
                required: "Please Enter Diesel Liters",
            }
        }
        var validate_diesel_ltr_price = {
            required: true,
            messages: {
                required: "Please Enter Diesel Per/Liter Price",
            }
        }
        var validate_parking = {
            required: true,
            messages: {
                required: "Please Enter Parking Charges",
            }
        }
         /** variable for validation end */
          /** function to get difference between the dates  */
       function DateDiff(date1,date2)
       {
            var DMY =date1.split('-'); //splits the date string by '/' and stores in a array.
            var DMY1 =date2.split('-');

            var day= DMY[0];
            var month=DMY[1];
            var year=DMY[2];

            var day1= DMY1[0];
            var month1=DMY1[1];
            var year1=DMY1[2];

            var dateTemp1=new Date(year, (parseInt(month)-1),day);
            var dateTemp2=new Date(year1, (parseInt(month1)-1),day1);

            var Days= Math.ceil(((dateTemp2.getTime()-dateTemp1.getTime())/(1000*60*60*24)));
           cloneauto(Days+1);
        }
         /** function to get difference between the dates end */
          /** function for cloning */
        function cloneauto(days)
        {
            var i=0;
            var length=days;
            var start = $("#from_date").datepicker("getDate");
            currentDate = new Date(start.getTime());

            var trclone='<tr class="parishishtha_b"><td><input type="text" id="date_pb[0]" name="date_pb[0]"  class="date_pb form-control"></td><td><input type="text" id="kms[0]" name="kms[0]"  class="decimalonly kms form-control" /></td><td><input type="text" data-precision="2" id="diesel_ltr[0]" name="diesel_ltr[0]"  class="decimalonly form-control  diesel_ltr"></td><td><input type="text" id="diese_per_ltr_price[0]" name="diese_per_ltr_price[0]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2"></td><td><input type="text" id="adblue[0]" name="adblue[0]"  class="form-control adblue decimalonly" data-precision="2"></td><td><input type="text" id="adblue_price[0]" name="adblue_price[0]"  class="form-control  adblue_price decimalonly" data-precision="2"></td><td><input type="text" id="breaddown_charge[0]" name="breaddown_charge[0]"  class="numberonly form-control  breaddown_charge" ></td><td><input type="text" id="vor_exp[0]" name="vor_exp[0]"  class="numberonly form-control vor_exp"></td><td><input type="text" id="parking_exp[0]" name="parking_exp[0]"  class="numberonly form-control  parking_exp"></td><td><input type="text" id="hault_exp[0]" name="hault_exp[0]"  class=" numberonly form-control  hault_exp"></td><td><input type="text" id="other_exp[0]" name="other_exp[0]"  class=" numberonly form-control  other_exp"></td><td><span class="user-actions"><button  tabindex="1"  type="button" class="btn btn-success btn-xs add" onclick="">+</button><button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button></span></td></tr>';
            $("#parishishtha_b tbody tr").remove();
            $("#parishishtha_b tbody").html(trclone);
            var t=$('.parishishtha_b');
          //  return false;
            for(i=0;i<length;i++)
            {
                if(i==0)
                {
                    t.find(".date_pb") .removeClass('hasDatepicker') .removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',currentDate);
                    currentDate.setDate(currentDate.getDate() + 1);
                    continue;
                }
                var num = $('.parishishtha_b').length;
                var clone=t.clone(true);
                $("#parishishtha_b tbody").children().last().after(clone);
                clone.find(".date_pb").attr('id', 'date_pb['+num+']').attr('name', 'date_pb['+num+']');
                  clone.find(".date_pb") .removeClass('hasDatepicker') .removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',currentDate);
                clone.find(".kms").attr('id', 'kms['+num+']').attr('name', 'kms['+num+']');
                clone.find(".diesel_ltr").attr('id', 'diesel_ltr['+num+']').attr('name', 'diesel_ltr['+num+']');
                clone.find(".diese_per_ltr_price").attr('id', 'diese_per_ltr_price['+num+']').attr('name', 'diese_per_ltr_price['+num+']');
                clone.find(".adblue").attr('id', 'adblue['+num+']').attr('name', 'adblue['+num+']');
                clone.find(".adblue_price").attr('id', 'adblue_price['+num+']').attr('name', 'adblue_price['+num+']');
                clone.find(".breaddown_charge").attr('id', 'breaddown_charge['+num+']').attr('name', 'breaddown_charge['+num+']');
                clone.find(".vor_exp").attr('id', 'vor_exp['+num+']').attr('name', 'vor_exp['+num+']');
                clone.find(".parking_exp").attr('id', 'parking_exp['+num+']').attr('name', 'parking_exp['+num+']');
                clone.find(".hault_exp").attr('id', 'hault_exp['+num+']').attr('name', 'hault_exp['+num+']');
                clone.find(".other_exp").attr('id', 'other_exp['+num+']').attr('name', 'other_exp['+num+']');
                currentDate.setDate(currentDate.getDate() + 1);
                clone.find('td').each(function() {
                var el = $(this).find(':first-child');
                var elthis = "#"+el.attr("id");
                var id = el.attr('id') || null;

                if (id) {
                  var i = id.substr(elthis.indexOf("[")-1);
                  var j= i.replace(/[\[\]']+/g,'');
                  var prefix = id.substr(0, elthis.indexOf("[")-1);
                  if(j > -1){
                    if(prefix=="kms"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('kms');
                    }
                    if(prefix=="diesel_ltr"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('diesel_ltr');
                    }
			        if(prefix=="diese_per_ltr_price"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('diese_per_ltr_price');
                    }
			        if(prefix=="parking_exp"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('parking_exp');
                    }
                 }
                }
            });

            $(".date_pb").each(function () {
                $(this).rules('add', validate_date);
            });
            $(".kms").each(function () {
                $(this).rules('add', validate_kms);
            });
            $(".diesel_ltr").each(function () {
                $(this).rules('add', validate_diesel_ltr);
            });
            $(".diese_per_ltr_price").each(function () {
                $(this).rules('add', validate_diesel_ltr_price);
            });
            $(".parking_exp").each(function () {
                $(this).rules('add', validate_parking);
            });
            }
            // $(".parishishtha_b ").each(function(){
            //     var el = $(this).find('input.date_pb');
            //     $(el).datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',currentDate);
            //     currentDate.setDate(currentDate.getDate() + 1);
            // });


        }
         /** function for cloning end*/

        $("body").on("change","#vehicle_id",function(){
                var vehicle_id = $(this).val();
                 $.ajax({
                      url:'{{url('/getparisishthadepotonvehicle')}}',
                      type:'POST',
                      dataType:'JSON',
                      data:{
                        vehicle_id:vehicle_id
                      },
                      success:function(result){
                          $("#depot_name").empty().val(result[1]);
                          $("#depot_id").empty().val(result[0]);
                      }
                 });
        });

        $(document).on('click',".add",function(){
            var num = $('.parishishtha_b').length;
            var clonetd=$(this).closest('.parishishtha_b');
            var clone=$(clonetd).clone(true,true);
                clone.insertAfter(clonetd);
                clone.find(".date_pb").attr('id', 'date_pb['+num+']').attr('name', 'date_pb['+num+']');
                clone.find(".date_pb") .removeClass('hasDatepicker') .removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yy',autoclose:true,});
                clone.find(".kms").attr('id', 'kms['+num+']').attr('name', 'kms['+num+']');
                clone.find(".diesel_ltr").attr('id', 'diesel_ltr['+num+']').attr('name', 'diesel_ltr['+num+']');
                clone.find(".diese_per_ltr_price").attr('id', 'diese_per_ltr_price['+num+']').attr('name', 'diese_per_ltr_price['+num+']');
                clone.find(".adblue").attr('id', 'adblue['+num+']').attr('name', 'adblue['+num+']').val('');
                clone.find(".adblue_price").attr('id', 'adblue_price['+num+']').attr('name', 'adblue_price['+num+']').val('');
                clone.find(".breaddown_charge").attr('id', 'breaddown_charge['+num+']').attr('name', 'breaddown_charge['+num+']').val('');
                clone.find(".vor_exp").attr('id', 'vor_exp['+num+']').attr('name', 'vor_exp['+num+']').val('');
                clone.find(".parking_exp").attr('id', 'parking_exp['+num+']').attr('name', 'parking_exp['+num+']');
                clone.find(".hault_exp").attr('id', 'hault_exp['+num+']').attr('name', 'hault_exp['+num+']').val();
                clone.find(".other_exp").attr('id', 'other_exp['+num+']').attr('name', 'other_exp['+num+']');
                clone.find('td').each(function() {
                var el = $(this).find(':first-child');
                var elthis = "#"+el.attr("id");
                var id = el.attr('id') || null;

                if (id) {
                  var i = id.substr(elthis.indexOf("[")-1);
                  var j= i.replace(/[\[\]']+/g,'');
                  var prefix = id.substr(0, elthis.indexOf("[")-1);
                  if(j > -1){
                    if(prefix=="date_pb"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('date_pb');
                    }
                    if(prefix=="kms"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('kms');
                    }
                    if(prefix=="diesel_ltr"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('diesel_ltr');
                    }
			        if(prefix=="diese_per_ltr_price"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('diese_per_ltr_price');
                    }
			        if(prefix=="parking_exp"){
                        if(el.next().hasClass('errors')){
                            el.next().remove();
                        }
                        el.addClass('parking_exp');
                    }
                  }
                }
            });
            $(".date_pb").each(function () {
                $(this).rules('add', validate_date);
                $(this).datepicker({ format: 'dd-mm-yyyy'});
            });
            $(".kms").each(function () {
                $(this).rules('add', validate_kms);
            });
            $(".diesel_ltr").each(function () {
                $(this).rules('add', validate_diesel_ltr);
            });
            $(".diese_per_ltr_price").each(function () {
                $(this).rules('add', validate_diesel_ltr_price);
            });
            $(".parking_exp").each(function () {
                $(this).rules('add', validate_parking);
            });
                indexing();
               calculatekms();
               calculatediesel();
               calculateparkingcharges();
               calculateotherexp();
        });

        function indexing()
        {
            var num_product = $('.parishishtha_b').length;
            for(i=0;i<num_product;i++)
            {
            $(".parishishtha_b").each(function(){
                $(this).find('.date').attr('name','date['+i+']');
                $(this).find('.kms').attr('name','kms['+i+']').attr('id','kms['+i+']');
                $(this).find('.diesel_ltr').attr('name','diesel_ltr['+i+']').attr('id','diesel_ltr['+i+']');
                $(this).find('.diese_per_ltr_price').attr('name','diese_per_ltr_price['+i+']').attr('id','diese_per_ltr_price['+i+']');
                $(this).find('.adblue').attr('name','adblue['+i+']').attr('id','adblue['+i+']');
                $(this).find('.adblue_price').attr('name','adblue_price['+i+']').attr('id','adblue_price['+i+']');
                $(this).find('.breaddown_charge').attr('name','breaddown_charge['+i+']').attr('id','breaddown_charge['+i+']');
                $(this).find('.vor_exp').attr('name','vor_exp['+i+']').attr('id','vor_exp['+i+']');
                $(this).find('.parking_exp').attr('name','parking_exp['+i+']').attr('id','parking_exp['+i+']');
                $(this).find('.hault_exp').attr('name','hault_exp['+i+']').attr('id','hault_exp['+i+']');
                $(this).find('.other_exp').attr('name','other_exp['+i+']').attr('id','other_exp['+i+']');
                i++;
            });
            }
        }
         /*
        $("select[name='vendor_id']").on('change',function(){
            var vendor_id=$(this).val();
            $.ajax({
                url: "{{url($getdata)}}",
                type: "POST",
                dataType:'json',
                data: {vendor_id : vendor_id},
                success:function(data){
                  $("#vendorinvoice_id").html(data.invoice);
                },
              });
        });


        $("select[name='vendorinvoice_id']").on('change',function(){
            var invoice_id=$(this).val();
            var id=$("input[name='id']").val();
            $.ajax({
                url: "{{url($checkinvoice)}}",
                type: "POST",
                dataType:'json',
                data: {invoice_id : invoice_id,vendor_id:$('#vendor_id').val(),id:id},
                success:function(data){
                    if(data==false)
                    {
                        swal("Cancelled", "Parisishtha B Is Already Created For This Invoice You Can Not Create It Again", "error");
                    }
                    else
                    {
                        $.ajax({
                            url: "{{url($getinvoicedata)}}",
                            type: "POST",
                            dataType:'json',
                            data: {id : invoice_id},
                            success:function(data){
                                $("#vehicle_id").val(data.vehicle_id).trigger('change');
                                $("input[name='depot_id']").val(data.depot_id);
                                $("input[name='depot_name']").val(data.depot_name);
                                $("input[name='vehicle_id']").val(data.vehicle_id);
                                $("input[name='vehicle_no']").val(data.vehicle_no);
                                $("#from_date").datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',data.from);
                                $("#to").datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',data.to);
                            },
                        });
                    }
                },
            });

        }); */
        $(document).on('click','.minus' ,function(event){
            if($(".parishishtha_b").length>1){
                $(this).closest(".parishishtha_b").remove();
               indexing();
               calculatekms();
               calculatediesel();
               calculateparkingcharges();
               calculateotherexp();
            }
        });
        $(document).on('keyup','.kms',function(){
            calculatekms();
        });
        $(document).on('keyup',".diesel_ltr",function(){
            calculatediesel();
        });
        $(document).on('keyup',".parking_exp",function(){
            calculateparkingcharges();
        });
        $(document).on('keyup',".other_exp",function(){
            calculateotherexp();
        });
        function calculatekms()
        {
            var total_kms=0
            $(".kms").each(function(){
                if($(this).val()=='')
                {
                    var kms=0;
                }
                else
                {
                    var kms=parseFloat($(this).val());
                }
                total_kms=total_kms+kms;
            });
            $("#total_kms").val(total_kms);
            $("#kms_total").val(total_kms);
        }
        function calculatediesel()
        {
            var total_diesel=0
            $(".diesel_ltr").each(function(){
                if($(this).val()=='')
                {
                    var diesel_ltr=0;
                }
                else
                {
                    var diesel_ltr=parseFloat($(this).val());
                }
                total_diesel=total_diesel+diesel_ltr;
            });
            $("#total_diesel").val(total_diesel);
            $("#diesel_total").val(total_diesel);
        }
        function calculateparkingcharges()
        {
            var total_parking_exp=0
            $(".parking_exp").each(function(){
                if($(this).val()=='')
                {
                    var parking_exp=0;
                }
                else
                {
                    var parking_exp=parseFloat($(this).val());
                }
                total_parking_exp=total_parking_exp+parking_exp;
            });
            $("#total_parking_exp").val(total_parking_exp);
        }
        function calculateotherexp()
        { var total_other_exp=0
            $(".other_exp").each(function(){
                if($(this).val()=='')
                {
                    var other_exp=0;
                }
                else
                {
                    var other_exp=parseFloat($(this).val());
                }
                total_other_exp=total_other_exp+other_exp;
            });
            $("#total_other_exp").val(total_other_exp);
        }
        $("#gov_diesel").on('keyup',function(){
            var gov=parseFloat($(this).val());
            var diesel=parseFloat($("#diesel_total").val());
           var  extra=diesel-gov;
            $("#extra_diesel").val(extra.toFixed(2));
            calculateextra();
        });
        function calculateextra()
        {
            var extra =parseFloat($("#extra_diesel").val());
            if($("input[name='diese_per_ltr_price[0]']").val() !='')
            {
                price =parseFloat($("input[name='diese_per_ltr_price[0]']").val());
            }
            else
            {
                price=0;
            }
            if($("#extra_diesel").val() !='')
            {
                var extra =parseFloat($("#extra_diesel").val());
            }
            else
            {
                var extra =0;
            }

            var charge=extra*price;
            $("#extra_diesel_charge").val(charge.toFixed(2));
        }

        $("body").on("click","#save",function(e){
            var validator = $( "#frm_single" ).validate();
               validator.destroy();
                $("form").removeAttr("id");
                $("form").attr("id","frm_single_submit");

        });

         $("body").on("click","#save_submit",function(e){

               var validator = $( "#frm_single_submit").validate();
               validator.destroy();
                $("form").removeAttr("id");
                $("form").attr("id","frm_single");

         });


                $('#frm_single_submit').validate({
                ignore: '.select2-input, .select2-focusser',
                errorClass: 'errors',
                rules:
                {

                    vendorinvoice_id:{
                        required:true,
                    },
                    depot_id:{
                        required:true,
                    },
                    voucher_no:{

                        remote:{
                            url: "{{url($checkvoucher)}}",
                            type: "post",
                            data:{
                                id:function(){
                                    return $("input[name='id']").val();
                                },
                            },
                        },
                    },
                    voucher_date:{
                        required:true,
                    },
                    vehicle_id:{
                        required:true,
                    },
                    gov_diesel:{
                        required:true,
                    },
                    "parking_exp[0]":{
                        required:true,
                    },
                    "diese_per_ltr_price[0]":{
                        required:true,
                    },
                    "diesel_ltr[0]":{
                        required:true,
                    },
                    "kms[0]":{
                        required:true,
                    },
                    "date_pb[0]":{
                        required:true,
                    },
                },
                messages:
                {
                    vendor_id:{
                        required:"Please Select Vendor",
                    },
                    vendorinvoice_id:{
                        required:"Please Select Vendor Invoice",
                    },

                    voucher_no:{
                        required:"Please Enter Voucher No",
                        remote:"Voucher No Already Exist",
                    },
                    voucher_date:{
                        required:"Please Enter Voucher Date",
                    },
                    vehicle_id:{
                        required:"Please Enter Vehicle",
                    },
                    "parking_exp[0]":{
                        required:"Please Enter Parking Charges",
                    },
                    "diese_per_ltr_price[0]":{
                        required:"Please Enter Diesel Per/Liter Price",
                    },
                    "diesel_ltr[0]":{
                        required:"Please Enter Diesel Liters",
                    },
                    "kms[0]":{
                        required:"Please Enter Kms",
                    },
                    "date_pb[0]":{
                        required:"Please Select date",
                    },
                    gov_diesel:{
                        required:"Please Enter Value",
                    },
                },
                errorPlacement: function(error, element) {
                        if(element.is('select')) {
                            error.insertAfter(element.next());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                 });


                $('#frm_single').validate({
                ignore: '.select2-input, .select2-focusser',
                errorClass: 'errors',
                rules:
                {
                    vendor_id:{
                        required: true,
                    },
                    vendorinvoice_id:{
                        required:true,
                    },
                    depot_id:{
                        required:true,
                    },
                    voucher_no:{
                        required:true,
                        remote:{
                            url: "{{url($checkvoucher)}}",
                            type: "post",
                            data:{
                                id:function(){
                                    return $("input[name='id']").val();
                                },
                            },
                        },
                    },
                    voucher_date:{
                        required:true,
                    },
                    vehicle_id:{
                        required:true,
                    },
                    gov_diesel:{
                        required:true,
                    },
                    "parking_exp[0]":{
                        required:true,
                    },
                    "diese_per_ltr_price[0]":{
                        required:true,
                    },
                    "diesel_ltr[0]":{
                        required:true,
                    },
                    "kms[0]":{
                        required:true,
                    },
                    "date_pb[0]":{
                        required:true,
                    },
                },
                messages:
                {
                    vendor_id:{
                        required:"Please Select Vendor",
                    },
                    vendorinvoice_id:{
                        required:"Please Select Vendor Invoice",
                    },
                    depot_id:{
                        required:"Please Select Depot",
                    },
                    voucher_no:{
                        required:"Please Enter Voucher No",
                        remote:"Voucher No Already Exist",
                    },
                    voucher_date:{
                        required:"Please Enter Voucher Date",
                    },
                    vehicle_id:{
                        required:"Please Enter Vehicle",
                    },
                    "parking_exp[0]":{
                        required:"Please Enter Parking Charges",
                    },
                    "diese_per_ltr_price[0]":{
                        required:"Please Enter Diesel Per/Liter Price",
                    },
                    "diesel_ltr[0]":{
                        required:"Please Enter Diesel Liters",
                    },
                    "kms[0]":{
                        required:"Please Enter Kms",
                    },
                    "date_pb[0]":{
                        required:"Please Select date",
                    },
                    gov_diesel:{
                        required:"Please Enter Value",
                    },
                },
                errorPlacement: function(error, element) {
                        if(element.is('select')) {
                            error.insertAfter(element.next());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                 });



    $("input.date_pb").datepicker({
        format:'dd-mm-yy',
        autoclose:true,
    });
    /*$(document).on('keyup',"input[name='kms[0]']",function(){
        var kms=$(this).val();
        $(".kms").each(function(){
            $(this).val(kms);
        });
        calculatekms();
    });
    $(document).on('keyup',"input[name='parking_exp[0]']",function(){
        var parking=$(this).val();
        $(".parking_exp").each(function(){
            $(this).val(parking);
        });
        calculateparkingcharges();
    });
    $(document).on('keyup',"input[name='other_exp[0]']",function(){
        var parking=$(this).val();
        $(".other_exp").each(function(){
            $(this).val(parking);
        });
        calculateotherexp();
    });
    $(document).on('keyup','input[name="diese_per_ltr_price[0]"]',function(){
        var price=$(this).val();
        $(".diese_per_ltr_price").each(function(){
            $(this).val(price);
        });
    })
    */
    if('{{$action}}'=='update' || '{{$action}}'=='view')
    {
        $(".kms").trigger('keyup');
        $(".diesel_ltr").trigger('keyup');
        $(".parking_exp").trigger('keyup');
        $(".other_exp").trigger('keyup');
        $("input[name='gov_diesel']").trigger('keyup');
    }
    if('{{$action}}'=='view')
    {
        $('input').prop('readonly',true);
        $('select').prop('disabled',true)
    }
});
</script>
@endsection