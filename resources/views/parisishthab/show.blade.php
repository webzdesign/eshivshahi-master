<?php
  /*
    Hardik
    Date:23-8-18
  */

?>

@extends('layouts.master')
@section('content')
@if($action=='insert')
   @php  $btn = 'Add'; @endphp
@else
    @php $btn = 'Update'; @endphp
@endif
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">

              </div>
              <div class="title_right">
                 <a href="{{url("/$route")}}"  class="btn btn-primary" >Cancel</a>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $btn }} {{ $modulename }}</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                  @if($action=='insert')
                  <form id="frm" method="post"  action ="{{url("/$route")}}"   class="form-horizontal form-label-left">
                  @else
                  <form id="frm" method="post"  action ="{{url("/$route/".$result->id)}}" class="form-horizontal form-label-left">
                 		<input type="hidden" name="_method" value="PUT">
                  @endif

                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >First Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="first_name" name="first_name" readonly  class="form-control col-md-7 col-xs-12 first_name" value="{{ $action=='update'?$result->first_name:old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                    <span class="error">
                                     <b> {{ $errors->first('first_name') }}</b>
                                    </span>
                                     @endif
                                </div>

                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Last Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="last_name" name="last_name" readonly class="form-control col-md-7 col-xs-12 last_name" value="{{ $action=='update'?$result->last_name:old('last_name') }}">
                                    @if ($errors->has('last_name'))
                                    <span class="error">
                                     <b> {{ $errors->first('last_name') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="email" name="email" readonly  class="form-control col-md-7 col-xs-12 email" value="{{ $action=='update'?$result->email:old('email') }}">
                                    @if ($errors->has('email'))
                                    <span class="error">
                                     <b> {{ $errors->first('email') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            @if($action=='insert')
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Password
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="password" id="password" name="password"  class="form-control col-md-7 col-xs-12	password" value="">
                                    @if ($errors->has('password'))
                                    <span class="error">
                                     <b> {{ $errors->first('password') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Divison
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="division_id" name="division_id" disabled style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 division_id">
                                        <option value=""></option>
                                        @foreach($division as $division_val)
                                        <option value="{{ $division_val->id }}" @if($action=='update') {{ $division_val->id==$result->division_id?'selected':''}} @endif>{{ $division_val->name }}</option>
                                        @endforeach
                                    <select>
                                   @if ($errors->has('division_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('division_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Depot
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="depot_id" name="depot_id" disabled class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($depot as $depot_val)
                                        <option value="{{$depot_val->id}}"  @if($action=='update') {{ $depot_val->id==$result->depot_id?'selected':''}} @endif>{{$depot_val->name}}</option>
                                        @endforeach
                                    <select>
                                     @if ($errors->has('depot_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('depot_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >User Type
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select  id="usertype_id" name="usertype_id" disabled  class="form-control select2_single col-md-7 col-xs-12 usertype_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($usertype as $usertype_val)
                                        <option value="{{$usertype_val->id}}"  @if($action=='update') {{ $usertype_val->id==$result->usertype_id?'selected':''}} @endif>{{$usertype_val->name}}</option>
                                        @endforeach
                                    <select>
                                    @if ($errors->has('usertype_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('usertype_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Access Type
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="accesstype_id" disabled name="accesstype_id"  class="form-control select2_single col-md-7 col-xs-12 accesstype_id">
                                        <option value=""></option>
                                        @foreach($accesstype as $accesstype_val)
                                        <option value="{{ $accesstype_val->id }}"  @if($action=='update') {{ $accesstype_val->id==$result->accesstype_id?'selected':''}} @endif>{{ $accesstype_val->name }}</option>
                                        @endforeach
                                    <select>

                                    @if ($errors->has('accesstype_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('accesstype_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
@section('script')
<script type="text/javascript">
<script type="text/javascript">
jQuery(document).ready(function($){


	/* For Calc Total */
	function getTotal()
	{
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
		$('#total_adblue').val(totalAddBlue.toFixed(2));


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
		$('#total_breaddown_charge').val(totalbreaddown.toFixed(2));


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
		$('#total_vor_exp').val(totalvorexp.toFixed(2));


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
		$('#total_hault_exp').val(totalhaultexp.toFixed(2));

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

    var d = new Date();
    $('#voucher_date').datepicker({
        format:'dd-mm-yyyy',
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


            }



        }
         /** function for cloning end*/

         /* Get Vehicle On Depot */
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

        $("body").on("change","#invoice_no",function(){
                $(".blockUI").show();
               var invoice_no = $(this).val();
               var id = $("#id").val();

                $.ajax({
                    type:'POST',
                    url:'{{url('/checkDuplicateInvoice')}}',
                    data:{
                        invoice_no:invoice_no,
                        id:id
                    },
                    success:function(result){
                        if(result=='false'){
                            alert('Already Exist');
                            $("#invoice_no").val('');
                        }else{

                        }
                        $(".blockUI").hide();
                    }
                });
        });
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
                            url: "{{url($checkvoucher)}}",
                            type: "post",
                            data:{
                                id:function(){
                                    return $("input[name='id']").val();
                                },
                            },
                        },
                    },

                    depot_id:{required:true,},
                    vendor_id:{required:true,},
                    from_date:{required:true,},
                    to:{required:true,},
                    voucher_date:{
                        required:true,
                    },
                    vehicle_id:{
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
                    voucher_no:{
                        remote:"Voucher No Already Exist",
                    },
                    voucher_date:{
                        required:"Please Select Voucher Date",
                    },
                    vehicle_id:{
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



         });

         $("body").on("click","#save_submit",function(e){

                e.preventDefault();
                if($("#frm_single").valid())
                {

                    var kms_a = [];
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
         });

          /* Hardik */
          $("body").on("change",".diesel_ltr",function(e){
                   $("#gov_diesel").val('');
                   $("#extra_diesel").val('');
                   $("#extra_diesel_charge").val('');
          });
        /* Hardik */
          $("body").on("change",".diese_per_ltr_price",function(e){
                   $("#gov_diesel").val('');
                   $("#extra_diesel").val('');
                   $("#extra_diesel_charge").val('');
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
						 $("#vehicle_id").empty().html(result);
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
    }
    if('{{$action}}'=='view')
    {
        $('input').prop('readonly',true);
        $('select').prop('disabled',true)
    }
});
function setFlag(p){
		$("#status").val(p);
	}
</script>
@endsection