<?php
/*
Pratik Donga
Date:20-10-18
*/
error_reporting(0);
?>

@extends('layouts.master')
@section('content')
@php  $redirect = $route; @endphp

@if($action=='update')
    @php $btn = 'Update'; @endphp
    @php  $button = 'Update'; @endphp
    @php  $route = route('vendorinvoice.update',Crypt::encryptString($parisishthab->id)); @endphp
@endif

<style>
.wrapper1, .wrapper2{width: 100%; border: none 0px RED;
overflow-x: scroll; overflow-y:hidden;}
.wrapper1{height: 20px; }
.wrapper2{ }
.div1 {width:1490px; height: 20px; }
.div2 {width:1490px; overflow: auto;}
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
							@method('PUT')
                            @csrf

							<input type="hidden" name="id" id="id" value="{{isset($parisishthab->id)?$parisishthab->id:''}}">
                            <input type="hidden" name="route_km" value="{{ $schduleKm }}" id="route_km" />


                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Select Vendor<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="vendor_id" name="vendor_id" style="width:100%;"  class="form-control col-md-7 col-xs-12 select2_single vendor_id" @if(Auth::user()->usertype_id !=1){{'disabled'}} @endif >
                                        <option value=""></option>
                                           @foreach($vendors as $vendorVal)
                                           <option @if($vendor_id != '') {{ ($vendor_id == $vendorVal->id) ? 'selected' : '' }}  @endif  value="{{ $vendorVal->id}}" {{ ($vendorVal->id==$parisishthab->vendor_id) ? 'selected':''}} >{{ $vendorVal->vendor_name}}</option>
                                           @endforeach
                                          <input type="hidden" name="vendor_id" value="{{ $parisishthab->vendor_id }}">
                                    </select>
                                    @if ($errors->has('vendor_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('vendor_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Division<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select disabled id="division_id" name="division_id"  class="form-control select2_single col-md-7 col-xs-12 division_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($division as $key=>$val)
                                            <option @if($action == 'update'){{ ($val->id == $parisishthab->division_id) ? 'selected' : '' }} @else {{ ($val->id == $userdivision) ? 'selected' : '' }}  @endif value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>

                                @if($parisishthab->vendorinvoice_id != '')
                                <input type="hidden" name="division_id" id="division_id_input" value="{{ $parisishthab->division_id }}">
                                @endif

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Depot<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select disabled id="depot_id" name="depot_id"  class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($depots as $key=>$val)
                                            <option @if($action == 'update' ){{ ($val->id == $parisishthab->depot_id) ? 'selected' : '' }} @else {{ ($val->id == $userdepo) ? 'selected' : '' }} @endif value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>
                            @if($parisishthab->vendorinvoice_id != '')
                            <input type="text" name="depot_id" id="depot_id_input" value="{{ $parisishthab->depot_id }}">
                            @endif

						    @php $dates = explode(",",$parisishthab->billing_period) @endphp

                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Select Route<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="route_id" name="route_id" class="form-control select2_single col-md-7 col-xs-12 route_id" style="width:100%;">

                                    <select>
                                </div>
                                <label id="sch_km" class="btn btn-danger">Min. Schedule KM : @if($action == 'update') {{ $schduleKm }} @endif</label>
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Schedule Number - Time<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="schedule_number" id="schedule_number" class="form-control" placeholder="Schedule Number" value="{{ $schTimeNum }}" readonly/>
                                </div>
                            </div>

							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Invoice No<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="invoice_no" name="invoice_no"  class="form-control col-md-7 col-xs-12 invoice_no" value="{{ $parisishthab->invoice_no }}">
                                    @if ($errors->has('invoice_no'))
                                    <span class="error">
                                        <b>{{ $errors->first('invoice_no') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Billing Period<span class="required">*</span>
                                </label>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="from_date" id="from_date" class="datepicker form-control" value="{{date("d-m-Y",strtotime($dates[0]))}}" disabled placeholder="From Date"  />
                                    @if ($errors->has('billing_period'))
                                    <span class="error">
                                        <b> {{ $errors->first('billing_period') }}</b>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="to" id="to" class="datepicker form-control" value="{{date("d-m-Y",strtotime($dates[1]))}}" disabled placeholder="To Date"  />
                                </div>
							</div>

                            <div class="wrapper1">
                                <div class="div1"></div>
                            </div>
                            <div class="wrapper2">
                                <div class="div2">
                                    <table id="parishishtha_b" class="table table-bordered dttable" style="width:1490px;">
                                        <thead>
                                            <tr>
                                                <th width="120px !important;">Date/दिनांक<span class="required">*</span></th>
                                                <th width="50px !important;">Schedule Complete</th>
                                                <th width="100px !important;">Kms/सार्थ किमी<span class="required">*</span></th>
                                                <th width="100px !important;">Diesel Ltr/पुरविलेले डिझेल (लिटर)<span class="required">*</span></th>
                                                <th width="100px !important;">Diesel Rate/डिझेल दर प्रति लिटर रू<span class="required">*</span></th>
                                                <th width="100px !important;">Ad Blue</th>
                                                <th width="100px !important;">AdBlue Price Per Litre</th>
                                                <th width="100px !important;">Break Down Charges/वाहन बिघाड रक्कम</th>
                                                <th width="100px !important;">Vor. Exp/मार्ग बंद वाहने वसुली</th>
                                                <th width="100px !important;">Parking Exp. /पार्किंग वीज इ. रक्कम <span class="required">*</span></th>
                                                <th width="100px !important;">Hotel Halt/थांबा वसुली रक्कम</th>
                                                <th width="100px !important;">Washing Charges</th>
                                                <th width="100px !important;">Other Exp./इतर वसुली रक्कम<span class="required"></span></th>
                                                <th width="150px !important;">VehicleNumber<span class="required">*</span></th>
                                                <th width="120px !important;">Idling Minutes</th>
                                                <th width="120px !important;">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody style="">
                                                @php
                                                    $date = explode(",",$parisishthab->date);
                                                    $vehicleArr = explode("*++*",$parisishthab->vehicle_id);
                                                    $kms = explode(",",$parisishthab->kms);
                                                    $schedule_complete = explode("*++*",$parisishthab->schedule_complete);
                                                    $diesel_ltr = explode(",",$parisishthab->diesel_ltr);
                                                    $diese_per_ltr_price = explode(",",$parisishthab->diese_per_ltr_price);
                                                    $adblue = explode(",",$parisishthab->adblue);
                                                    $adblue_price = explode(",",$parisishthab->adblue_price);
                                                    $breaddown_charge = explode(",",$parisishthab->breaddown_charge);
                                                    $vor_exps = explode(",",$parisishthab->vor_exp);
                                                    $parking_exps = explode(",",$parisishthab->parking_exp);
                                                    $hault_tax = explode(",",$parisishthab->hault_tax);
                                                    $wash_exps = explode(",",$parisishthab->wash_exp);
                                                    $other_exp = explode(",",$parisishthab->other_exp);
                                                    $remarks = explode("*++*",$parisishthab->remarks);
                                                    $idling_minutes = explode(",",$parisishthab->idling_minutes);
                                                    $vor_charges = explode(",", $default_diseal->vor_charges);
                                                    $parking_charges = explode(",",$default_diseal->parking_charges);
                                                    $wash_charges = explode(",",$default_diseal->washing_charges);
                                                @endphp

                                                @for($i=0;$i<count($date);$i++)
                                                    @if($date[$i] > date('Y-m-d'))
                                                        <tr class="parishishtha_b">
                                                            <td ><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

                                                            <td align="center"><input type="checkbox" name="schedule_complete[{{$i}}]" class="schedule_complete" id="schedule_complete[{{$i}}]" value="1" disabled style="height:25px;width:25px;" {{($schedule_complete[$i]==1)?'checked':'' }}><input type="hidden" name="s_c_v[{{$i}}]" class="s_c_v" id="s_c_V[{{$i}}]" value="{{ $schedule_complete[$i]}}"></td>

                                                            <td><input type="text" readonly id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control" value="{{$kms[$i]}}" /></td>

                                                            <td><input type="text" readonly data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr" value="{{$diesel_ltr[$i]}}"></td>

                                                            <td><input type="text" readonly id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>

                                                            <td><input type="text" readonly id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly" data-precision="2" value="{{$adblue[$i]}}"></td>

                                                            <td><input type="text" readonly id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly" value="{{$adblue_price[$i]}}" data-precision="2"></td>

                                                            <td><input type="text" readonly id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge" value="{{$breaddown_charge[$i]}}" ></td>

                                                            <td><select  id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;" disabled>
                                                                <option value=""></option>

                                                                @foreach($vor_charges as $vor_charge)
                                                                    <option {{ ($vor_exps[$i] == $vor_charge) ? 'selected' : '' }} value="{{$vor_charge}}">{{$vor_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>

                                                            <td><select  id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp" style="width:100%;" disabled>
                                                                <option value=""></option>
                                                                @foreach($parking_charges as $parking_charge)
                                                                <option {{ ($parking_exps[$i] == $parking_charge) ? 'selected' : '' }} value="{{$parking_charge}}">{{$parking_charge}}</option>
                                                                @endforeach
                                                                <select>
                                                            </td>

                                                            <td ><input type="text" readonly id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp" value="{{$hault_tax[$i]}}"></td>

                                                            <td >
                                                            <select  id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp" style="width:100%;" disabled>
                                                                <option value=""></option>
                                                                @foreach($wash_charges as $wash_charge)
                                                                <option {{ ($wash_exps[$i] == $wash_charge) ? 'selected' : '' }} value="{{$wash_charge}}">{{$wash_charge}}</option>
                                                                @endforeach
                                                                <select>
                                                            </td>

                                                            <td><input type="text" readonly id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp"></td>

                                                            <td>
                                                            <?php /*  <input type="text" readonly id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]" value="{{$vehicleArr[$i]}}"  class="form-control  vehicle_id"> */ ?>

                                                                <select  id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id" style="width:100%;">
                                                                    <option value=""></option>
                                                                    <option {{ ($vehicleArr[$i] == 'noVehicle') ? 'selected' : '' }} value="noVehicle">No Vehicle</option>
                                                                    @foreach($vehicle as $key => $value)
                                                                    <option value="{{$value->id}}" {{($value->id == $vehicleArr[$i]) ? 'selected':'' }}>{{$value->vehicle_no}}</option>
                                                                    @endforeach
                                                                <select>
                                                            </td>

                                                            <td>
                                                                <select  id="idling_minutes[{{$i}}]" name="idling_minutes[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 idling_minutes" style="width:100%;" disabled>
    
                                                                @foreach($edit_ideal_min as $idealMin)
                                                                    <option value="{{$idealMin}}" {{($idling_minutes[$i] == $idealMin) ? 'selected':'' }}>{{$idealMin}}</option>
                                                                @endforeach
                                                                <select>
                                                            </td>

                                                            <td><textarea rows="1" id="remarks[{{ $i }}}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea></td>
                                                        </tr>
                                                    @else
                                                        @if($i == '0')
                                                        <tr class="parishishtha_b">
                                                            <td><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

                                                            <td align="center"><input type="checkbox" name="schedule_complete[{{$i}}]" class="schedule_complete" id="schedule_complete[{{$i}}]" value="1" style="height:25px;width:25px;" {{($schedule_complete[$i]==1)?'checked':'' }}><input type="hidden" name="s_c_v[{{$i}}]" class="s_c_v" id="s_c_V[{{$i}}]" value="{{ $schedule_complete[$i]}}"></td>

                                                            <td ><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control kms_auto" value="{{$kms[$i]}}" /></td>

                                                            <td ><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto" value="{{$diesel_ltr[$i]}}"></td>

                                                            <td ><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>

                                                            <td ><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly adblue_auto" data-precision="2" value="{{$adblue[$i]}}"></td>

                                                            <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly adblue_price_auto" value="{{$adblue_price[$i]}}" data-precision="2"></td>

                                                            <td><input type="text" id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto" value="{{$breaddown_charge[$i]}}" ></td>

                                                            <td>
                                                            <select  id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;">
                                                                <option value=""></option>
                                                                @foreach($vor_charges as $vor_charge)
                                                                    <option {{ ($vor_exps[$i] == $vor_charge) ? 'selected' : '' }} value="{{$vor_charge}}">{{$vor_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>

                                                            <td>
                                                            <select  id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp " style="width:100%;" >
                                                                <option value=""></option>
                                                                @foreach($parking_charges as $parking_charge)
                                                                <option {{ ($parking_exps[$i] == $parking_charge) ? 'selected' : '' }} value="{{$parking_charge}}">{{$parking_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>

                                                            <td><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp hault_exp_auto" value="{{$hault_tax[$i]}}"></td>

                                                            <td>
                                                            <select  id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp " style="width:100%;" >
                                                                <option value=""></option>
                                                                @foreach($wash_charges as $wash_charge)
                                                                <option {{ ($wash_exps[$i] == $wash_charge) ? 'selected' : '' }} value="{{$wash_charge}}">{{$wash_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>

                                                            <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp other_exp_auto"></td>
                                                            <td>
                                                            <?php /* <input type="text" id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]" value="{{$vehicleArr[$i]}}"  class=" numberonly form-control  vehicle_id vehicle_id_auto"> */ ?>
                                                            <select  id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id" style="width:100%;">
                                                                <option value=""></option>
                                                                <option {{ ($vehicleArr[$i] == 'noVehicle') ? 'selected' : '' }} value="noVehicle">No Vehicle</option>
                                                                @foreach($vehicle as $key => $value)
                                                                <option value="{{$value->id}}" {{($value->id == $vehicleArr[$i]) ? 'selected':'' }}>{{$value->vehicle_no}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>
                                                            <td>
                                                                <select  id="idling_minutes[{{$i}}]" name="idling_minutes[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 idling_minutes" style="width:100%;">
                                                                    @foreach($edit_ideal_min as $idealMin)
                                                                    <option value="{{$idealMin}}" {{($idling_minutes[$i] == $idealMin) ? 'selected':'' }}>{{$idealMin}}</option>
                                                                    @endforeach
                                                                <select>
                                                            </td>
                                                            <td>
                                                                <textarea rows="1" id="remarks[{{ $i }}}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>
                                                            </td>
                                                        </tr>
                                                        @else
                                                        <tr class="parishishtha_b">
                                                            <td ><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

                                                            <td align="center"><input type="checkbox" name="schedule_complete[{{$i}}]" class="schedule_complete" id="schedule_complete[{{$i}}]" value="1" style="height:25px;width:25px;" {{($schedule_complete[$i]==1)?'checked':'' }}><input type="hidden" name="s_c_v[{{$i}}]" class="s_c_v" id="s_c_V[{{$i}}]" value="{{ $schedule_complete[$i]}}"></td>

                                                            <td><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control kms_auto_total" value="{{$kms[$i]}}" /></td>

                                                            <td><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto_total" value="{{$diesel_ltr[$i]}}"></td>

                                                            <td><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto_total" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>

                                                            <td><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly adblue_auto_total" data-precision="2" value="{{$adblue[$i]}}"></td>

                                                            <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly adblue_price_auto_total" value="{{$adblue_price[$i]}}" data-precision="2"></td>

                                                            <td ><input type="text" id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto_total" value="{{$breaddown_charge[$i]}}" ></td>

                                                            <td >
                                                            <select  id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;">
                                                                <option value=""></option>
                                                                @foreach($vor_charges as $vor_charge)
                                                                    <option {{ ($vor_exps[$i] == $vor_charge) ? 'selected' : '' }} value="{{$vor_charge}}">{{$vor_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>

                                                            <td>
                                                            <select  id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp " style="width:100%;" >
                                                                <option value=""></option>
                                                                @foreach($parking_charges as $parking_charge)
                                                                <option {{ ($parking_exps[$i] == $parking_charge) ? 'selected' : '' }} value="{{$parking_charge}}">{{$parking_charge}}</option>
                                                                @endforeach
                                                                <select>
                                                            </td>

                                                            <td ><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp hault_exp_auto_total" value="{{$hault_tax[$i]}}"></td>

                                                            <td>
                                                            <select  id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp " style="width:100%;" >
                                                                <option value=""></option>
                                                                @foreach($wash_charges as $wash_charge)
                                                                <option {{ ($wash_exps[$i] == $wash_charge) ? 'selected' : '' }} value="{{$wash_charge}}">{{$wash_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                            </td>

                                                            <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp other_exp_auto_total"></td>

                                                            <td>
                                                                <?php /*<input type="text" id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]" value="{{$vehicleArr[$i]}}"  class=" numberonly form-control  vehicle_id vehicle_id_auto_total"> */ ?>

                                                                <select  id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id" style="width:100%;">
                                                                    <option value=""></option>
                                                                    <option {{ ($vehicleArr[$i] == 'noVehicle') ? 'selected' : '' }} value="noVehicle">No Vehicle</option>
                                                                    @foreach($vehicle as $key => $value)
                                                                    <option value="{{$value->id}}" {{($value->id == $vehicleArr[$i]) ? 'selected':'' }}>{{$value->vehicle_no}}</option>
                                                                    @endforeach
                                                                <select>
                                                            </td>
                                                            <td>
                                                                <select  id="idling_minutes[{{$i}}]" name="idling_minutes[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 idling_minutes" style="width:100%;">
                                                                    @foreach($edit_ideal_min as $idealMin)
                                                                    <option value="{{$idealMin}}" {{($idling_minutes[$i] == $idealMin) ? 'selected':'' }}>{{$idealMin}}</option>
                                                                    @endforeach
                                                                <select>
                                                            </td>

                                                            <td>
                                                                <textarea rows="1" id="remarks[{{ $i }}}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                    @endif
                                                @endfor
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><label id="kms_er"></label></td>
                                                <td><label id="diesel_ltr_er"></label></td>
                                                <td><label id="diese_per_ltr_price_er"></label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><label id="parking_exp_er"></label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><label id="vehicle_id_er"></label></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Total</td>

                                                <td><input type="text" class="form-control"  name="total_kms" id="total_kms" value="" readonly></td>
                                                <td><input type="text" class="form-control" name="total_diesel" id="total_diesel" value="" readonly></td>
                                                <td></td>
                                                    <td><input type="text" class="form-control total_adblue" value="{{array_sum($adblue)}}" name="total_adblue" id="total_adblue" readonly></td>
                                                <td></td>
                                                <td><input type="text" class="form-control total_breaddown_charge" name="total_breaddown_charge" id="total_breaddown_charge" value="{{array_sum($breaddown_charge)}}" readonly></td>

                                                <td><input type="text" class="form-control total_vor_exp" name="total_vor_exp" value="{{array_sum($vor_exp)}}" id="total_vor_exp" readonly></td>

                                                <td><input type="text" class="form-control" name="total_parking_exp" id="total_parking_exp" readonly></td>

                                                <td><input type="text" class="form-control total_hault_exp"  value="{{array_sum($hault_tax)}}" name="total_hault_exp" id="total_hault_exp" readonly></td>

                                                <td><input type="text" class="form-control total_wash_exp"  value="{{array_sum($wash_exp)}}" name="total_wash_exp" id="total_wash_exp" readonly></td>

                                                <td><input type="text" class="form-control" name="total_other_exp" id="total_other_exp" readonly></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
							<table class="table table-bordered">
								<tr>
									<th>Total Kms/ एकुण किमी</th>
									<th>Total Filled Diesel/ प्रत्यक्ष पुरविलेले डिझेल (लिटर)</th>
									<th>Diesel as per norms/ महामंडळाने पुरवावयाचे डिझेल</th>
									<th>Extra Diesel Filled/ जादा/कमी पुरविलेले डिझेल</th>
								</tr>
								<tr>
									<td><input type="text" class="form-control"  name="kms_total" id="kms_total" readonly></td>
									<td><input type="text" class="form-control"  name="diesel_total" id="diesel_total" readonly></td>
									<td><input readonly type="text" data-precision="2" class="decimalonly form-control"  name="gov_diesel" id="gov_diesel" value="{{$parisishthab->diesel_as_per_gov}}" ></td>
									<td><input type="text" class="form-control"  name="extra_diesel" id="extra_diesel" readonly></td>
								</tr>
								<tr>
                                    <th colspan="3" style="text-align:right;">Extra Filled Diesel Charges / जादा पुरीविलेले डिझेलची वसुली</th>
                                    <td width="10%"><input type="text" class="form-control"  name="extra_diesel_charge" id="extra_diesel_charge" readonly ></td>
								</tr>
                                <tr>
                                    <th colspan="3" style="text-align:right;">Amount</th>
                                    <td width="10%"><input type="text" class="form-control total_amount amountonly" name="total_amount" value="{{ $parisishthab->total_amount }}" id="total_amount" readonly ></td>
								</tr>
                                <tr>
                                    <th colspan="3" style="text-align:right;">Total Deduction</th>
                                    <td width="10%"><input type="text" class="form-control total_charge amountonly" name="total_charge" value="{{ $parisishthab->total_charge }}" id="total_charge" readonly ></td>
								</tr>
                                <tr>
                                    <th colspan="3" style="text-align:right;"><span style="font-size:20px;">Grand Total</span></th>
                                    <td width="10%"><input type="text" class="form-control grand_amount amountonly" name="grand_amount" value="{{ $parisishthab->grand_amount }}" id="grand_amount" readonly ></td>
								</tr>
							</table>

							<div class="ln_solid"></div>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<input type="hidden" value="" name="status" id="status" />

											@if($parisishthab->status == 1)
												<button type="submit" onclick="setFlag(1)" id="save_submit" class="btn btn-primary"> Update And Submit </button>
											@else
												<button type="submit" onclick="setFlag(0)" id="save" class="btn btn-primary">{{ $btn }}</button>
												<button type="submit" onclick="setFlag(1)" id="save_submit" class="btn btn-primary">{{ $btn }} And Submit </button>
											@endif

									<a href="{{url($redirect)}}"  class="btn btn-warning" >Cancel </a>

								</div>
							</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
/* To get vehicle on invoice selection by sneha doso on 15-09-2018 */
jQuery(document).ready(function($){
    if ($('#id').val() > 0) {
        setTimeout(function() {
            $("#depot_id").trigger("change");
        }, 100);
    }

    $(".wrapper1").scroll(function(){
        $(".wrapper2")
            .scrollLeft($(".wrapper1").scrollLeft());
    });
    $(".wrapper2").scroll(function(){
        $(".wrapper1")
            .scrollLeft($(".wrapper2").scrollLeft());
    });

    $("body").on("change","#invoice_no",function(){
        $(".blockUI").show();
        $.ajax({
            url:'{{ url("/checkduplicateinvoiceno")}}',
            type: "post",
            dataType:'json',
            data:
            {
                action:'{{$action}}',
                id: @if($action=='update') {{$parisishthab->id}} @else 0 @endif,
                invoice_no: function()
                {
                    return $('#frm_single :input[name="invoice_no"]').val();
                },
            },
            success:function(result){
                if(result==false){
                    alert('Invoice No Already Exist');
                    $("#invoice_no").val('');
                    $(".blockUI").hide();
                    return false;
                }
                $(".blockUI").hide();
            }
        });
    });

});
/* End To get vehicle on invoice selection by sneha doso on 15-09-2018 */

jQuery(document).ready(function($){

    /* auto fill start from pratik donga on 17-09-2018 */

    $('body').on('change',".diese_per_ltr_price_auto",function(){
        var diese_per_ltr_price =  $(this).closest('tr').find('.diese_per_ltr_price_auto').val();
        $(".diese_per_ltr_price_auto_total").val(diese_per_ltr_price);
    });
    $('body').on('change',".adblue_auto",function(){
        var adblue =  $(this).closest('tr').find('.adblue_auto').val();
        $(".adblue_auto_total").val(adblue);
        getTotal();
    });
    $('body').on('change',".adblue_price_auto",function(){
        var adblue_price =  $(this).closest('tr').find('.adblue_price_auto').val();
        $(".adblue_price_auto_total").val(adblue_price);
    });

    $('body').on('change',".parking_exp_auto",function(){
        $(".parking_exp").trigger('keyup');
    });
    $('body').on('change',".wash_exp_auto",function(){
        getTotal();
    });

    /* auto fill end from pratik donga on 17-09-2018 */

	$("body").on("change","#vendor_id",function(e){
        var vendor_id = $(this).val();
        $.ajax({
            type:'POST',
            url:'{{url('/getinvoice')}}',
            data:{
            vendor_id:vendor_id
            },
            success:function(result){
                $("#invoice_no").empty().html(result);
            }
        });
    });

	/* For Calc Total */
	function getTotal()
	{
        /* total for wash_exp */
        var washExp =$(".wash_exp").map(function(){return $(this).val();}).get().join(",");
		var washExpVal = washExp;
        arrWashExp = washExpVal.split(',');

		var totalWashExp=0;
		for(i=0; i < arrWashExp.length; i++)
		{
			if(arrWashExp[i]!='')
			{
				totalWashExp += parseFloat(arrWashExp[i]);
			}
		}
		if(isNaN(totalWashExp) || totalWashExp == '')
        {
            totalWashExp=0;
        }
        $('.table tfoot').find('#total_wash_exp').val(totalWashExp.toFixed(2));


		var adblue = $(".adblue").map(function(){return $(this).val();}).get().join(",");
		var adblueVal = adblue;
		arr1 = adblueVal.split(',');
		var totalAddBlue = 0;
		for(i=0; i < arr1.length; i++)
		{
			if(arr1[i]!='')
			{
				totalAddBlue += parseFloat(arr1[i]);
			}
		}
		if(isNaN(totalAddBlue))
        {
            totalAddBlue=0;
        }
        $('.table tfoot').find('#total_adblue').val(totalAddBlue.toFixed(2));


		var breaddown_charge =$(".breaddown_charge").map(function(){return $(this).val();}).get().join(",");
		var breaddown_chargeVal = breaddown_charge;
		arr2 = breaddown_chargeVal.split(',');
		var totalbreaddown=0;
		for(i=0; i < arr2.length; i++)
		{
			if(arr2[i]!='')
			{
				totalbreaddown += parseFloat(arr2[i]);

			}

		}
		if(isNaN(totalbreaddown))
        {
            totalbreaddown=0;
        }
        $('.table tfoot').find('#total_breaddown_charge').val(totalbreaddown.toFixed(2));


		var vor_exp =$(".vor_exp").map(function(){return $(this).val();}).get().join(",");
		var vor_expVal = vor_exp;
		arr3 = vor_expVal.split(',');
		var totalvorexp=0;
		for(i=0; i < arr3.length; i++)
		{
			if(arr3[i]!='')
			{
				totalvorexp += parseFloat(arr3[i]);
			}
		}
		if(isNaN(totalvorexp))
        {
            totalvorexp=0;
        }

        $('.table tfoot').find('#total_vor_exp').val(totalvorexp.toFixed(2));


        var parking_exp =$(".parking_exp").map(function(){return $(this).val();}).get().join(",");
		var parking_expVal = parking_exp;
		arr5 = parking_expVal.split(',');
        var totalparkingexp=0;
		for(i=0; i < arr5.length; i++)
		{
			if(arr5[i]!='')
			{
                totalparkingexp += parseFloat(arr5[i]);

			}
		}
		if(isNaN(totalparkingexp))
        {
            totalparkingexp=0;
        }

		$('.table tfoot').find('#total_parking_exp').val(totalparkingexp.toFixed(2));


		var hault_exp =$(".hault_exp").map(function(){return $(this).val();}).get().join(",");
		var hault_expVal = hault_exp;
		arr4 = hault_expVal.split(',');
		var totalhaultexp=0;
		for(i=0; i < arr4.length; i++)
		{
			if(arr4[i]!='')
			{
				totalhaultexp += parseFloat(arr4[i]);
			}

		}
		if(isNaN(totalhaultexp))
			{
				totalhaultexp=0;
			}
            $('.table tfoot').find('#total_hault_exp').val(totalhaultexp.toFixed(2));

        var total_breaddown_charge = $('#total_breaddown_charge').val();
        var total_vor_exp = $('#total_vor_exp').val();
        calculateparkingcharges();
        var total_parking_exp = $('#total_parking_exp').val();
        var total_hault_exp = $('#total_hault_exp').val();
        var total_wash_exp = $('#total_wash_exp').val();
        calculateotherexp();
        var total_other_exp = $('#total_other_exp').val();

        if(isNaN(total_breaddown_charge) || total_breaddown_charge == ''){
            total_breaddown_charge = 0;
        }

        if(isNaN(total_vor_exp) || total_vor_exp == ''){
            total_vor_exp = 0;
        }

        if(isNaN(total_parking_exp) || total_parking_exp == ''){
            total_parking_exp = 0;
        }

        if(isNaN(total_hault_exp) || total_hault_exp == ''){
            total_hault_exp = 0;
        }

        if(isNaN(total_wash_exp) || total_wash_exp == ''){
            total_wash_exp = 0;
        }
        if(isNaN(total_other_exp) || total_other_exp == ''){
            total_other_exp = 0;
        }

        var totalDeduct = parseFloat(total_breaddown_charge)+parseFloat(total_vor_exp)+parseFloat(total_parking_exp)+parseFloat(total_hault_exp)+parseFloat(total_wash_exp)+parseFloat(total_other_exp);

        if(isNaN(totalDeduct) || totalDeduct == ''){
            totalDeduct = 0;
        }

        var extra_diesel_charge = $('#extra_diesel_charge').val();
        var total_adblue = $('#total_adblue').val();

        /* adblue Calculation start */
        var adbluePrice = $(".adblue_price").map(function(){return $(this).val();}).get().join(",");
		adbluePriceArr = adbluePrice.split(',');
		var totalAdbluePrice = 0;
		var totaladblueCount = 0;
        for (i=0; i < adbluePriceArr.length; i++) {
			if (adbluePriceArr[i] != '' ) {
                if (adbluePriceArr[i] > 0) {
                    totalAdbluePrice += parseFloat(adbluePriceArr[i]);
                    totaladblueCount++;
                }
			}
		}

		if (isNaN(totalAdbluePrice)) {
            totalAdbluePrice = 0;
        }
        

        var totalAdblueAvgPrice = totalAdbluePrice / totaladblueCount;
        /* adblue Calculation End */

        if(isNaN(extra_diesel_charge) || extra_diesel_charge == ''){
            extra_diesel_charge = 0;
        }

        if(isNaN(total_adblue) || total_adblue == ''){
            total_adblue = 0;
        }

        if(isNaN(totalAdblueAvgPrice) || totalAdblueAvgPrice == ''){
            totalAdblueAvgPrice = 0;
        }

        var adblue_val = parseFloat(total_adblue)*parseFloat(totalAdblueAvgPrice);
        if(isNaN(adblue_val) || adblue_val == ''){
            adblue_val = 0;
        }

        var allDeduct = parseFloat(totalDeduct)+parseFloat(adblue_val)+parseFloat(extra_diesel_charge);

        if(isNaN(allDeduct) || allDeduct == ''){
            allDeduct = 0;
        }

        $('body').find('#total_charge').val(allDeduct);
        var subTotal = $('body').find('#total_amount').val();
        if(isNaN(subTotal) || subTotal == ''){
            subTotal = 0;
        }

        var grandTotal = parseFloat(subTotal)-parseFloat(allDeduct);
        if(isNaN(grandTotal) || grandTotal == '' ){
            grandTotal = 0;
        }
        $('body').find('#grand_amount').val(grandTotal.toFixed(2));
	}

    function IdlingMinutes()
    {
        var DisealTotal = $("#diesel_total").val();
        var IdlingMin =$(".idling_minutes").map(function(){return $(this).val();}).get().join(",");
		var Idling_minVal = IdlingMin;
        arr5 = Idling_minVal.split(',');
		var totalIdlingMin=0;

		for(i=0; i < arr5.length; i++)
		{
			if(arr5[i]!='' && arr5[i]!=0)
			{
				totalIdlingMin += (parseFloat(arr5[i])*6)/100;
			}
        }

        if(isNaN(totalIdlingMin))
        {
            totalIdlingMin=0;
        }

        if(isNaN(DisealTotal))
        {
            DisealTotal=0;
        }

        var total_diseal_min = parseFloat(totalIdlingMin) - parseFloat(DisealTotal)
        $('.table tfoot').find('#diesel_total').val(total_diseal_min.toFixed(2));

    }

   /*Idling Minutes Calculation start */
    $("body").on("change",".idling_minutes",function(){
        calculatediesel();
        IdlingMinutes();
	});
    /*Idling Minutes Calculation end */

	/* Ad Blue Cal Event */
	$("body").on("change",".adblue",function(){
		getTotal();
    });

    $("body").on("change",".adblue_price",function(){
		getTotal();
    });


	$("body").on("change",".breaddown_charge",function(){
		getTotal();
	});

	$("body").on("change",".vor_exp",function(){
		getTotal();
    });

    $("body").on("change",".parking_exp",function(){
		getTotal();
	});

	$("body").on("change",".hault_exp",function(){
		getTotal();
    });

    $("body").on("change",".wash_exp",function(){
		getTotal();
    });

    var datevalidate =true;
	var date = new Date();
	var y = date.getFullYear();
	var m = date.getMonth();
    var lastDay = new Date(y, m + 1, 0);
	//form date and to date on change
	$('#from_date,#to').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: lastDay,
	}).on('changeDate', function(e) {
        if($("#from_date").val()!='') {
            var minDate = new Date(e.date.valueOf());
            $('#to').datepicker('setStartDate', minDate);
        }
        if($("#from_date").val()!='' && $("#to").val()!=''){
            var fdt = $("#from_date").val();
            var tdt = $("#to").val();
            $.ajax({
                type: "POST",
                url:"{{url('invoiceCheckdate')}}",
                data:{from_date:$("#from_date").val(),to_date:$("#to").val()
                },
                dataType:"json",
                success: function(res)
                {
                    if(res.success==false)
                    {
                        $("#from_date").val('');
                        $("#to").val('');
                        $(".clonedTr").remove();
                        swal(res.message, "", "error");
                        datevalidate=false;
                        $("#save").prop("disabled",true);
                    }
                    else
                    {
                        checkVehicleValidate();
                    }
                }
             });
        }
	});
	// on change end

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
        var stdate = $("#from_date").val();
        currentDate = new Date(start.getTime());
        var toDayDate = new Date();

		var $trclone='<tr class="parishishtha_b"><td><input type="text" id="date_pb[0]" name="date_pb[0]"  class="date_pb form-control"></td><td><select  id="vehicle_id" name="vehicle_id[]" class="form-control select2_single col-md-7 col-xs-12 vehicle_id " style="width:100%;"><option value=""></option><select></td><td><input type="text" id="kms[0]" name="kms[0]"  class="decimalonly kms form-control" /></td><td><input type="text" data-precision="2" id="diesel_ltr[0]" name="diesel_ltr[0]"  class="decimalonly form-control  diesel_ltr"></td><td><input type="text" id="diese_per_ltr_price[0]" name="diese_per_ltr_price[0]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2"></td><td><input type="text" id="adblue[0]" name="adblue[0]"  class="form-control adblue decimalonly" data-precision="2"></td><td><input type="text" id="adblue_price[0]" name="adblue_price[0]"  class="form-control  adblue_price decimalonly" data-precision="2"></td><td><input type="text" id="breaddown_charge[0]" name="breaddown_charge[0]"  class="numberonly form-control  breaddown_charge" ></td><td><input type="text" id="vor_exp[0]" name="vor_exp[0]"  class="numberonly form-control vor_exp"></td><td><input type="text" id="parking_exp[0]" name="parking_exp[0]"  class="numberonly form-control  parking_exp"></td><td><input type="text" id="hault_exp[0]" name="hault_exp[0]"  class=" numberonly form-control  hault_exp"></td><td><input type="text" id="other_exp[0]" name="other_exp[0]"  class=" numberonly form-control  other_exp"></td><td><textarea id="remarks[0]" name="remarks[0]"  class="form-control  remarks "></textarea></td></tr>';


    var $t = $('#parishishtha_b tbody tr:first');
    $(".clonedTr").remove();
        for(i=0;i<length;i++)
        {
            if(i==0)
            {
                $t.find(".date_pb").val(stdate).attr('readonly','readonly').unbind();
                currentDate.setDate(currentDate.getDate() + 1);
                $t.find("span").remove();
                $t.find("select").select2({placeholder: "Select",alowClear:true});
                $t.find(".vehicle_id").addClass('vehicle_id_auto');
                $t.find(".kms").addClass('kms_auto');
                $t.find(".diesel_ltr").addClass('diesel_ltr_auto');
                $t.find(".diese_per_ltr_price").addClass('diese_per_ltr_price_auto');
                $t.find(".adblue").addClass('adblue_auto');
                $t.find(".adblue_price").addClass('adblue_price_auto');
                $t.find(".breaddown_charge").addClass('breaddown_charge_auto');
                $t.find(".hault_exp").addClass('hault_exp_auto');
                $t.find(".other_exp").addClass('other_exp_auto');
                $t.find(".idling_minutes").addClass('idling_minutes_auto');
                continue;
            } else {
                $t.find(".vehicle_id").addClass('vehicle_id_auto_total');
                $t.find(".kms").addClass('kms_auto_total');
                $t.find("span").remove();
                $t.find("select").select2({placeholder: "Select",
                    alowClear:true});
                $t.find(".diesel_ltr").addClass('diesel_ltr_auto_total');
                $t.find(".diese_per_ltr_price").addClass('diese_per_ltr_price_auto_total');
                $t.find(".adblue").addClass('adblue_auto_total');
                $t.find(".adblue_price").addClass('adblue_price_auto_total');
                $t.find(".breaddown_charge").addClass('breaddown_charge_auto_total');
                $t.find(".hault_exp").addClass('hault_exp_auto_total');
                $t.find(".other_exp").addClass('other_exp_auto_total');
                $t.find(".idling_minutes").addClass('idling_minutes_auto_total');
            }

            var num = $('.parishishtha_b').length;
            var $clone=$t.clone();
            $clone.addClass('clonedTr');


            if(currentDate >= toDayDate){
                $clone.find(".date_pb").attr('readonly','readonly');
                $clone.find(".vehicle_id").attr('disabled','disabled').removeClass('vehicle_id_auto_total');
                $clone.find(".schedule_complete").attr('disabled','disabled');
                $clone.find(".kms").attr('readonly','readonly').removeClass('kms_auto_total');
                $clone.find(".diesel_ltr").attr('readonly','readonly').removeClass('diesel_ltr_auto_total');
                $clone.find(".diese_per_ltr_price").attr('readonly','readonly').removeClass('diese_per_ltr_price_auto_total');
                $clone.find(".adblue").attr('readonly','readonly').removeClass('adblue_auto_total');
                $clone.find(".adblue_price").attr('readonly','readonly').removeClass('adblue_price_auto_total');
                $clone.find(".breaddown_charge").attr('readonly','readonly').removeClass('breaddown_charge_auto_total');
                $clone.find(".vor_exp").attr('disabled','disabled');
                $clone.find(".parking_exp").attr('disabled','disabled');
                $clone.find(".hault_exp").attr('readonly','readonly').removeClass('hault_exp_auto_total');
                $clone.find(".wash_exp").attr('disabled','disabled');
                $clone.find(".other_exp").attr('readonly','readonly').removeClass('other_exp_auto_total');
                $clone.find(".idling_minutes").attr('disabled','disabled').removeClass('idling_minutes_auto_total');
            }

            $("#parishishtha_b tbody").children().last().after($clone);

            $clone.find(".date_pb").attr('id', 'date_pb['+num+']').attr('name', 'date_pb['+num+']');
            $clone.find(".date_pb").removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',currentDate).unbind();
            $clone.find("span").remove();
            $clone.find("select").select2({placeholder: "Select",
            alowClear:true});
            $clone.find(".schedule_complete").attr('id', 'schedule_complete['+num+']').attr('name', 'schedule_complete['+num+']');
            $clone.find(".s_c_v").attr('id', 's_c_v['+num+']').attr('name', 's_c_v['+num+']');
            $clone.find(".kms").attr('id', 'kms['+num+']').attr('name', 'kms['+num+']').removeClass('kms_auto');
            $clone.find(".vehicle_id").attr('id', 'vehicle_id['+num+']').attr('name', 'vehicle_id['+num+']').removeClass('vehicle_id_auto');
            $clone.find(".diesel_ltr").attr('id', 'diesel_ltr['+num+']').attr('name', 'diesel_ltr['+num+']').removeClass('diesel_ltr_auto');
            $clone.find(".diese_per_ltr_price").attr('id', 'diese_per_ltr_price['+num+']').attr('name', 'diese_per_ltr_price['+num+']').removeClass('diese_per_ltr_price_auto');
            $clone.find(".adblue").attr('id', 'adblue['+num+']').attr('name', 'adblue['+num+']').removeClass('adblue_auto');
            $clone.find(".adblue_price").attr('id', 'adblue_price['+num+']').attr('name', 'adblue_price['+num+']').removeClass('adblue_price_auto');
            $clone.find(".breaddown_charge").attr('id', 'breaddown_charge['+num+']').attr('name', 'breaddown_charge['+num+']').removeClass('breaddown_charge_auto');
            $clone.find(".vor_exp").attr('id', 'vor_exp['+num+']').attr('name', 'vor_exp['+num+']');
            $clone.find(".parking_exp").attr('id', 'parking_exp['+num+']').attr('name', 'parking_exp['+num+']');
            $clone.find(".hault_exp").attr('id', 'hault_exp['+num+']').attr('name', 'hault_exp['+num+']').removeClass('hault_exp_auto');
            $clone.find(".wash_exp").attr('id', 'wash_exp['+num+']').attr('name', 'wash_exp['+num+']');
            $clone.find(".other_exp").attr('id', 'other_exp['+num+']').attr('name', 'other_exp['+num+']').removeClass('other_exp_auto');
            $clone.find(".idling_minutes").attr('id', 'idling_minutes['+num+']').attr('name', 'idling_minutes['+num+']').removeClass('idling_minutes_auto');
            $clone.find(".remarks").attr('id', 'remarks['+num+']').attr('name', 'remarks['+num+']').removeClass('remarks_auto');

            currentDate.setDate(currentDate.getDate() + 1);
                $clone.find('td').each(function() {
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
		}
	}
    /** function for cloning end*/

    /* Get depo On Depot */
    $("body").on("change","#division_id",function(){
        var division_id = $(this).val();
        $.ajax({
            url:'{{url('/getparisishthadepotondivision')}}',
            type:'POST',
            data:{
                division_id:division_id
            },
            success:function(result){
                $("#depot_id").empty().html(result);
            }
        });
    });

    $("body").on("change","#depot_id",function(){
        var division_id = $('#division_id').val();
        var depot_id = $(this).val();
        var vendor_id = $('#vendor_id').val();

        $.ajax({
            url:'{{url('/getRoutesVehicle')}}',
            type:'POST',
            dataType:'json',
            data:{
                vendor_id : vendor_id,
                division_id:division_id,
                depot_id : depot_id
            },
            success:function(data){

                if (data.status) {
                    var routhtml = '<option value="" ></option>';
                    $.each(data.routes,function(i,v) {
                        @if(isset($parisishthab->route_id))
                                if(v.id=="{{$parisishthab->route_id}}")
                                {
                                    routhtml += '<option value="'+v.id+'" selected>'+v.from_depot+' - '+v.to_depot+' ('+v.scheduled_time+') </option>';

                                }
                                else
                                {
                                    routhtml += '<option value="'+v.id+'" >'+v.from_depot+' - '+v.to_depot+' ('+v.scheduled_time+') </option>';
                                }
                            @else
                                routhtml += '<option value="'+v.id+'" >'+v.from_depot+' - '+v.to_depot+' ('+v.scheduled_time+') </option>';
                            @endif

                    });

                    $('#route_id').html(routhtml);
                }
            }
        });
    });

    $(document).on('click',".add",function(){

        var $tr = $(this).closest('.parishishtha_b');
        var $clone = $tr.clone();
        $tr.after($clone);

        var num = $('.parishishtha_b').length;

        $clone.find("span").remove();
        $clone.find("select").select2({placeholder: "Select",
            alowClear:true});

            $clone.find(".date_pb").attr('id', 'date_pb['+num+']').attr('name', 'date_pb['+num+']');
            $clone.find(".date_pb") .removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yy',autoclose:true,});

            $clone.find(".kms").attr('id', 'kms['+num+']').attr('name', 'kms['+num+']');
            $clone.find(".vehicle_id").attr('id', 'vehicle_id['+num+']').attr('name', 'kms['+num+']');
            $clone.find(".diesel_ltr").attr('id', 'diesel_ltr['+num+']').attr('name', 'diesel_ltr['+num+']');
            $clone.find(".diese_per_ltr_price").attr('id', 'diese_per_ltr_price['+num+']').attr('name', 'diese_per_ltr_price['+num+']');
            $clone.find(".adblue").attr('id', 'adblue['+num+']').attr('name', 'adblue['+num+']').val('');
            $clone.find(".adblue_price").attr('id', 'adblue_price['+num+']').attr('name', 'adblue_price['+num+']').val('');
            $clone.find(".breaddown_charge").attr('id', 'breaddown_charge['+num+']').attr('name', 'breaddown_charge['+num+']').val('');
            $clone.find(".vor_exp").attr('id', 'vor_exp['+num+']').attr('name', 'vor_exp['+num+']').val('');
            $clone.find(".parking_exp").attr('id', 'parking_exp['+num+']').attr('name', 'parking_exp['+num+']');
            $clone.find(".hault_exp").attr('id', 'hault_exp['+num+']').attr('name', 'hault_exp['+num+']').val();
            $clone.find(".wash_exp").attr('id', 'wash_exp['+num+']').attr('name','wash_exp['+num+']').val();
            $clone.find(".other_exp").attr('id', 'other_exp['+num+']').attr('name','other_exp['+num+']');
            $clone.find(".remarks").attr('id', 'remarks['+num+']').attr('name','remarks['+num+']');

            $clone.find('td').each(function() {
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
                $(this).find('.schedule_complete').attr('name','schedule_complete['+i+']').attr('id','schedule_complete['+i+']');
                $(this).find('.kms').attr('name','kms['+i+']').attr('id','kms['+i+']');
                $(this).find('.vehicle_id').attr('name','vehicle_id['+i+']').attr('id','vehicle_id['+i+']');
                $(this).find('.diesel_ltr').attr('name','diesel_ltr['+i+']').attr('id','diesel_ltr['+i+']');
                $(this).find('.diese_per_ltr_price').attr('name','diese_per_ltr_price['+i+']').attr('id','diese_per_ltr_price['+i+']');
                $(this).find('.adblue').attr('name','adblue['+i+']').attr('id','adblue['+i+']');
                $(this).find('.adblue_price').attr('name','adblue_price['+i+']').attr('id','adblue_price['+i+']');
                $(this).find('.breaddown_charge').attr('name','breaddown_charge['+i+']').attr('id','breaddown_charge['+i+']');
                $(this).find('.vor_exp').attr('name','vor_exp['+i+']').attr('id','vor_exp['+i+']');
                $(this).find('.parking_exp').attr('name','parking_exp['+i+']').attr('id','parking_exp['+i+']');
                $(this).find('.hault_exp').attr('name','hault_exp['+i+']').attr('id','hault_exp['+i+']');
                $(this).find('.wash_exp').attr('name','wash_exp['+i+']').attr('id','wash_exp['+i+']');
                $(this).find('.other_exp').attr('name','other_exp['+i+']').attr('id','other_exp['+i+']');
                $(this).find('.idling_minutes').attr('name','idling_minutes['+i+']').attr('id','idling_minutes['+i+']');
                $(this).find('.remarks').attr('name','remarks['+i+']').attr('id','remarks['+i+']');
                i++;
            });
            }
        }

        $('body').on('change', '.vehicle_id', function(e){
            /* check validation for no vehicle start*/
            var vehicle_id = $(this).closest('tr').find('.vehicle_id').val();
            var diesel_ltr = $(this).closest('tr').find('.diesel_ltr').val();
            var kms = $(this).closest('tr').find('.kms').val();

            if(diesel_ltr != '' && kms != '') {
                if (kms == 0 && diesel_ltr == 0) {
                    if (vehicle_id != 'noVehicle') {
                        swal("warning", "Please Select Novehicle on Vehicle List","warning");
                        $(this).closest('tr').find('.vehicle_id').val('noVehicle').trigger('change');
                    }
                } else {
                    if (vehicle_id == 'noVehicle') {
                        $(this).closest('tr').find('.vehicle_id').val('').trigger('change');
                    }
                }
            }
            /* check validation for no vehicle end*/
        });

        $('body').on('keyup','.kms',function(e){

            /* check validation for no vehicle start*/
            var vehicle_id = $(this).closest('tr').find('.vehicle_id').val();
            var diesel_ltr = $(this).closest('tr').find('.diesel_ltr').val();
            var kms = $(this).closest('tr').find('.kms').val();

            if(diesel_ltr != '' && vehicle_id != '') {
                if (kms == 0 && diesel_ltr == 0) {
                    if (vehicle_id != 'noVehicle') {
                        $(this).closest('tr').find('.vehicle_id').val('noVehicle').trigger('change');
                    }
                } else {
                    if (vehicle_id == 'noVehicle') {
                        $(this).closest('tr').find('.vehicle_id').val('').trigger('change');
                    }
                }
            }
            /* check validation for no vehicle end*/

            var route_id = $('#route_id').val();
            var vehicle_id = $(this).closest('tr').find('.vehicle_id').val();
            if(route_id == ''){
                $('.kms').val('');
            }
            var route_km = $('#route_km').val();
            var kms = $(".kms").map(function(){return $(this).val();}).get().join(",");

            var kmsVal = kms;
            kmsarr = kmsVal.split(',');
            var totalDays = 0;
            for(i=0; i < kmsarr.length; i++){
                if (isNaN(kmsarr[i]) || kmsarr[i] == '') {
                    kmsarr[i] = 0;
                }
                
                if(parseFloat(route_km) <= parseFloat(kmsarr[i])){
                    totalDays += parseFloat(1);
                } else {
                    var checkedCustomer = $.map($('input[name="schedule_complete['+i+']"]:checked'), function(e){return e.value; });
                    
                    if (checkedCustomer.length > 0) {
                        totalDays++;
                    }
                }
            }
            
            if(isNaN(totalDays) || totalDays == ''){
                totalDays = 0;
            }
            calculatekms();
            var total_kms = $('#total_kms').val();

            var avgKm = parseFloat(total_kms)/parseFloat(totalDays);

            if(avgKm != '' && route_id != ''){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{url('/getavgrate')}}',
                    type:'POST',
                    dataType:'json',
                    async:false,
                    data:{avgKm:avgKm,route_id:route_id},
                    success:function(result){
                        var totalAmount = total_kms*result;
                        if(isNaN(totalAmount) && totalAmount == ''){
                            totalAmount = 0;
                        }
                        $('body').find('#total_amount').val(totalAmount.toFixed(2));
                    }
                });
            }
            getTotal();
        });

        $('body').on('click', '.schedule_complete', function(e){
            var route_id = $('#route_id').val();
            var vehicle_id = $(this).closest('tr').find('.vehicle_id').val();
            if(route_id == ''){
                $('.kms').val('');
            }
            var route_km = $('#route_km').val();
            var kms = $(".kms").map(function(){return $(this).val();}).get().join(",");

            var kmsVal = kms;
            kmsarr = kmsVal.split(',');
            var totalDays = 0;
            for(i=0; i < kmsarr.length; i++){
                if (isNaN(kmsarr[i]) || kmsarr[i] == '') {
                    kmsarr[i] = 0;
                }
                
                if(parseFloat(route_km) <= parseFloat(kmsarr[i])){
                    totalDays += parseFloat(1);
                } else {
                    var checkedCustomer = $.map($('input[name="schedule_complete['+i+']"]:checked'), function(e){return e.value; });
                    
                    if (checkedCustomer.length > 0) {
                        totalDays++;
                    }
                }
            }
            
            if(isNaN(totalDays) || totalDays == ''){
                totalDays = 0;
            }
            calculatekms();
            var total_kms = $('#total_kms').val();

            var avgKm = parseFloat(total_kms)/parseFloat(totalDays);

            if(avgKm != '' && route_id != ''){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{url('/getavgrate')}}',
                    type:'POST',
                    dataType:'json',
                    async:false,
                    data:{avgKm:avgKm,route_id:route_id},
                    success:function(result){
                        var totalAmount = total_kms*result;
                        if(isNaN(totalAmount) && totalAmount == ''){
                            totalAmount = 0;
                        }
                        $('body').find('#total_amount').val(totalAmount.toFixed(2));
                    }
                });
            }
            getTotal();
        });

        $('body').on('change','#route_id',function(e){
            var route_id = $(this).val();

            if(route_id ==''){
                $('#route_km').val('');
                return false;
            }else{
                $.ajax({
                    url:'{{url('/getschedulekm')}}',
                    type:'POST',
                    dataType:'json',
                    data:{route_id:route_id},
                    success:function(result){
                        $('#route_km').val(result);
                        $('#sch_km').text("Min. Schedule KM : "+result);
                    }
                });

                $.ajax({
                url:'{{url('/getScheduleNumber')}}',
                    type:'POST',
                    dataType:'json',
                    data:{route_id:route_id},
                    success:function(result){
                        $('#schedule_number').val(result);
                    }
                });

                $.ajax({
                    type:'POST',
                    url:'{{url("/getIdelingminutesInvoice")}}',
                    data:{ route_id:route_id },
                    success:function(option){
                        $(".idling_minutes").html(option);
                    }
                });
            }

            $('.kms').trigger('change');
        });

        $(document).on('click','.minus' ,function(event){
            if($(".parishishtha_b").length>1){
                $(this).closest(".parishishtha_b").remove();
               indexing();
               calculatekms();
               calculatediesel();
               calculateparkingcharges();
               calculateotherexp();
               getTotal();
            }
        });
        $(document).on('keyup','.kms',function(){
            calculatekms();
            getTotal();
        });
        $(document).on('keyup',".diesel_ltr",function(){
            calculatediesel();
            getTotal();
            
            /* check validation for no vehicle start*/
            var vehicle_id = $(this).closest('tr').find('.vehicle_id').val();
            var diesel_ltr = $(this).closest('tr').find('.diesel_ltr').val();
            var kms = $(this).closest('tr').find('.kms').val();

            if(kms != '' && vehicle_id != '') {
                if (kms == 0 && diesel_ltr == 0) {
                    if (vehicle_id != 'noVehicle') {
                        $(this).closest('tr').find('.vehicle_id').val('noVehicle').trigger('change');
                    }
                } else {
                    if (vehicle_id == 'noVehicle') {
                        $(this).closest('tr').find('.vehicle_id').val('').trigger('change');
                    }
                }
            }
            /* check validation for no vehicle end*/
        });
        $(document).on('keyup',".parking_exp",function(){
            calculateparkingcharges();
            getTotal();
        });
        $(document).on('keyup',".other_exp",function(){
            calculateotherexp();
            getTotal();
        });

        function calculatekms()
        {
            var total_kms=0;
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

            $('.table tfoot').find("#total_kms").val(total_kms);
            $("#kms_total").val(total_kms);

            var gov_diesel = parseFloat(total_kms)/parseFloat(4.3);
            $('#gov_diesel').val(gov_diesel.toFixed(2));

            var diesel=parseFloat($("#diesel_total").val());
            var extra=diesel-gov_diesel;
            if(isNaN(extra)){
                extra = 0;
            }
            $("#extra_diesel").val(extra.toFixed(2));
            calculatediesel();
            calculateextra();
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

            var IdlingMin =$(".idling_minutes").map(function(){return $(this).val();}).get().join(",");
            var Idling_minVal = IdlingMin;
            arr5 = Idling_minVal.split(',');
            var totalIdlingMin=0;
            for(i=0; i < arr5.length; i++)
            {
                if(arr5[i]!='' && arr5[i]!=0)
                {
                    totalIdlingMin += (parseFloat(arr5[i])*6)/100;
                }
            }

            if(isNaN(totalIdlingMin))
            {
                totalIdlingMin=0;
            }

            var ttl_min = total_diesel - totalIdlingMin ;

            $('.table tfoot').find("#total_diesel").val(total_diesel);
            $("#diesel_total").val(ttl_min.toFixed(2));
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
            $('.table tfoot').find("#total_parking_exp").val(total_parking_exp);
        }

        function calculateotherexp()
        {
            var total_other_exp=0
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

            $('.table tfoot').find("#total_other_exp").val(total_other_exp);
        }

        $("#gov_diesel").on('keyup',function(){
            var gov=parseFloat($(this).val());
            var diesel = parseFloat($("#diesel_total").val());
            var  extra = diesel-gov;
            if(isNaN(extra))
            {
                extra = 0;
            }
            $("#extra_diesel").val(extra.toFixed(2));
            calculatediesel();
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
        /* When Click On Save  At Time Validation Hardik */
        $("body").on("click","#save",function(e){
            /* Destroy Old Fired Validaton */
            $('#frm_single').data('validator', null);
            $("#frm_single").unbind('validate');

            $('#frm_single').validate({
                ignore: '.select2-input, .select2-focusser',
                errorClass: 'errors',
                rules:
                {
                    depot_id:{required:true,},
                    route_id:{required:true},

                    vendor_id:{required:true,},
                    from_date:{required:true,},
                    to:{required:true,},
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
                    from_date:{required:"Please Select From Date",},
                    to:{required:"Please Select to Date",},
                    depot_id:{
                        required:"Please Select Depot",
                    },
                    route_id:{
                        required:"Please Select Route",
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
                },
                errorPlacement: function(error, element) {
                    if(element.is('select')) {
                        error.insertAfter(element.next());
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        });

        /* When Click On Save And Submit Button At Time Validation Hardik */
        $("body").on("click","#save_submit",function(e){
            /* Destroy Old Fired Validation */
        $('#frm_single').data('validator', null);
        $("#frm_single").unbind('validate');

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
                invoice_no:{required:true,},
                from_date:{required:true,},
                to:{required:true,},
                depot_id:{
                    required:true,
                },
                route_id:{
                    required:true,
                },
                gov_diesel:{
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
                invoice_no:{
                    required:"Please Enter Invoice No",
                },
                from_date:{required:"Please Select From Date",},
                to:{required:"Please Select to Date",},
                depot_id:{
                    required:"Please Select Depot",
                },
                route_id:{
                    required:"Please Select Route",
                },
                /*source_id:{required:"Please Select Source",},
                destination_id:{required:"Please Select Destination",},*/

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
        });

        $("body").on("change",'.schedule_complete',function() {
            if($(this).is(":checked")) {
                $tr = $(this).closest('tr');
                $tr.find('.s_c_v').val('1');
            }
            else
            {
                $tr = $(this).closest('tr');
                $tr.find('.s_c_v').val('0');
            }
        });


        $("body").on("click","#save_submit",function(e){
            e.preventDefault();
            if($("#frm_single").valid())
            {

                var kms_a = [];
                var checkVehicle = [];
                var diesel_ltr_a = [];
                var diese_per_ltr_price_a = [];
                var parking_exp_a = [];
                $('.kms').each(function (){

                        if($(this).val() == '' )
                        {
                            kms_a.push(0);

                        }
                        else
                        {
                            kms_a.push(1);
                        }

                    });

                    $('.vehicle_id').each(function (){
                    if($(this).val() == '' )
                    {
                        checkVehicle.push(0);
                    }
                    else
                    {
                        checkVehicle.push(1);
                    }
                });

                    $('.diesel_ltr').each(function (){

                        if($(this).val() == '' )
                        {
                            diesel_ltr_a.push(0);

                        }
                        else
                        {
                            diesel_ltr_a.push(1);
                        }
                    });

                    $('.diese_per_ltr_price').each(function (){

                        if($(this).val() == '' )
                        {
                            diese_per_ltr_price_a.push(0);

                        }
                        else
                        {
                            diese_per_ltr_price_a.push(1);
                        }
                    });

                    $('.parking_exp').each(function (){

                        if($(this).val() == '' )
                        {
                            parking_exp_a.push(0);
                        }
                        else
                        {
                            parking_exp_a.push(1);
                        }
                    });
                    var kms_er = kms_a.indexOf(0);
                    var vehicle_er = checkVehicle.indexOf(0);

                    var diesel_ltr_er = diesel_ltr_a.indexOf(0);
                    var diese_per_ltr_price_er = diese_per_ltr_price_a.indexOf(0);
                    var parking_exp_er = parking_exp_a.indexOf(0);
                    

                    if(kms_er != '-1'){
                        var str = 'Please Enter Kms For All Field';
                        var result = str.fontcolor("red");

                        document.getElementById('kms_er').innerHTML = result;
                        return false;
                    }
                    else{
                        document.getElementById('kms_er').innerHTML = '';
                        if(vehicle_er != '-1'){
                            var str = 'Please Select Vehicle For All Field';
                            var result = str.fontcolor("red");
                            document.getElementById('vehicle_id_er').innerHTML = result;
                            return false;
                        }else{
                            document.getElementById('vehicle_id_er').innerHTML = '';
                            if(diesel_ltr_er != '-1'){

                            var str = 'Please Diesel  Ltr  For All Field';
                            var result = str.fontcolor("red");
                            document.getElementById('diesel_ltr_er').innerHTML = result;
                            return false;

                            }else{

                                document.getElementById('diesel_ltr_er').innerHTML = '';
                                if(diese_per_ltr_price_er != '-1'){
                                    var str = 'Please Diesel Per Ltr Price For All Field';
                                    var result = str.fontcolor("red");
                                    document.getElementById('diese_per_ltr_price_er').innerHTML = result;
                                    return false;
                                }else{
                                    document.getElementById('diese_per_ltr_price_er').innerHTML = '';
                                    if(parking_exp_er != '-1'){
                                        var str = 'Please Enter Parking Expense For All Field';
                                        var result = str.fontcolor("red");
                                        document.getElementById('parking_exp_er').innerHTML = result;
                                        return false;
                                    }else{

                                        indexing();
                                        calculatekms();
                                        calculatediesel();
                                        calculateparkingcharges();
                                        calculateotherexp();
                                        getTotal();
                                        document.getElementById('parking_exp_er').innerHTML = '';
                                        $(':input[type="submit"]').prop('disabled', true);
                                        $("#frm_single").submit();
                                    }
                                }
                            }
                        }
                    }
            }
        });

          /* Hardik */
        $("body").on("change",".diesel_ltr",function(e){
            calculatekms();
        });

        /* Hardik */
        $("body").on("change",".diese_per_ltr_price",function(e){
            calculatekms();
        });

		$("body").on("change","#vendor_id",function(e){
            var vendor_id = $(this).val();
            $.ajax({
                type:'POST',
                url:'{{url('/getVehicleVendorWise')}}',
                async:false,
                data:{
                vendor_id:vendor_id
                },
                success:function(result){
                    $(".vehicle_id").empty().html(result);
                }
            });
        });

        function checkVehicleValidate()
        {
            var res = false;
            var vendor_id = $('body').find('#vendor_id').val();
            var routeId = $('body').find('#route_id').val();
            var fromDate = $('body').find('#from_date').val();
            var toDate = $('body').find('#to').val();
            if (routeId != '' && fromDate != '' && toDate != '') {

                $.ajax({
                    url:'{{ url("/checkInvoiceDateVehicle")}}',
                    type: "post",
                    dataType:'json',
                    data:
                    {
                        vendor_id:vendor_id,
                        routeId:routeId,
                        fromDate:fromDate,
                        toDate:toDate,
                        action:'{{$action}}',
                        id:@if($action=='update') {{$parisishthab->id}} @else 0 @endif,
                    },
                    success:function(result) {
                        if (result==false) {
                            $('#from_date').val('');
                            $('#to').val('');
                            $(".clonedTr").remove();
                            swal('Invoice for selected Route and period already exists.', "", "error");
                            $(".blockUI").hide();
                            $("#save").prop("disabled",true);
                            var res = result;
                            return false;
                        }
                        else
                        {
                            $("#save").prop("disabled",false);
                                DateDiff($("#from_date").val(),$("#to").val());
                        }
                        $(".blockUI").hide();
                    }
                });
            }

        }

    $(".diesel_ltr").trigger('keyup');
    $(".parking_exp").trigger('keyup');
    $(".other_exp").trigger('keyup');
    $("input[name='gov_diesel']").trigger('keyup');
    $(".idling_minutes").trigger('change');
    calculatekms();
    getTotal();

});

function setFlag(p){
	$("#status").val(p);
}

</script>
@endsection