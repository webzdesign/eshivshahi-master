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
    @php  $route =$route; @endphp

@else
@php  $route =$route; @endphp
@php  $button = 'View'; @endphp
@php $btn = 'View'; @endphp

@endif
<?php  //print_r($vendorinvoicedata); ?>
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

							@csrf
              @foreach($vendorinvoicedata as $data )
                <?php //echo"<pre>";print_r($data->division_id);exit; ?>
							<input type="hidden" name="id" id="id" value="{{isset($data->id)?$data->id:''}}">

                            <input type="hidden" name="route_km" value="{{ $schduleKm }}" id="route_km" />

                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Select Route <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="route_id" name="route_id" class="form-control select2_single col-md-7 col-xs-12 route_id" style="width:100%;" disabled>
                                        <option value=""></option>
                                        @foreach($routes as $rout)
                                            <option value="{{$rout->id}}" @if(isset($data->route_id)){{$data->route_id == $rout->id?'selected':''}}@endif>{{$rout->from_depot.' - '.$rout->to_depot}}</option>
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
                                               <option @if($data->vendor_id != '') {{ ($data->vendor_id == $vendorVal->id) ? 'selected' : '' }}  @endif  value="{{ $vendorVal->id}}" >{{ $vendorVal->vendor_name}}</option>

                                           @endforeach
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
                                    <input  type="text" id="invoice_no" name="invoice_no"  class="form-control col-md-7 col-xs-12 invoice_no" value="{{ $data->invoice_no }}" readonly>
                                    @if ($errors->has('invoice_no'))
                                    <span class="error">
                                        <b>{{ $errors->first('invoice_no') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Select Vehicle<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="vehicle_id_reff" name="vehicle_id_reff"  class="form-control select2_single col-md-7 col-xs-12 vehicle_id_reff" style="width:100%;" >
                                            <option value=""></option>
                                            @foreach($vehicle as $key=>$val)
                                                    <option {{ ($val->id == $data->vehicle_id_reff) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->vehicle_no }}</option>
                                            @endforeach

                                    <select>
                                    @if ($errors->has('vehicle_id_reff'))
                                    <span class="error">
                                        <b> {{ $errors->first('vehicle_id_reff') }}</b>
                                    </span>
                                    @endif
                                </div>
							</div>
                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Division<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="division_id" name="division_id"  class="form-control select2_single col-md-7 col-xs-12 division_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($division as $key=>$val)
                                            <option {{ ($val->id == $data->division_id) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Depot<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="depot_id" name="depot_id"  class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($depots as $key=>$val)
                                            <option {{ ($val->id == $data->depot_id) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
								</div>
							</div>
								@php	$dates = explode(",",$data->billing_period) @endphp
							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Billing Period<span class="required">*</span>
                                </label>
                                <div class=" col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="from_date" id="from_date" class="datepicker form-control" value="{{date("d-m-Y",strtotime($dates[0]))}}"  disabled placeholder="From Date"  />
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

                            <!-- <div class="table-responsive" style="width:100%;margin: 0 auto;">-->
                            <div class="wrapper1">
                                <div class="div1">
                                </div>
                            </div>
                            <div class="wrapper2">
                                <div class="div2">
							<table id="parishishtha_b" class="table table-bordered dttable" style="width:1490px;">
									<thead>
										<tr>
											<th width="120px !important;">Date/दिनांक<span class="required">*</span></th>
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
                                            <th width="150px !important;">VehicleNumber<span class="required">*</span></th>
											<th width="120px !important;">Remarks</th>
										</tr>
									</thead>
									<tbody style="">
											@php
												$date = explode(",",$data->date);
                                                $vehicleArr = explode("*++*",$data->vehicle_id);
												$kms = explode(",",$data->kms);
												$diesel_ltr = explode(",",$data->diesel_ltr);
												$diese_per_ltr_price = explode(",",$data->diese_per_ltr_price);
												$adblue = explode(",",$data->adblue);
												$adblue_price = explode(",",$data->adblue_price);
												$breaddown_charge = explode(",",$data->breaddown_charge);
												$vor_exp = explode(",",$data->vor_exp);
												$parking_exp = explode(",",$data->parking_exp);
												$hault_tax = explode(",",$data->hault_tax);
                                                $wash_exp = explode(",",$data->wash_exp);
												$other_exp = explode(",",$data->other_exp);
                                                $remarks = explode("*++*",$data->remarks);
											@endphp

											@for($i=0;$i<count($date);$i++)
                                                @if($date[$i] > date('Y-m-d'))
                                                    <tr class="parishishtha_b">
                                                        <td ><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>


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
                                                            <input type="text" readonly id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]" value="{{$vehicleArr[$i]}}"  class="form-control  vehicle_id">
                                                        </td>
                                                        <td>

                                                            <?php /* <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button> */
                                                            ?>

                                                            <textarea rows="1" id="remarks[{{ $i }}}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>


                                                        </td>
                                                    </tr>
                                                @else
                                                    @if($i == '0')
                                                    <tr class="parishishtha_b">
                                                        <td><input type="text" id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

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
                                                            <input type="text" id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]" value="{{$vehicleArr[$i]}}"  class=" numberonly form-control  vehicle_id vehicle_id_auto">
                                                        </td>
                                                        <td>

                                                                <?php /*<button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button> */ ?>

                                                                <textarea rows="1" id="remarks[{{ $i }}}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>

                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr class="parishishtha_b">
                                                        <td ><input type="text" id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

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
                                                            <input type="text" id="vehicle_id[{{$i}}]" name="vehicle_id[{{$i}}]" value="{{$vehicleArr[$i]}}"  class=" numberonly form-control  vehicle_id vehicle_id_auto_total">
                                                        </td>
                                                        <td>
                                                            <?php /* <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                            <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button> */ ?>

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
										</tr>
										<tr>
												<td>Total</td>

												<td><input type="text" class="form-control"  name="total_kms" id="total_kms" value="{{array_sum($kms)}}" readonly></td>
												<td><input type="text" class="form-control" name="total_diesel" id="total_diesel" value="{{array_sum($diesel_ltr)}}" readonly></td>
												<td></td>
													<td><input type="text" class="form-control total_adblue" value="{{array_sum($adblue)}} " name="total_adblue" id="total_adblue" readonly></td>
												<td></td>
												<td><input type="text" class="form-control total_breaddown_charge" name="total_breaddown_charge" id="total_breaddown_charge" value="{{array_sum($breaddown_charge)}}" readonly></td>
												<td><input type="text" class="form-control total_vor_exp" name="total_vor_exp" value="{{array_sum($vor_exp)}}" id="total_vor_exp" readonly></td>
												<td><input type="text" class="form-control" name="total_parking_exp" id="total_parking_exp" value="{{array_sum($parking_exp)}}" readonly></td>
												<td><input type="text" class="form-control total_hault_exp"  value=" {{array_sum($hault_tax)}}" name="total_hault_exp" id="total_hault_exp" readonly></td>

                                                <td><input type="text" class="form-control total_wash_exp"  value="{{array_sum($wash_exp)}}" name="total_wash_exp" id="total_wash_exp" readonly></td>

												<td><input type="text" class="form-control" name="total_other_exp" value="{{array_sum($other_exp)}}" id="total_other_exp" readonly></td>
                                                <td></td>
												<td></td>
										</tr>
									</tfoot>
							</table>
                            </div></div>
							<table class="table table-bordered">
								<tr>
									<th>Total Kms/ एकुण किमी</th>
									<th>Total Filled Diesel/ प्रत्यक्ष पुरविलेले डिझेल (लिटर)</th>
									<th>Diesel as per norms/ महामंडळाने पुरवावयाचे डिझेल</th>
									<th>Extra Diesel Filled/ जादा/कमी पुरविलेले डिझेल</th>
								</tr>
								<tr>
									<td><input type="text" class="form-control"  name="kms_total" id="kms_total" value="{{array_sum($kms)}}" readonly></td>
									<td><input type="text" class="form-control"  name="diesel_total" id="diesel_total" value="{{array_sum($diesel_ltr)}}" readonly></td>
									<td><input readonly type="text" data-precision="2" class="decimalonly form-control"  name="gov_diesel" id="gov_diesel" value="{{$data->diesel_as_per_gov}}" ></td>
									<td><input type="text" class="form-control"  name="extra_diesel" id="extra_diesel" value="{{array_sum($diesel_ltr)-$data->diesel_as_per_gov}}" readonly></td>
								</tr>
								<tr>
                                    <th colspan="3" style="text-align:right;">Extra Filled Diesel Charges / जादा पुरीविलेले डिझेलची वसुली</th>
                                    <td width="10%"><input type="text" class="form-control"  name="extra_diesel_charge" id="extra_diesel_charge" value="{{$data->extra_diesel_charged}}" readonly ></td>
								</tr>
                                <tr>
                                    <th colspan="3" style="text-align:right;">Amount</th>
                                    <td width="10%"><input type="text" class="form-control total_amount amountonly" name="total_amount" value="{{ $data->total_amount }}" id="total_amount" readonly ></td>
								</tr>
                                <tr>
                                    <th colspan="3" style="text-align:right;">Total Deduction</th>
                                    <td width="10%"><input type="text" class="form-control total_charge amountonly" name="total_charge" value="{{ $data->total_charge }}" id="total_charge" readonly ></td>
								</tr>
                                <tr>
                                    <th colspan="3" style="text-align:right;"><span style="font-size:20px;">Grand Total</span></th>
                                    <td width="10%"><input type="text" class="form-control grand_amount amountonly" name="grand_amount" value="{{ $data->grand_amount }}" id="grand_amount" readonly ></td>
								</tr>
							</table>
                            <hr style="border-top: 4px solid #afa5a5">
          @endforeach
							<div class="ln_solid"></div>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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
    $(".wrapper1").scroll(function(){
        $(".wrapper2")
            .scrollLeft($(".wrapper1").scrollLeft());
    });
    $(".wrapper2").scroll(function(){
        $(".wrapper1")
            .scrollLeft($(".wrapper2").scrollLeft());
    });
    $('input').prop('readonly',true);
    $('select,textarea').prop('disabled',true);
});
 </script>
@endsection