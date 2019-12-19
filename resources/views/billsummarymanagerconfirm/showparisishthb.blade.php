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
    @php  $route=route('parisishthab.store'); @endphp
@elseif($action=='update')
    @php $btn = 'Update'; @endphp
    @php  $button = 'Update'; @endphp
    @php  $route=route('parisishthab.update',Crypt::encryptString($parisishthab->id)); @endphp
@else
@php  $button = 'View'; @endphp
@php $btn = 'View'; 
function calDiesel($no){
    if($no != '' && $no != 0)
    {
        return(($no*6)/100);
    }
}
@endphp
@endif
<style>
.wrapper1, .wrapper2{width: 100%; overflow-x: scroll; overflow-y:hidden;}

.wrapper1{height: 20px; }

.div1 {width:1700px; height: 20px; }
.div2 {width:1700px; overflow: auto;}
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
                        @foreach($parisishthabdata as $parisishthab)
							<input type="hidden" name="id" id="id" value="{{isset($parisishthab->id)?$parisishthab->id:''}}">

                            <input type="hidden" name="id" id="id" value="{{isset($parisishthab->id)?$parisishthab->id:''}}">

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
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Division<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select @if($action == 'update') {{ ($parisishthab->vendorinvoice_id != '') ? 'disabled' : '' }} @endif id="division_id" name="division_id"  class="form-control select2_single col-md-7 col-xs-12 division_id" style="width:100%;" {{($userTypeId !=1)?'disabled':''}}>
                                        <option value=""></option>
                                        @foreach($division as $key=>$val)
                                            <option @if($action == 'update' || $action == 'view'){{ ($val->id == $parisishthab->division_id) ? 'selected' : '' }} @else {{ ($val->id == $userdivision) ? 'selected' : '' }}  @endif value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach

                                    <select>
                                    @if($userTypeId !=1)
                                    <input type="hidden" name="division_id" id="division_id_hidden" value="{{ $parisishthab->division_id }}">
                                    @endif
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
                                    <select @if($action == 'update') {{ ($parisishthab->vendorinvoice_id != '') ? 'disabled' : '' }} @endif id="depot_id" name="depot_id"  class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;"  {{($userTypeId !=1)?'disabled':''}}>
                                        <option value=""></option>
                                        @foreach($depots as $key=>$val)
                                            <option @if($action == 'update' || $action == 'view'){{ ($val->id == $parisishthab->depot_id) ? 'selected' : '' }} @else {{ ($val->id == $userdepo) ? 'selected' : '' }} @endif value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    <select>
                                     @if($userTypeId !=1)
                                    <input type="hidden" name="depot_id" id="depot_id_hidden" value="{{ $parisishthab->depot_id }}">
                                    @endif
                                </div>
                            </div>
                            @if($action == 'update')
                                @if($parisishthab->vendorinvoice_id != '')
                                <input type="hidden" name="depot_id" id="depot_id_input" value="{{ $parisishthab->depot_id }}">
                                @endif
                            @endif

                            <div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Select Route <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="destination_id" name="route_id"  class="form-control select2_single col-md-7 col-xs-12 route_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($routes as $rout)
                                            <option value="{{$rout->id}}" @if(isset($parisishthab->route_id)){{$parisishthab->route_id == $rout->id?'selected':''}}@endif>{{$rout->from_depot.' - '.$rout->to_depot}}</option>
                                        @endforeach
                                    <select>
								</div>
                            </div>
                            
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Schedule Number - Time<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="schedule_number" id="schedule_number" class="form-control" placeholder="Schedule Number" value="{{ $parisishthab->route->scheduled_number.' - '.$parisishthab->route->scheduled_time  }}" readonly/>
                                </div>
                            </div>
                            
                            
                            @if($action == 'update')
                                @if($parisishthab->vendorinvoice_id != '')
                                <input type="hidden" name="vehicle_id_reff" id="vehicle_id_reff_input" value="{{ $parisishthab->vehicle_id_reff }}">
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
								<label class=" col-md-3 col-sm-3 col-xs-12" >Vendor Invoice No
								</label>

                                <input type="hidden" id="invoice_no" name="invoice_no" class="form-control col-md-7 col-xs-12	invoice_no" value="{{ $parisishthab->vendorinvoice_id }}">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" readonly id="invoiceNo" name="invoiceNo" class="form-control col-md-7 col-xs-12 invoiceNo" value="{{ $parisishthab->vendorinvoice->invoice_no }}">
                                </div>

                                <div id="viewInvoice">
                                    @if(($action == 'update' && $parisishthab->vendorinvoice_id != '') || $action =='view')
                                        @if($chekBill == 'yes')
                                        <a target="_blank" href="{{ route('vendorinvoice.show',encrypt($parisishthab->vendorinvoice_id)) }}" class="btn btn-success"><i class="fa fa-eye"></i> View Invoice</a>
                                        @endif
                                    @endif
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
                            <!--<div class="table-responsive " style="width:100%;margin: 0 auto;">-->
                            <div class="wrapper1">
                                <div class="div1">
                                </div>
                            </div>
                            <div class="wrapper2">
                                <div class="div2">
							<table id="parishishtha_b" class="table table-bordered dttable" style="width:1700px;">
									<thead>
										<tr>
											<th width="120px !important;">Date/दिनांक<span class="required">*</span></th>
                                            <th width="50px !important;">प्रासंगिक करार<span class="required">*</span></th>
                                            <th width="50px !important;">Schedule Complete</th>
											<th width="100px !important;">Kms/सार्थ किमी<span class="required">*</span></th>
											<th width="100px !important;">Diesel Ltr/पुरविलेले डिझेल (लिटर)<span class="required">*</span></th>
											<th width="100px !important;">Diesel Rate/डिझेल दर प्रति लिटर रू<span class="required">*</span></th>
											<th width="100px !important;">Ad Blue / अॅडब्लू </th>
											<th width="100px !important;">AdBlue Price /अॅडब्लू किंमत</th>
											<th width="200px !important;">Break Down Charges/वाहन बिघाड रक्कम</th>
											<th width="100px !important;">Vor. Exp/मार्ग बंद वाहने वसुली</th>
											<th width="100px !important;">Parking Exp. /पार्किंग वीज इ. रक्कम <span class="required">*</span></th>
											<th width="100px !important;">Hotel Halt/थांबा वसुली रक्कम</th>
                                            <th width="100px !important;">Washing Charges / धुण्याचे शुल्क</th>
											<th width="100px !important;">Other Exp./इतर वसुली रक्कम<span class="required"></span></th>
                                            <th width="150px !important;">Vehicle Number/वाहन क्रमांक <span class="required">*</span></th>
                                            <th width="120px !important;">Idling Minutes</th>
                                            <th width="120px !important;">Remarks/टिप्पण्या</th>

										</tr>
									</thead>
									<tbody style="">
										@if($action=='insert')
											<tr class="parishishtha_b">
                                                    <td><input type="text" id="date_pb[0]" name="date_pb[0]" class="date_pb form-control date_pb_auto"></td>

                                                    <td align="center"><input type="checkbox" name="p_k[0]" class="p_k" id="p_k[0]" value="1" style="height:25px;width:25px;"><input type="hidden" name="p_k_v[0]" class="p_k_v" id="p_k_V[0]" ></td>

                                                    <td align="center"><input type="checkbox" name="schedule_complete[0]" class="schedule_complete" id="schedule_complete[0]" value="1" style="height:25px;width:25px;"><input type="hidden" name="s_c_v[0]" class="s_c_v" id="s_c_V[0]" ></td>

													<td><input type="text" id="kms[0]" name="kms[0]"  class="decimalonly kms form-control kms_auto" /></td>
													<td><input type="text" data-precision="2" id="diesel_ltr[0]" name="diesel_ltr[0]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto"></td>
													<td><input type="text" id="diese_per_ltr_price[0]" name="diese_per_ltr_price[0]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto" data-precision="2" value="{{$default_diseal->diesel_rate}}"></td>
													<td><input type="text" id="adblue[0]" name="adblue[0]" class="form-control adblue decimalonly adblue_auto" data-precision="2"></td>
													<td><input type="text" id="adblue_price[0]" name="adblue_price[0]"  class="form-control  adblue_price decimalonly adblue_price_auto" data-precision="2"></td>

                                                    <td>
                                                    <input type="hidden" class="breaddown_charge_value" id="breaddown_charge_value[0]" name="breaddown_charge_value[0]" />
                                                    <input style="width:80px;display:inline;" type="text" id="breaddown_charge[0]" readonly name="breaddown_charge[0]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto" >

                                                    <a class="btn btn-primary btn-xs" data-toggle="modal" id="breakModelAdd" data-target="#breakModal">Add</a>
                                                    </td>

                                                    <td>
                                                       <?php /* <input type="text" id="vor_exp[0]" name="vor_exp[0]"  class="numberonly form-control vor_exp vor_exp_auto"> */ ?>
                                                       <?php $vor_exps = explode(",",$default_diseal->vor_charges);
                                                       ?>
                                                       <select  id="vor_exp[0]" name="vor_exp[0]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;">
                                                        <option value=""></option>
                                                        @foreach($vor_exps as $vor_exp)
                                                        <option value="{{$vor_exp}}">{{$vor_exp}}</option>
                                                        @endforeach
                                                        <select>
                                                    </td>

													<td>
                                                       <?php /* <input type="text" id="parking_exp[0]" name="parking_exp[0]"  class="numberonly form-control  parking_exp parking_exp_auto"> */  ?>
                                                       <?php $parking_exps = explode(",",$default_diseal->parking_charges);
                                                       ?>
                                                       <select  id="parking_exp[0]" name="parking_exp[0]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp " style="width:100%;">
                                                            <option value=""></option>
                                                            @foreach($parking_exps as $parking_exp)
                                                            <option value="{{$parking_exp}}">{{$parking_exp}}</option>
                                                            @endforeach
                                                        <select>

                                                    </td>
													<td><input type="text" id="hault_exp[0]" name="hault_exp[0]"  class=" numberonly form-control  hault_exp hault_exp_auto"></td>
                                                    <td>
                                                     <?php /* <input type="text" id="wash_exp[0]" name="wash_exp[0]"  class="numberonly form-control  wash_exp wash_exp_auto"> */ ?>

                                                     <?php $wash_exps = explode(",",$default_diseal->washing_charges);
                                                     ?>

                                                    <select  id="wash_exp[0]" name="wash_exp[0]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp" style="width:100%;">
                                                        <option value=""></option>
                                                        @foreach($wash_exps as $wash_exp)
                                                        <option value="{{$wash_exp}}">{{$wash_exp}}</option>
                                                        @endforeach
                                                    <select>

                                                    </td>
													<td><input type="text" id="other_exp[0]" name="other_exp[0]"  class=" numberonly form-control  other_exp other_exp_auto"></td>
                                                    <td>
                                                        <input type="text" id="vehicle_id[0]" name="vehicle_id[0]"  class="form-control  vehicle_id vehicle_id_auto">
                                                    </td>
                                                    <td>
                                                        <select  id="idling_minutes" name="idling_minutes[]"  class="form-control select2_single col-md-7 col-xs-12 idling_minutes" style="width:100%;">
                                                            <option value=""></option>
                                                        <select>
                                                    </td>
													<td>
                                                        <?php /*<button  tabindex="1" type="button" class="btn btn-success add btn-xs " onclick="">+</button>
                                                        <button tabindex="1" type="button" class="btn btn-danger  minus btn-xs">-</button> */ ?>

                                                        <textarea rows="1" id="remarks[0]" name="remarks[0]"  class="form-control  remarks "></textarea>
													</td>
											</tr>
										@else
											@php
												$date = explode(",",$parisishthab->date);
                                                $p_k = explode("*++*",$parisishthab->relevant_agreement);
                                                $schedule_complete = explode("*++*",$parisishthab->schedule_complete);
                                                $vehicleArr = explode("*++*",$parisishthab->vehicle_id);
												$kms = explode(",",$parisishthab->kms);
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
                                                $idling_minutes = explode(",",$parisishthab->idling_minutes);
                                                $remarks = explode("*++*",$parisishthab->remarks);
                                                $breaddown_charge_value = explode("*++*",$parisishthab->breaddown_charge_value);

                                                $vor_charges = explode(",",$default_diseal->vor_charges);
                                                $parking_charges = explode(",",$default_diseal->parking_charges);
                                                $wash_charges = explode(",",$default_diseal->washing_charges);

											@endphp

											@for($i=0;$i<count($date);$i++)
                                                @if($date[$i] > date('Y-m-d'))
                                                    <tr class="parishishtha_b">
                                                        <td ><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>
                                                        <td align="center"><input type="checkbox" name="p_k[{{$i}}]" class="p_k" id="p_k[{{$i}}]" value="1" style="height:25px;width:25px;" {{($p_k[$i]==1)?'checked':'' }}><input type="hidden" name="p_k_v[{{$i}}]" class="p_k_v" id="p_k_V[{{$i}}]" value="{{ $p_k[$i]}}"></td>

                                                        <td align="center"><input type="checkbox" name="schedule_complete[{{$i}}]" class="schedule_complete" id="schedule_complete[{{$i}}]" value="1" style="height:25px;width:25px;" {{($schedule_complete[$i]==1)?'checked':'' }}><input type="hidden" name="s_c_v[{{$i}}]" class="s_c_v" id="s_c_V[{{$i}}]" value="{{ $schedule_complete[$i]}}"></td>

                                                        <td><input type="text" readonly id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control" value="{{$kms[$i]}}" /></td>
                                                        <td><input type="text" readonly data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr" value="{{$diesel_ltr[$i]}}"></td>
                                                        <td><input type="text" readonly id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                                        <td><input type="text" readonly id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly" data-precision="2" value="{{$adblue[$i]}}"></td>
                                                        <td><input type="text" readonly id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                                        <td>
                                                        <input type="hidden" class="breaddown_charge_value" id="breaddown_charge_value[{{$i}}]" name="breaddown_charge_value[{{$i}}]" value="{{$breaddown_charge_value[$i]}}" />

                                                        <input type="text" readonly id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge" style="width:80px;display:inline;" value="{{$breaddown_charge[$i]}}" >
                                                        <a class="btn btn-primary btn-xs" data-toggle="modal" id="breakModelAdd" data-target="#breakModal">Add</a>
                                                        </td>
                                                        <td>
                                                           <?php /* <input type="text" readonly id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp" value={{$vor_exp[$i]}}> */
                                                           ?>

                                                           <select  id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;" disabled>
                                                                <option value=""></option>

                                                                @foreach($vor_charges as $vor_charge)
                                                                    <option {{ ($vor_exps[$i] == $vor_charge) ? 'selected' : '' }} value="{{$vor_charge}}">{{$vor_charge}}</option>
                                                                @endforeach
                                                            <select>

                                                        </td>
                                                        <td>
                                                           <?php /* <input type="text" readonly id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp" value={{$parking_exp[$i]}} >
                                                        */ ?>

                                                       <select  id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp" style="width:100%;">
                                                            <option value=""></option>
                                                            @foreach($parking_charges as $parking_charge)
                                                            <option {{ ($parking_exps[$i] == $parking_charge) ? 'selected' : '' }} value="{{$parking_charge}}">{{$parking_charge}}</option>
                                                            @endforeach
                                                        <select>


                                                        </td>
                                                        <td ><input type="text" readonly id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp" value="{{$hault_tax[$i]}}"></td>

                                                        <td >
                                                            <?php /* <input type="text" readonly id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]" class="numberonly form-control wash_exp" value="{{ $wash_exp[$i] }}" /> */ ?>

                                                            <select  id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp" style="width:100%;">
                                                                <option value=""></option>
                                                                @foreach($wash_charges as $wash_charge)
                                                                <option {{ ($wash_exps[$i] == $wash_charge) ? 'selected' : '' }} value="{{$wash_charge}}">{{$wash_charge}}</option>
                                                                @endforeach
                                                            <select>

                                                        </td>

                                                        <td><input type="text" readonly id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp"></td>
                                                        <td>
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

																@php
																	$edit_ideal_min = Helper::getIdulingMinutes($parisishthab->route_id);
																@endphp

                                                                @foreach($edit_ideal_min as $idealMin)
                                                                <option value="{{$idealMin}}" {{($idling_minutes[$i] == $idealMin) ? 'selected':'' }}>{{$idealMin}}</option>
                                                                @endforeach
                                                            <select>
                                                        </td>
                                                        <td>

                                                            <?php /* <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button> */
                                                            ?>

                                                            <textarea rows="1" id="remarks[{{ $i }}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>

                                                        </td>
                                                    </tr>
                                                @else
                                                    @if($i == '0')
                                                    <tr class="parishishtha_b">
                                                        <td><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

                                                        <td align="center"><input type="checkbox" name="p_k[{{$i}}]" class="p_k" id="p_k[{{$i}}]" value="1" style="height:25px;width:25px;" {{($p_k[$i]==1)?'checked':'' }}><input type="hidden" name="p_k_v[{{$i}}]" class="p_k_v" id="p_k_V[{{$i}}]" value="{{ $p_k[$i]}}"></td>

                                                        <td align="center"><input type="checkbox" name="schedule_complete[{{$i}}]" class="schedule_complete" id="schedule_complete[{{$i}}]" value="1" style="height:25px;width:25px;" {{($schedule_complete[$i]==1)?'checked':'' }}><input type="hidden" name="s_c_v[{{$i}}]" class="s_c_v" id="s_c_V[{{$i}}]" value="{{ $schedule_complete[$i]}}"></td>

                                                        <td ><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control kms_auto" value="{{$kms[$i]}}" /></td>
                                                        <td ><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto" value="{{$diesel_ltr[$i]}}"></td>
                                                        <td ><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                                        <td ><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly adblue_auto" data-precision="2" value="{{$adblue[$i]}}"></td>
                                                        <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly adblue_price_auto" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                                        <td>
                                                        <input type="hidden" class="breaddown_charge_value" id="breaddown_charge_value[{{$i}}]" name="breaddown_charge_value[{{$i}}]"  value="{{$breaddown_charge_value[$i]}}" />

                                                        <input type="text" readonly id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto" style="width:80px;display:inline;" value="{{$breaddown_charge[$i]}}" >

                                                        <a class="btn btn-primary btn-xs breakModelAdd" data-toggle="modal" id="breakModelAdd" data-target="#breakModal">Edit</a>

                                                        </td>
                                                        <td>
                                                        <?php /*  <input type="text" id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp vor_exp_auto" value={{$vor_exp[$i]}}>
                                                       */ ?>

                                                       <select  id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;" >
                                                            <option value=""></option>

                                                            @foreach($vor_charges as $vor_charge)
                                                                <option {{ ($vor_exps[$i] == $vor_charge) ? 'selected' : '' }} value="{{$vor_charge}}">{{$vor_charge}}</option>
                                                            @endforeach
                                                        <select>

                                                        </td>
                                                        <td>
                                                        <?php /* <input type="text" id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp parking_exp_auto" value={{$parking_exp[$i]}} > */ ?>

                                                        <select  id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp" style="width:100%;">
                                                            <option value=""></option>
                                                            @foreach($parking_charges as $parking_charge)
                                                            <option {{ ($parking_exps[$i] == $parking_charge) ? 'selected' : '' }} value="{{$parking_charge}}">{{$parking_charge}}</option>
                                                            @endforeach
                                                        <select>

                                                        </td>
                                                        <td><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp hault_exp_auto" value="{{$hault_tax[$i]}}"></td>

                                                        <td>
                                                           <?php /* <input type="text" id="wash_exp[{{$i}}]" name="wash_exp[{{ $i }}]" class="numberonly form-control wash_exp wash_exp_auto" value="{{ $wash_exp[$i] }}" /> */ ?>
                                                           <select  id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp" style="width:100%;">
                                                                <option value=""></option>
                                                                @foreach($wash_charges as $wash_charge)
                                                                <option {{ ($wash_exps[$i] == $wash_charge) ? 'selected' : '' }} value="{{$wash_charge}}">{{$wash_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                        </td>

                                                        <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp other_exp_auto"></td>
                                                        <td>
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
																@php
																	$edit_ideal_min = Helper::getIdulingMinutes($parisishthab->route_id);
																@endphp
                                                                @foreach($edit_ideal_min as $idealMin)
                                                                <option value="{{$idealMin}}" >{{$idealMin}}</option>
                                                                @endforeach
                                                            <select>
                                                        </td>
                                                        <td>

                                                            <?php /* <button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                                <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button> */ ?>

                                                            <textarea rows="1" id="remarks[{{ $i }}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>

                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr class="parishishtha_b">
                                                        <td ><input type="text" readonly id="date_pb[{{$i}}]" name="date_pb[{{$i}}]"  class="date_pb form-control" value="{{date("d-m-Y",strtotime($date[$i])) }}"></td>

                                                        <td align="center"><input type="checkbox" name="p_k[{{$i}}]" class="p_k" id="p_k[{{$i}}]" value="1" style="height:25px;width:25px;" {{($p_k[$i]==1)?'checked':'' }}><input type="hidden" name="p_k_v[{{$i}}]" class="p_k_v" id="p_k_V[{{$i}}]" value="{{ $p_k[$i]}}"></td>

                                                        <td align="center"><input type="checkbox" name="schedule_complete[{{$i}}]" class="schedule_complete" id="schedule_complete[{{$i}}]" value="1" style="height:25px;width:25px;" {{($schedule_complete[$i]==1)?'checked':'' }}><input type="hidden" name="s_c_v[{{$i}}]" class="s_c_v" id="s_c_V[{{$i}}]" value="{{ $schedule_complete[$i]}}"></td>

                                                        <td><input type="text" id="kms[{{$i}}]" name="kms[{{$i}}]"  class="decimalonly kms form-control kms_auto_total" value="{{$kms[$i]}}" /></td>
                                                        <td><input type="text" data-precision="2" id="diesel_ltr[{{$i}}]" name="diesel_ltr[{{$i}}]"  class="decimalonly form-control  diesel_ltr diesel_ltr_auto_total" value="{{$diesel_ltr[$i]}}"></td>
                                                        <td><input type="text" id="diese_per_ltr_price[{{$i}}]" name="diese_per_ltr_price[{{$i}}]"  class="form-control  diese_per_ltr_price decimalonly diese_per_ltr_price_auto_total" data-precision="2" value="{{$diese_per_ltr_price[$i]}}"></td>
                                                        <td><input type="text" id="adblue[{{$i}}]" name="adblue[{{$i}}]"  class="form-control adblue decimalonly adblue_auto_total" data-precision="2" value="{{$adblue[$i]}}"></td>
                                                        <td><input type="text" id="adblue_price[{{$i}}]" name="adblue_price[{{$i}}]"  class="form-control  adblue_price decimalonly adblue_price_auto_total" value="{{$adblue_price[$i]}}" data-precision="2"></td>
                                                        <td>

                                                        <input type="hidden" class="breaddown_charge_value" id="breaddown_charge_value[{{$i}}]" name="breaddown_charge_value[{{$i}}]" value="{{$breaddown_charge_value[$i]}}" />

                                                        <input type="text" readonly id="breaddown_charge[{{$i}}]" name="breaddown_charge[{{$i}}]"  class="numberonly form-control  breaddown_charge breaddown_charge_auto_total" style="width:80px;display:inline;" value="{{$breaddown_charge[$i]}}" >

                                                        <a class="btn btn-primary btn-xs breakModelAdd" data-toggle="modal" id="breakModelAdd" data-target="#breakModal">Edit</a>

                                                        </td>
                                                        <td >
                                                        <?php /* <input type="text" id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="numberonly form-control vor_exp vor_exp_auto_total" value={{$vor_exp[$i]}}>
                                                        */ ?>


                                                        <select  id="vor_exp[{{$i}}]" name="vor_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 vor_exp" style="width:100%;">
                                                            <option value=""></option>

                                                            @foreach($vor_charges as $vor_charge)
                                                                <option {{ ($vor_exps[$i] == $vor_charge) ? 'selected' : '' }} value="{{$vor_charge}}">{{$vor_charge}}</option>
                                                            @endforeach
                                                        <select>

                                                        </td>
                                                        <td>
                                                          <?php /* <input type="text" id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="numberonly form-control  parking_exp parking_exp_auto_total" value={{$parking_exp[$i]}} > */?>

                                                          <select  id="parking_exp[{{$i}}]" name="parking_exp[{{$i}}]"  class="form-control select2_single col-md-7 col-xs-12 parking_exp" style="width:100%;">
                                                                <option value=""></option>
                                                                @foreach($parking_charges as $parking_charge)
                                                                <option {{ ($parking_exps[$i] == $parking_charge) ? 'selected' : '' }} value="{{$parking_charge}}">{{$parking_charge}}</option>
                                                                @endforeach
                                                            <select>


                                                        </td>
                                                        <td ><input type="text" id="hault_exp[{{$i}}]" name="hault_exp[{{$i}}]"  class=" numberonly form-control  hault_exp hault_exp_auto_total" value="{{$hault_tax[$i]}}"></td>

                                                        <td>
                                                           <?php /* <input type="text" id="wash_exp[{{$i}}]" name="wash_exp[{{ $i }}]" class="numberonly form-control wash_exp wash_exp_auto_total" value="{{ $wash_exp[$i] }}" /> */ ?>
                                                           <select  id="wash_exp[{{ $i }}]" name="wash_exp[{{ $i }}]"  class="form-control select2_single col-md-7 col-xs-12 wash_exp" style="width:100%;">
                                                                <option value=""></option>
                                                                @foreach($wash_charges as $wash_charge)
                                                                <option {{ ($wash_exps[$i] == $wash_charge) ? 'selected' : '' }} value="{{$wash_charge}}">{{$wash_charge}}</option>
                                                                @endforeach
                                                            <select>
                                                        </td>
                                                        <td><input type="text" id="other_exp[{{$i}}]" name="other_exp[{{$i}}]" value="{{$other_exp[$i]}}"  class=" numberonly form-control  other_exp other_exp_auto_total"></td>
                                                        <td>
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
															@php
																	$edit_ideal_min = Helper::getIdulingMinutes($parisishthab->route_id);
																@endphp
                                                                @foreach($edit_ideal_min as $idealMin)
                                                                <option value="{{$idealMin}}" {{($idling_minutes[$i] == $idealMin) ? 'selected':'' }}>{{$idealMin}}</option>
                                                                @endforeach
                                                            <select>
                                                        </td>
                                                        <td>
                                                            <?php /*<button  tabindex="1" type="button" class="btn btn-success btn-xs add" onclick="">+</button>
                                                            <button tabindex="1" type="button" class="btn btn-danger btn-xs minus">-</button> */ ?>
                                                            <textarea rows="1" id="remarks[{{ $i }}]" name="remarks[{{ $i }}]"  class="form-control  remarks ">{{ $remarks[$i] }}</textarea>

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
												<td colspan="3">Total</td>

												<td><input type="text" class="form-control"  name="total_kms" id="total_kms" value="{{ array_sum($kms) }}" readonly></td>
												<td><input type="text" class="form-control" name="total_diesel" id="total_diesel" value="{{ array_sum($diesel_ltr) }}" readonly></td>
												<td></td>
													<td><input type="text" class="form-control total_adblue" value="@if($action=='update' || $action == 'view') {{array_sum($adblue)}} @endif" name="total_adblue" id="total_adblue" readonly></td>
												<td></td>
												<td><input type="text" class="form-control total_breaddown_charge" name="total_breaddown_charge" id="total_breaddown_charge" value="@if($action=='update' || $action == 'view') {{array_sum($breaddown_charge)}} @endif" readonly></td>
												<td><input type="text" class="form-control total_vor_exp" name="total_vor_exp" value="@if($action=='update' || $action == 'view') {{array_sum($vor_exps)}} @endif" id="total_vor_exp" readonly></td>
												<td><input type="text" class="form-control" name="total_parking_exp" id="total_parking_exp" readonly value="{{ array_sum($parking_exps) }}"></td>
												<td><input type="text" class="form-control total_hault_exp"  value="@if($action=='update' || $action == 'view') {{array_sum($hault_tax)}} @endif" name="total_hault_exp" id="total_hault_exp" readonly></td>

                                                <td><input type="text" class="form-control total_wash_exp"  value="@if($action=='update' || $action == 'view') {{array_sum($wash_exps)}} @endif" name="total_wash_exp" id="total_wash_exp" readonly></td>

												<td><input type="text" class="form-control" name="total_other_exp" value="{{ array_sum($other_exp) }}" id="total_other_exp" readonly></td>
                                                <td></td>
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
									<td><input type="text" class="form-control"  name="kms_total" id="kms_total" readonly value="{{ array_sum($kms) }}"></td>
									<td>
                                        @php
                                            
                                            $ideling = array_map("calDiesel",$idling_minutes)
                                        @endphp
                                        <input type="text" class="form-control"  name="diesel_total" id="diesel_total" readonly value="{{ array_sum($diesel_ltr) - array_sum($ideling) }}"></td>
									<td><input readonly type="text" data-precision="2" class="decimalonly form-control"  name="gov_diesel" id="gov_diesel" value="@if($action=='update' || $action=='view') {{$parisishthab->diesel_as_per_gov}} @endif" ></td>
									<td><input type="text" class="form-control"  name="extra_diesel" id="extra_diesel" readonly value="{{ $parisishthab->extra_filled_diesel }}"></td>
								</tr>
								<tr>
										<th colspan="3" style="text-align:right;">Extra Filled Diesel Charges / जादा पुरीविलेले डिझेलची वसुली</th>
										<td width="10%"><input type="text" class="form-control"  name="extra_diesel_charge" id="extra_diesel_charge" value="{{ $parisishthab->extra_diesel_charged }}" readonly ></td>
								</tr>
							</table>
				<hr style="border-top: 4px solid #afa5a5">
            @endforeach
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
<style>
    .wrapper1, .wrapper2{width: 100%; overflow-x: scroll; overflow-y:hidden;}
    
    .wrapper1{height: 20px; }
    
    .div1 {width:1700px; height: 20px; }
    .div2 {width:1700px; overflow: auto;}
    </style>
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

<!--Break Modal -->
<div class="modal fade" id="breakModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					Add Charges
				</h4>
			</div>
			<!-- Modal Body -->
			<div class="modal-body">
				<form class="form-horizontal" id="frmBreak" autocomplete="off">
					<div class="form-group">
						<label  class="col-sm-5 control-label">Breakdown Charges</label>
						<div class="col-sm-7">
							<input type="text" class="form-control amountonly" name="breakdown_charge" id="breakdown_charge" placeholder="Enter charge"/>
						</div>
					</div>

                    <div class="form-group">
						<label  class="col-sm-5 control-label">Passenger Refund</label>
						<div class="col-sm-7">
							<input type="text" class="form-control amountonly" name="passenger_refund" id="passenger_refund" placeholder="Enter charge"/>
						</div>
					</div>

                    <div class="form-group">
						<label  class="col-sm-5 control-label">Mechanic Charges</label>
						<div class="col-sm-7">
							<input type="text" class="form-control amountonly" name="mechanic_charge" id="mechanic_charge" placeholder="Enter charge"/>
						</div>
					</div>

                    <div class="form-group">
						<label  class="col-sm-5 control-label">Breakdown Relief bus C.C. charges</label>
						<div class="col-sm-7">
							<input type="text" class="form-control amountonly" name="breakdown_relief_charge" id="breakdown_relief_charge" placeholder="Enter charge"/>
						</div>
					</div>

                    <div class="form-group">
						<label  class="col-sm-5 control-label">Spare parts charges</label>
						<div class="col-sm-7">
							<input type="text" class="form-control amountonly" name="spare_parts_charge" id="spare_parts_charge" placeholder="Enter charge"/>
						</div>
					</div>

                    <div class="form-group">
						<label  class="col-sm-5 control-label">Breakdown Vehicle C.C. charges</label>
						<div class="col-sm-7">
							<input type="text" class="form-control amountonly" name="breakdown_vehicle_charge" id="breakdown_vehicle_charge" placeholder="Enter charge"/>
						</div>
					</div>

                    <div class="form-group">
						<label  class="col-sm-5 control-label">Total Charge</label>
						<div class="col-sm-7">
							<input type="text" readonly class="form-control amountonly" name="total_breakdown_charge" id="total_breakdown_charge" />
						</div>
					</div>

					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-9">
							<button type="submit" class="btn btn-default" id="breakSubmit">Add</button>
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

    $(function(){
        $(".wrapper1").scroll(function(){
            var $th = $(this);
          var $index = $("div.wrapper1").index(this);
          $th.parent().find(".wrapper2:eq("+$index+")")
                .scrollLeft($th.scrollLeft());
        });
        $(".wrapper2").scroll(function(){
          var $th = $(this);
          var $index = $("div.wrapper2").index(this);
            $th.parent().find(".wrapper1:eq("+$index+")")
            .scrollLeft($th.scrollLeft());
        });
        
    });
</script>
<script type="text/javascript">

jQuery(document).ready(function($){
    $('textarea').prop('readonly',true);
    $('input').prop('readonly',true);
    $('select').prop('disabled',true);
    $(".breakModelAdd").text('View');
    $('.schedule_complete').prop('disabled',true);
    $('.p_k').prop('disabled',true);

    $('body').on('click','#breakModelAdd',function(e){
        thIs = $(this);
        var oldval = $(this).closest('tr').find('.breaddown_charge_value').val();
        var breakdown = oldval.split(',');

        $('#breakdown_charge').val(breakdown[0]);
        $('#passenger_refund').val(breakdown[1]);
        $('#mechanic_charge').val(breakdown[2]);
        $('#breakdown_relief_charge').val(breakdown[3]);
        $('#spare_parts_charge').val(breakdown[4]);
        $('#breakdown_vehicle_charge').val(breakdown[5]);
        $('#total_breakdown_charge').val(breakdown[6]);

    });
});
</script>
@endsection