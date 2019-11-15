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

@if($action=='insert')

   @php  $btn = 'Save'; @endphp
   @php  $button = 'Save'; @endphp
   @php  $route=route('vendorinvoice.store'); @endphp

@elseif($action=='update')

    @php $btn = 'Update'; @endphp
    @php  $button = 'Update'; @endphp
    @php  $route=route('vendorinvoice.update',Crypt::encryptString($parisishthab->id)); @endphp

@else
@php  $button = 'View'; @endphp
@php $btn = 'View'; @endphp

@endif
<style>
.wrapper1, .wrapper2{width: 100%; border: none 0px RED;
overflow-x: scroll; overflow-y:hidden;}
.wrapper1{height: 20px; }
.wrapper2{ }
.div1 {width:1440px; height: 20px; }
.div2 {width:1440px; overflow: auto;}
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
							<input type="hidden" name="id" id="id" value="{{isset($parisishthab->id)?$parisishthab->id:''}}">

                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Select Source <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="source_id" name="source_id"  class="form-control select2_single col-md-7 col-xs-12 source_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if(isset($parisishthab->source_id)){{$parisishthab->source_id==$city->id?'selected':''}}@endif>{{$city->name}}</option>
                                        @endforeach
                                    <select>
								</div>
                                @if($action != 'view')
                                <div class="col-md-3 col-sm-3 col-xs-6">
									<a class="btn btn-primary" data-toggle="modal" data-target="#cityModal">
										Add City
									</a>
								</div>
                                @endif
							</div>

                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Select Destination <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="destination_id" name="destination_id"  class="form-control select2_single col-md-7 col-xs-12 destination_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if(isset($parisishthab->destination_id)){{$parisishthab->destination_id==$city->id?'selected':''}}@endif>{{$city->name}}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>

							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Select Vendor<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="vendor_id" name="vendor_id" style="width:100%;"  class="form-control col-md-7 col-xs-12 select2_single vendor_id" @if(Auth::user()->usertype_id !=1){{'disabled'}} @endif >
                                        <option value=""></option>
                                           @foreach($vendors as $vendorVal)
                                               <option value="{{ $vendorVal->id}}" @if($action=='update') {{ $vendorVal->id==$parisishthab->vendor_id ? 'selected':''}} @endif @if(Auth::user()->usertype_id !=1){{'selected '}} @endif>{{ $vendorVal->vendor_name}}</option>

                                           @endforeach
                                           @if(Auth::user()->usertype_id !=1)
                                                <input type="hidden" name="vendor_id" value="{{ $parisishthab->vendor_id }}">
                                            @endif

                                    </select>
                                    @if ($errors->has('vendor_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('vendor_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Invoice No<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="invoice_no" name="invoice_no"  class="form-control col-md-7 col-xs-12 invoice_no" value="{{ $action=='update'?$parisishthab->invoice_no:old('invoice_no') }}">
                                    @if ($errors->has('invoice_no'))
                                    <span class="error">
                                     <b> {{ $errors->first('invoice_no') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

                            <div class="form-group">
									<label class=" col-md-3 col-sm-3 col-xs-12" >Select Vehicle<span class="error">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
                                        <select @if($action == 'update') {{ ($parisishthab->vendorinvoice_id != '') ? 'disabled' : '' }} @endif id="vehicle_id_reff" name="vehicle_id_reff"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id_reff" style="width:100%;">
                                                <option value=""></option>
                                                @if($action == 'update' || $action == 'view')
                                                        @foreach($vehicle as $key=>$val)
                                                                <option {{ ($val->id == $parisishthab->vehicle_id_reff) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->vehicle_no }}</option>
                                                        @endforeach
                                                @endif
                                        <select>
                                        @if ($errors->has('vehicle_id_reff'))
                                        <span class="error">
                                            <b> {{ $errors->first('vehicle_id_reff') }}</b>
                                        </span>
                                        @endif
									</div>
							</div>
                            @if($action == 'update')
                                @if($parisishthab->vendorinvoice_id != '')
                                <input type="hidden" name="vehicle_id_reff" id="vehicle_id_reff_input" value="{{ $parisishthab->vehicle_id_reff }}">
                                @endif
                            @endif

                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Division<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select @if($action == 'update') {{ ($parisishthab->vendorinvoice_id != '') ? 'disabled' : '' }} @endif id="division_id" name="division_id"  class="form-control select2_single col-md-7 col-xs-12 division_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($division as $key=>$val)
                                            <option @if($action == 'update' || $action == 'view'){{ ($val->id == $parisishthab->division_id) ? 'selected' : '' }} @else {{ ($val->id == $userdivision) ? 'selected' : '' }}  @endif value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>
                            @if($action == 'update')
                                @if($parisishthab->vendorinvoice_id != '')
                                <input type="hidden" name="division_id" id="division_id_input" value="{{ $parisishthab->division_id }}">
                                @endif
                            @endif

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Depot<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select @if($action == 'update') {{ ($parisishthab->vendorinvoice_id != '') ? 'disabled' : '' }} @endif id="depot_id" name="depot_id"  class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($depots as $key=>$val)
                                            <option @if($action == 'update' || $action == 'view'){{ ($val->id == $parisishthab->depot_id) ? 'selected' : '' }} @else {{ ($val->id == $userdepo) ? 'selected' : '' }} @endif value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>
                            @if($action == 'update')
                                @if($parisishthab->vendorinvoice_id != '')
                                <input type="hidden" name="depot_id" id="depot_id_input" value="{{ $parisishthab->depot_id }}">
                                @endif
                            @endif

							@if($action=='update' || $action=='view')
								@php	$dates = explode(",",$parisishthab->billing_period) @endphp
							@endif

							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Billing Period<span class="required">*</span>
                                </label>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="from_date" id="from_date" class="datepicker form-control" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($dates[0]))}}@endif" @if($action == 'update' || $action == 'view') disabled @endif placeholder="From Date"  />
                                    @if ($errors->has('billing_period'))
                                    <span class="error">
                                        <b> {{ $errors->first('billing_period') }}</b>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="to" id="to" class="datepicker form-control" value="@if($action=='update' || $action=='view'){{date("d-m-Y",strtotime($dates[1]))}}@endif" @if($action == 'update' || $action == 'view') disabled @endif placeholder="To Date"  />
                                </div>
							</div>

							<div class="form-group">
									<label class=" col-md-3 col-sm-3 col-xs-12" >Voucher No
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
											<input  type="text" id="voucher_no" name="voucher_no"  class="form-control col-md-7 col-xs-12	voucher_no" value="{{isset($parisishthab->voucher_no)?$parisishthab->voucher_no:''}}">
											@if($errors->has('voucher_no'))
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
											<input  type="text" id="voucher_date" name="voucher_date"  class="datepicker form-control col-md-7 col-xs-12 voucher_date" value="@if($action=='update' || $action=='view'){{ date('d-m-Y',strtotime($parisishthab->voucher_date)) }} @endif">
											@if($errors->has('voucher_date'))
											<span class="error">
												<b> {{ $errors->first('voucher_date') }}</b>
											</span>
											@endif
									</div>
							</div>
                            <!--<div class="table-responsive" style="width:100%;margin: 0 auto;">-->
                            <div class="wrapper1">
                                <div class="div1">
                                </div>
                            </div>
                            <div class="wrapper2">
                                <div class="div2">
							<table id="parishishtha_b" class="table table-bordered dttable" cellspacing="0" style="width:1440px;">
									<thead>
										<tr>
											<th width="120px !important;">Date/दिनांक<span class="required">*</span></th>
                                            <th width="100px !important;">VehicleNumber<span class="required">*</span></th>
											<th width="100px !important;">Kms/सार्थ किमी<span class="required">*</span></th>
											<th width="100px !important;">Diesel Ltr/पुरविलेले डिझेल (लिटर)<span class="required">*</span></th>
											<th width="100px !important;">Adblue Liters/डिझेल दर प्रति लिटर रू<span class="required">*</span></th>
											<th width="100px !important;">Ad Blue</th>
											<th width="100px !important;">AdBlue Price</th>
											<th width="100px !important;">Break Down Charges/वाहन बिघाड रक्कम</th>
											<th width="100px !important;">Vor. Exp/मार्ग बंद वाहने वसुली</th>
											<th width="100px !important;">Parking Exp. /पार्किंग वीज इ. रक्कम <span class="required">*</span></th>
											<th width="100px !important;">Hotel Halt/थांबा वसुली रक्कम</th>
                                            <th width="100px !important;">Washing Charges</th>
											<th width="100px !important;">Other Exp./इतर वसुली रक्कम<span class="required"></span></th>
											<th width="120px !important;">Actions</th>
										</tr>
									</thead>
									<tbody style="">
										@if($action=='insert')
											<tr class="parishishtha_b">
													<td><input type="text" id="date_pb[0]" name="date_pb[0]" class="date_pb form-control date_pb_auto"></td>
                                                    <td>
                                                    <select  id="vehicle_id" name="vehicle_id[]" class="form-control select2_single col-md-7 col-xs-12 vehicle_id vehicle_id_auto" style="width:100%;">
                                                        <option value=""></option>

                                                    <select>
                                                    </td>
													<td><input type="text" id="kms[0]" name="kms[0]"  class="decimalonly kms form-control kms_auto" /></td>
													<td><input type="text" data-precision="2" id="diesel_ltr[0]" name="diesel_ltr[0]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto"></td>
													<td><input type="text" id="diese_per_ltr_price[0]" name="diese_per_ltr_price[0]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto" data-precision="2"></td>
													<td><input type="text" id="adblue[0]" name="adblue[0]"  class="form-control adblue decimalonly adblue_auto" data-precision="2"></td>
													<td><input type="text" id="adblue_price[0]" name="adblue_price[0]"  class="form-control  adblue_price decimalonly adblue_price_auto" data-precision="2"></td>
													<td><input type="text" id="breaddown_charge[0]" name="breaddown_charge[0]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto" ></td>
													<td><input type="text" id="vor_exp[0]" name="vor_exp[0]"  class="numberonly form-control vor_exp vor_exp_auto"></td>
													<td><input type="text" id="parking_exp[0]" name="parking_exp[0]"  class="numberonly form-control  parking_exp parking_exp_auto"></td>
													<td><input type="text" id="hault_exp[0]" name="hault_exp[0]"  class=" numberonly form-control  hault_exp hault_exp_auto"></td>
                                                    <td><input type="text" id="wash_exp[0]" name="wash_exp[0]"  class="numberonly form-control  wash_exp wash_exp_auto"></td>
													<td><input type="text" id="other_exp[0]" name="other_exp[0]"  class=" numberonly form-control  other_exp other_exp_auto"></td>
													<td>
                                                        <button  tabindex="1" type="button" class="btn btn-success add btn-xs " onclick="">+</button>
                                                        <button tabindex="1" type="button" class="btn btn-danger  minus btn-xs">-</button>
													</td>
											</tr>
										@else
											@php
												$date = explode(",",$parisishthab->date);
                                                $vehicleArr = explode(",",$parisishthab->vehicle_id);
												$kms = explode(",",$parisishthab->kms);
												$diesel_ltr = explode(",",$parisishthab->diesel_ltr);
												$diese_per_ltr_price = explode(",",$parisishthab->diese_per_ltr_price);
												$adblue = explode(",",$parisishthab->adblue);
												$adblue_price = explode(",",$parisishthab->adblue_price);
												$breaddown_charge = explode(",",$parisishthab->breaddown_charge);
												$vor_exp = explode(",",$parisishthab->vor_exp);
												$parking_exp = explode(",",$parisishthab->parking_exp);
												$hault_tax = explode(",",$parisishthab->hault_tax);
                                                $wash_exp = explode(",",$parisishthab->wash_exp);
												$other_exp = explode(",",$parisishthab->other_exp);
											@endphp

											@for($i=0;$i<count($date);$i++)
                                                @if($date[$i] > date('Y-m-d'))
                                                    <tr class="parishishtha_b">
                                                        <td ><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>
                                                        <td>
                                                            <select disabled id="vehicle_id" name="vehicle_id[]" class="form-control select2_single col-md-7 col-xs-12 vehicle_id" style="width:100%;">
                                                            <option value=""></option>

                                                            <select>
                                                        </td>

                                                        <td><input type="text" readonly id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control" value="{{$kms[$i]}}" /></td>
                                                        <td><input type="text" readonly data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr" value="{{$diesel_ltr[$i]}}"></td>
                                                        <td><input type="text" readonly id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                                        <td><input type="text" readonly id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly" data-precision="2" value="{{$adblue[$i]}}"></td>
                                                        <td><input type="text" readonly id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                                        <td><input type="text" readonly id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge" value="{{$breaddown_charge[$i]}}" ></td>
                                                        <td><input type="text" readonly id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp" value={{$vor_exp[$i]}}></td>
                                                        <td><input type="text" readonly id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp" value={{$parking_exp[$i]}} ></td>
                                                        <td ><input type="text" readonly id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp" value="{{$hault_tax[$i]}}"></td>

                                                        <td ><input type="text" readonly id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]" class="numberonly form-control wash_exp" value="{{ $wash_exp[$i] }}" /></td>

                                                        <td><input type="text" readonly id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp"></td>
                                                        <td>

                                                                <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button>

                                                        </td>
                                                    </tr>
                                                @else
                                                    @if($i == '0')
                                                    <tr class="parishishtha_b">
                                                        <td><input type="text" id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>
                                                        <td>
                                                            <select id="vehicle_id" name="vehicle_id[]" class="form-control select2_single col-md-7 col-xs-12 vehicle_id vehicle_id_auto" style="width:100%;">
                                                            <option value=""></option>
                                                            @foreach($vehicle as $val)
                                                            <option {{ ($val->id == $vehicleArr[$i]) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->vehicle_no }}</option>
                                                            @endforeach
                                                            <select>
                                                        </td>
                                                        <td ><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control kms_auto" value="{{$kms[$i]}}" /></td>
                                                        <td ><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto" value="{{$diesel_ltr[$i]}}"></td>
                                                        <td ><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                                        <td ><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly adblue_auto" data-precision="2" value="{{$adblue[$i]}}"></td>
                                                        <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly adblue_price_auto" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                                        <td><input type="text" id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto" value="{{$breaddown_charge[$i]}}" ></td>
                                                        <td><input type="text" id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp vor_exp_auto" value={{$vor_exp[$i]}}></td>
                                                        <td><input type="text" id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp parking_exp_auto" value={{$parking_exp[$i]}} ></td>
                                                        <td><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp hault_exp_auto" value="{{$hault_tax[$i]}}"></td>

                                                        <td>
                                                            <input type="text" id="wash_exp[{{$i}}]" name="wash_exp[{{ $i }}]" class="numberonly form-control wash_exp wash_exp_auto" value="{{ $wash_exp[$i] }}" />
                                                        </td>

                                                        <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp other_exp_auto"></td>
                                                        <td>

                                                                <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button>

                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr class="parishishtha_b">
                                                        <td ><input type="text" id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>
                                                        <td>
                                                            <select id="vehicle_id" name="vehicle_id[]" class="form-control select2_single col-md-7 col-xs-12 vehicle_id vehicle_id_auto_total" style="width:100%;">
                                                            <option value=""></option>
                                                            @foreach($vehicle as $val)
                                                            <option {{ ($val->id == $vehicleArr[$i]) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->vehicle_no }}</option>
                                                            @endforeach
                                                            <select>
                                                        </td>
                                                        <td><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control kms_auto_total" value="{{$kms[$i]}}" /></td>
                                                        <td><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto_total" value="{{$diesel_ltr[$i]}}"></td>
                                                        <td><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto_total" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                                        <td><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly adblue_auto_total" data-precision="2" value="{{$adblue[$i]}}"></td>
                                                        <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly adblue_price_auto_total" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                                        <td ><input type="text" id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto_total" value="{{$breaddown_charge[$i]}}" ></td>
                                                        <td ><input type="text" id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp vor_exp_auto_total" value={{$vor_exp[$i]}}></td>
                                                        <td><input type="text" id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp parking_exp_auto_total" value={{$parking_exp[$i]}} ></td>
                                                        <td ><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp hault_exp_auto_total" value="{{$hault_tax[$i]}}"></td>

                                                        <td>
                                                            <input type="text" id="wash_exp[{{$i}}]" name="wash_exp[{{ $i }}]" class="numberonly form-control wash_exp wash_exp_auto_total" value="{{ $wash_exp[$i] }}" />
                                                        </td>
                                                        <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp other_exp_auto_total"></td>
                                                        <td>
                                                            <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                            <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button>
                                                        </td>
                                                    </tr>
                                                    @endif

                                                @endif
											@endfor
										@endif
									</tbody>
									<tfoot>
										<tr>
											<td></td>
                                            <td><label id="vehicle_id_er"></label></td>
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
											<td></td>
										</tr>
										<tr>
												<td>Total</td>
                                                <td></td>
												<td><input type="text" class="form-control"  name="total_kms" id="total_kms" value="" readonly></td>
												<td><input type="text" class="form-control" name="total_diesel" id="total_diesel" value="" readonly></td>
												<td></td>
													<td><input type="text" class="form-control total_adblue" value="@if($action=='update' || $action == 'view') {{array_sum($adblue)}} @endif" name="total_adblue" id="total_adblue" readonly></td>
												<td></td>
												<td><input type="text" class="form-control total_breaddown_charge" name="total_breaddown_charge" id="total_breaddown_charge" value="@if($action=='update' || $action == 'view') {{array_sum($breaddown_charge)}} @endif" readonly></td>
												<td><input type="text" class="form-control total_vor_exp" name="total_vor_exp" value="@if($action=='update' || $action == 'view') {{array_sum($vor_exp)}} @endif" id="total_vor_exp" readonly></td>
												<td><input type="text" class="form-control" name="total_parking_exp" id="total_parking_exp" readonly></td>
												<td><input type="text" class="form-control total_hault_exp"  value="@if($action=='update' || $action == 'view') {{array_sum($hault_tax)}} @endif" name="total_hault_exp" id="total_hault_exp" readonly></td>

                                                <td><input type="text" class="form-control total_wash_exp"  value="@if($action=='update' || $action == 'view') {{array_sum($wash_exp)}} @endif" name="total_wash_exp" id="total_wash_exp" readonly></td>

												<td><input type="text" class="form-control" name="total_other_exp" id="total_other_exp" readonly></td>
												<td></td>
										</tr>
									</tfoot>
							</table>
                            </div></div>
							<table class="table table-bordered">
								<tr>
									<th>Total Kms/ एकुण किमी</th>
									<th>Total Filled Diesel/ प्रत्यक्ष पुरविलेले डिझेल (लिटर)</th>
									<th>Diesel According to Gov./ महामंडळाने पुरवावयाचे डिझेल</th>
									<th>Extra Diesel Filled/ जादा/कमी पुरविलेले डिझेल</th>
								</tr>
								<tr>
									<td><input type="text" class="form-control"  name="kms_total" id="kms_total" readonly></td>
									<td><input type="text" class="form-control"  name="diesel_total" id="diesel_total" readonly></td>
									<td><input readonly type="text" data-precision="2" class="decimalonly form-control"  name="gov_diesel" id="gov_diesel" value="@if($action=='update' || $action=='view') {{$parisishthab->diesel_as_per_gov}} @endif" ></td>
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
									<input type="hidden" value="" name="status" id="status" />
									@if($action!='view')
										@if($action=='insert')
												<button type="submit" onclick="setFlag(0)" id="save" class="btn btn-primary">{{ $btn }}</button>
												<button type="submit" onclick="setFlag(1)" id="save_submit" class="btn btn-primary"> {{ $btn }} And Submit </button>
											@else

											@if($parisishthab->status == 1)
												<button type="submit" onclick="setFlag(1)" id="save_submit" class="btn btn-primary"> Update And Submit </button>
											@else
												<button type="submit" onclick="setFlag(0)" id="save" class="btn btn-primary">{{ $btn }}</button>
												<button type="submit" onclick="setFlag(1)" id="save_submit" class="btn btn-primary">{{ $btn }} And Submit </button>
											@endif
										@endif
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
<!--City Modal -->
<div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					Add City
				</h4>
			</div>
			<!-- Modal Body -->
			<div class="modal-body">
				<form class="form-horizontal" id="frmCity" autocomplete="off">
					<div class="form-group">
						<label  class="col-sm-3 control-label">City Name <span class="required"> *</span></label>
						<div class="col-sm-9">
							<input type="text" maxlength="50" required class="form-control" name="name" id="name" placeholder="Enter Name"/>
						</div>
					</div>

					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-default" id="citySubmit">Add</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
/* To get vehicle on invoice selection by sneha doso on 15-09-2018 */
jQuery(document).ready(function($){


	$("body").on("change","#invoice_no",function(e){
        var invoice_id = $(this).val();
        if(invoice_id == ''){
            $('#viewInvoice').empty();
            $("#vehicle_id_reff").prop('disabled', false);
            $("#division_id").prop('disabled', false);
            $("#depot_id").prop('disabled', false);
            $("#vehicle_id_reff_input").remove();
            $("#division_id_input").remove();
            $("#depot_id_input").remove();
            return false;
        }
        $.ajax({
                type:'POST',
                url:'{{url("/getinvoicedata")}}',
                dataType : 'JSON',
                data:{ invoice_id:invoice_id 	},
                success:function(result){
                $("#vehicle_id_reff").prop('disabled', false);
                $("#vehicle_id_reff").val(result.vehicle_id).trigger('change');
                $("#vehicle_id_reff").prop('disabled', 'disabled');
                $("#vehicle_id_reff").removeAttr("name");
                $("#vehicle_id_reff").remove();

                $("#division_id").val(result.division_id).trigger('change');
                $("#division_id").prop('disabled', 'disabled');
                $("#division_id").removeAttr("name");
                $("#division_id_input").remove();

                setTimeout(function(){$("#depot_id").val(result.depot_id).trigger('change');},500);
                $("#depot_id").prop('disabled', 'disabled');
                $("#depot_id").removeAttr("name");
                $("#depot_id_input").remove();


                $('<input type="hidden" name="vehicle_id_reff" id="vehicle_id_reff_input" value="'+result.vehicle_id+'">').insertAfter("#vehicle_id");

                $('<input type="hidden" name="division_id" id="division_id_input" value="'+result.division_id+'">').insertAfter("#division_id");

                $('<input type="hidden" name="depot_id" id="depot_id_input" value="'+result.depot_id+'">').insertAfter("#depot_id");

                $('#viewInvoice').empty().html('<a target="_blank" href="'+result.viewInvoice+'" class="btn btn-success"><i class="fa fa-eye"></i> View Invoice</a>');
            }
        });

	});
});
/* End To get vehicle on invoice selection by sneha doso on 15-09-2018 */

jQuery(document).ready(function($){

    /* var ht = $('.dttable').dataTable({
        "paging": false,
        'aaSorting':false,
        "searching": false,
        'autoWidth': false,

    }); */

    $(".wrapper1").scroll(function(){
        $(".wrapper2")
            .scrollLeft($(".wrapper1").scrollLeft());
    });
    $(".wrapper2").scroll(function(){
        $(".wrapper1")
            .scrollLeft($(".wrapper2").scrollLeft());
    });



    $('body').on('change','#vehicle_id_reff',function(){
        var vehicleId = $(this).val();
        if(vehicleId != ''){
            $('#parishishtha_b').find('.vehicle_id_auto').val(vehicleId).trigger('change');
        }
    });

    /* check source and destination */
    $('body').on('change','#source_id,#destination_id',function(){
        var source_id = $('#source_id').val();
        var destination_id = $('#destination_id').val();

        if(source_id != '' && destination_id != ''){
            if(source_id == destination_id){
                $(this).val('').trigger('change');
            }
        }
    });

    /* add City model submit */
    $('#frmCity').validate({
        onkeyup: function(element) {$(element).valid()},
        rules:{
            name:{required: true,
                remote: {
                    url:'{{url("/checkcityname")}}',
                    type: "post",
                    data:
                    {
                        name: function()
                        {
                            return $('#frmCity :input[name="name"]').val();
                        },
                    },
                },
            },
        },
        messages:{
            name:{
                required: "Please Enter City Name.",
                remote:"City Name Already Exist.",
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parent("div"));
        }
    });

    $('body').on('click','#citySubmit',function(e){
        e.preventDefault();
        if($("#frmCity").valid()){
            $(':button[type="submit"]').prop('disabled', true);
            $.ajax({
                type: "POST",
                url:'{{url("/addcityname")}}',
                data: $('#frmCity').serialize(),
                dataType: "json",
                success: function(res){
                    $(':button[type="submit"]').prop('disabled', false);
                    swal({
                        title: "Success",
                        text: "City Insert Successful.",
                        type: "success",
                    });
                    $('#frmCity').find(':input').val('');
                    $("#cityModal").modal('hide');
                    $('#source_id').append($('<option>', {
                    value: res[1],
                    text: res[2]
                    }));
                    $('#destination_id').append($('<option>', {
                    value: res[1],
                    text: res[2]
                    }));
                }
            });
        }else{
            return false;
        }
    });
    /* auto fill start from pratik donga on 17-09-2018 */

    $('body').on('change',".vehicle_id_auto",function(){
        $(this).removeClass('vehicle_id_auto_total');
        var vehicle_id =  $(this).closest('tr').find('.vehicle_id_auto').val();
        $(".vehicle_id_auto_total").val(vehicle_id).trigger('change');
    });

    $('body').on('change',".kms_auto",function(){
        var kms =  $(this).closest('tr').find('.kms_auto').val();
        $(".kms_auto_total").val(kms);
        $(".kms").trigger('keyup');
        calculatekms();
    });

    /*$('body').on('change',".diesel_ltr_auto",function(){
        var diesel_ltr =  $(this).closest('tr').find('.diesel_ltr_auto').val();
        $(".diesel_ltr_auto_total").val(diesel_ltr);
        $(".diesel_ltr").trigger('keyup');
    }); */
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
    /* $('body').on('change',".breaddown_charge_auto",function(){
        var breaddown_charge =  $(this).closest('tr').find('.breaddown_charge_auto').val();
        $(".breaddown_charge_auto_total").val(breaddown_charge);
        getTotal();
    }); */
    /* $('body').on('change',".vor_exp_auto",function(){
        var vor_exp =  $(this).closest('tr').find('.vor_exp_auto').val();
        $(".vor_exp_auto_total").val(vor_exp);
        getTotal();
    }); */
    $('body').on('change',".parking_exp_auto",function(){
        var parking_exp =  $(this).closest('tr').find('.parking_exp_auto').val();
        $(".parking_exp_auto_total").val(parking_exp);
        $(".parking_exp").trigger('keyup');
    });
    $('body').on('change',".wash_exp_auto",function(){
        var wash_exp =  $(this).closest('tr').find('.wash_exp_auto').val();
        $(".wash_exp_auto_total").val(wash_exp);
        getTotal();
    });
    /* $('body').on('change',".hault_exp_auto",function(){
        var hault_exp =  $(this).closest('tr').find('.hault_exp_auto').val();
        $(".hault_exp_auto_total").val(hault_exp);
        getTotal();
    }); */
    /* $('body').on('change',".other_exp_auto",function(){
        var other_exp =  $(this).closest('tr').find('.other_exp_auto').val();
        $(".other_exp_auto_total").val(other_exp);
        $(".other_exp").trigger('keyup');
    }); */
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


		var adblue =$(".adblue").map(function(){return $(this).val();}).get().join(",");
		var adblueVal = adblue;
		arr1 = adblueVal.split(',');
		var totalAddBlue=0;
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

	}


	/* Ad Blue Cal Event */
	$("body").on("change",".adblue",function(){
		getTotal();
	});

	$("body").on("change",".breaddown_charge",function(){
		getTotal();
	});

	$("body").on("change",".vor_exp",function(){
		getTotal();
	});

	$("body").on("change",".hault_exp",function(){
		getTotal();
    });

    $("body").on("keyup",".wash_exp",function(){
		getTotal();
	});

	var d = new Date();
	$('#voucher_date').datepicker({
			format:'dd-mm-yyyy',
			autoclose:true,
	}).datepicker('setDate',d);

    $('.date_pb').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true,
	});
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
    var toDayDate = new Date();

		 var $trclone='<tr class="parishishtha_b"><td><input type="text" id="date_pb[0]" name="date_pb[0]"  class="date_pb form-control"></td><td><select  id="vehicle_id" name="vehicle_id[]" class="form-control select2_single col-md-7 col-xs-12 vehicle_id " style="width:100%;"><option value=""></option><select></td><td><input type="text" id="kms[0]" name="kms[0]"  class="decimalonly kms form-control" /></td><td><input type="text" data-precision="2" id="diesel_ltr[0]" name="diesel_ltr[0]"  class="decimalonly form-control  diesel_ltr"></td><td><input type="text" id="diese_per_ltr_price[0]" name="diese_per_ltr_price[0]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2"></td><td><input type="text" id="adblue[0]" name="adblue[0]"  class="form-control adblue decimalonly" data-precision="2"></td><td><input type="text" id="adblue_price[0]" name="adblue_price[0]"  class="form-control  adblue_price decimalonly" data-precision="2"></td><td><input type="text" id="breaddown_charge[0]" name="breaddown_charge[0]"  class="numberonly form-control  breaddown_charge" ></td><td><input type="text" id="vor_exp[0]" name="vor_exp[0]"  class="numberonly form-control vor_exp"></td><td><input type="text" id="parking_exp[0]" name="parking_exp[0]"  class="numberonly form-control  parking_exp"></td><td><input type="text" id="hault_exp[0]" name="hault_exp[0]"  class=" numberonly form-control  hault_exp"></td><td><input type="text" id="other_exp[0]" name="other_exp[0]"  class=" numberonly form-control  other_exp"></td><td><button  tabindex="1"  type="button" class="btn btn-success btn-xs add" onclick="">+</button><button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button></td></tr>';

    //$("#parishishtha_b tbody tr").remove();
   // $("#parishishtha_b tbody").html($trclone);
    //$(".parishishtha_b").find("select").select2({placeholder: "Select",alowClear:true});
    //var $t=$('.parishishtha_b');
    var $t = $('#parishishtha_b tbody tr:first');

    //  return false;
            for(i=0;i<length;i++)
            {
                if(i==0)
                {
                    $t.find(".date_pb") .removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',currentDate);

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
                    $t.find(".vor_exp").addClass('vor_exp_auto');
                    $t.find(".parking_exp").addClass('parking_exp_auto');
                    $t.find(".hault_exp").addClass('hault_exp_auto');
                    $t.find(".wash_exp").addClass('wash_exp_auto');
                    $t.find(".other_exp").addClass('other_exp_auto');
                    continue;
                }else{
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
                    $t.find(".vor_exp").addClass('vor_exp_auto_total');
                    $t.find(".parking_exp").addClass('parking_exp_auto_total');
                    $t.find(".hault_exp").addClass('hault_exp_auto_total');
                    $t.find(".wash_exp").addClass('wash_exp_auto_total');
                    $t.find(".other_exp").addClass('other_exp_auto_total');
                }
                var num = $('.parishishtha_b').length;
                var $clone=$t.clone();


                if(currentDate >= toDayDate){
                    $clone.find(".date_pb").attr('readonly','readonly');
                    $clone.find(".vehicle_id").attr('disabled','disabled').removeClass('vehicle_id_auto_total');
                    $clone.find(".kms").attr('readonly','readonly').removeClass('kms_auto_total');
                    $clone.find(".diesel_ltr").attr('readonly','readonly').removeClass('diesel_ltr_auto_total');
                    $clone.find(".diese_per_ltr_price").attr('readonly','readonly').removeClass('diese_per_ltr_price_auto_total');
                    $clone.find(".adblue").attr('readonly','readonly').removeClass('adblue_auto_total');
                    $clone.find(".adblue_price").attr('readonly','readonly').removeClass('adblue_price_auto_total');
                    $clone.find(".breaddown_charge").attr('readonly','readonly').removeClass('breaddown_charge_auto_total');
                    $clone.find(".vor_exp").attr('readonly','readonly').removeClass('vor_exp_auto_total');
                    $clone.find(".parking_exp").attr('readonly','readonly').removeClass('parking_exp_auto_total');
                    $clone.find(".hault_exp").attr('readonly','readonly').removeClass('hault_exp_auto_total');
                    $clone.find(".wash_exp").attr('readonly','readonly').removeClass('wash_exp_auto_total');
                    $clone.find(".other_exp").attr('readonly','readonly').removeClass('other_exp_auto_total');
                }else{
                    var vehiclereff = $('#vehicle_id_reff').val();
                    $clone.find(".vehicle_id").val(vehiclereff).trigger('change');
                }

                $("#parishishtha_b tbody").children().last().after($clone);

                $clone.find(".date_pb").attr('id', 'date_pb['+num+']').attr('name', 'date_pb['+num+']');
                $clone.find(".date_pb") .removeClass('hasDatepicker') .removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yyyy'}).datepicker('setDate',currentDate);
                $clone.find("span").remove();
                $clone.find("select").select2({placeholder: "Select",
                alowClear:true});
                $clone.find(".kms").attr('id', 'kms['+num+']').attr('name', 'kms['+num+']').removeClass('kms_auto');
                $clone.find(".vehicle_id").attr('id', 'vehicle_id['+num+']').attr('name', 'vehicle_id['+num+']').removeClass('vehicle_id_auto');
                $clone.find(".diesel_ltr").attr('id', 'diesel_ltr['+num+']').attr('name', 'diesel_ltr['+num+']').removeClass('diesel_ltr_auto');
                $clone.find(".diese_per_ltr_price").attr('id', 'diese_per_ltr_price['+num+']').attr('name', 'diese_per_ltr_price['+num+']').removeClass('diese_per_ltr_price_auto');
                $clone.find(".adblue").attr('id', 'adblue['+num+']').attr('name', 'adblue['+num+']').removeClass('adblue_auto');
                $clone.find(".adblue_price").attr('id', 'adblue_price['+num+']').attr('name', 'adblue_price['+num+']').removeClass('adblue_price_auto');
                $clone.find(".breaddown_charge").attr('id', 'breaddown_charge['+num+']').attr('name', 'breaddown_charge['+num+']').removeClass('breaddown_charge_auto');
                $clone.find(".vor_exp").attr('id', 'vor_exp['+num+']').attr('name', 'vor_exp['+num+']').removeClass('vor_exp_auto');
                $clone.find(".parking_exp").attr('id', 'parking_exp['+num+']').attr('name', 'parking_exp['+num+']').removeClass('parking_exp_auto');
                $clone.find(".hault_exp").attr('id', 'hault_exp['+num+']').attr('name', 'hault_exp['+num+']').removeClass('hault_exp_auto');
                $clone.find(".wash_exp").attr('id', 'wash_exp['+num+']').attr('name', 'wash_exp['+num+']').removeClass('wash_exp_auto');
                $clone.find(".other_exp").attr('id', 'other_exp['+num+']').attr('name', 'other_exp['+num+']').removeClass('other_exp_auto');

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

        $(document).on('click',".add",function(){

            var $tr = $(this).closest('.parishishtha_b');
            var $clone = $tr.clone();
            $tr.after($clone);

            var num = $('.parishishtha_b').length;

            $clone.find("span").remove();
            $clone.find("select").select2({placeholder: "Select",
                alowClear:true});

                $clone.find(".date_pb").attr('id', 'date_pb['+num+']').attr('name', 'date_pb['+num+']');
                $clone.find(".date_pb") .removeClass('hasDatepicker') .removeData('datepicker').unbind().datepicker({ format: 'dd-mm-yy',autoclose:true,});

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
                $clone.find(".wash_exp").attr('id', 'wash_exp['+num+']').attr('name', 'wash_exp['+num+']').val();
                $clone.find(".other_exp").attr('id', 'other_exp['+num+']').attr('name', 'other_exp['+num+']');
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
                i++;
            });
            }
        }

        $(document).on('click','.minus' ,function(event){
            if($(".parishishtha_b").length>1){
                $(this).closest(".parishishtha_b").remove();
			   getTotal();
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
            $('.table tfoot').find("#total_diesel").val(total_diesel);
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
            $('.table tfoot').find("#total_parking_exp").val(total_parking_exp);
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
        $('.table tfoot').find("#total_other_exp").val(total_other_exp);
        }
        $("#gov_diesel").on('keyup',function(){
            var gov=parseFloat($(this).val());
            var diesel=parseFloat($("#diesel_total").val());
            var  extra=diesel-gov;
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
                    voucher_no:{
                        remote:{
                            url: "{{ url($checkvoucher) }}",
                            type: "post",
                            data:{
                                id:function(){
                                    return $("input[name='id']").val();
                                },
                            },
                        },
                    },

                    depot_id:{required:true,},
                    source_id:{required:true,},
                    destination_id:{required:true,},
                    vendor_id:{required:true,},
                    from_date:{required:true,},
                    to:{required:true,},
                    voucher_date:{
                        required:true,
                    },
                    vehicle_id_reff:{
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
                    from_date:{required:"Please Select From Date",},
                    to:{required:"Please Select to Date",},
                    depot_id:{
                        required:"Please Select Depot",
                    },
                    source_id:{required:"Please Select Source",},
                    destination_id:{required:"Please Select Destination",},
                    voucher_no:{
                        remote:"Voucher No Already Exist",
                    },
                    voucher_date:{
                        required:"Please Select Voucher Date",
                    },
                    vehicle_id_reff:{
                        required:"Please Select Vehicle",
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
                    source_id:{required:true,},
                    destination_id:{required:true,},
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
                    vehicle_id_reff:{
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
                    voucher_date:{
                        required:"Please Select Voucher Date",
                    },
                    vehicle_id_reff:{
                        required:"Please Enter Vehicle",
                    },
                    depot_id:{
                        required:"Please Select Depot",
                    },
                    source_id:{required:"Please Select Source",},
                    destination_id:{required:"Please Select Destination",},
                    voucher_no:{
                        required:"Please Enter Voucher No",
                        remote:"Voucher No Already Exist",
                    },
                    voucher_date:{
                        required:"Please Enter Voucher Date",
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
                                            getTotal();
                                            indexing();
                                            calculatekms();
                                            calculatediesel();
                                            calculateparkingcharges();
                                            calculateotherexp();
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
                  /* $("#gov_diesel").val('');
                   $("#extra_diesel").val('');
                   $("#extra_diesel_charge").val(''); */

          });
        /* Hardik */
          $("body").on("change",".diese_per_ltr_price",function(e){
            calculatekms();
                   /* $("#gov_diesel").val('');
                   $("#extra_diesel").val('');
                   $("#extra_diesel_charge").val('');*/
          });

		$("body").on("change","#vendor_id",function(e){
            var vendor_id = $(this).val();
            $.ajax({
                type:'POST',
                url:'{{url('/getVehicleVendorWise')}}',
                data:{
                vendor_id:vendor_id
                },
                success:function(result){
                    $(".vehicle_id_reff").empty().html(result);
                    $(".vehicle_id").empty().html(result);
                }
            });
        });




    $("input.date_pb").datepicker({
        format:'dd-mm-yy',
        autoclose:true,
    });

    if('{{$action}}'=='update' || '{{$action}}'=='view')
    {
        $(".kms").trigger('keyup');
        $(".diesel_ltr").trigger('keyup');
        $(".parking_exp").trigger('keyup');
        $(".other_exp").trigger('keyup');
        $("input[name='gov_diesel']").trigger('keyup');
        getTotal();
    }
    if('{{$action}}'=='view')
    {
        $('input').prop('readonly',true);
        $('select').prop('disabled',true);
        getTotal();
    }
});
function setFlag(p){
		$("#status").val(p);
    }

</script>
@endsection