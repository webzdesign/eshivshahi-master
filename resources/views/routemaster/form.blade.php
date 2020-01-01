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
					<h2>{{$title}}</h2>
					<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form class="form-horizontal" id="frm" method="POST" action="{{ route('routemaster.store') }}" autocomplete="off">
							@csrf

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Division <span class=" required"> *</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">

									<select  id="division_id" name="division_id" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 division_id">

									<option value=""></option>

										@foreach($divisions as $division)

										<option value="{{ $division->id }}" {{($routemaster->division_id==$division->id)?'selected':''}}>{{ $division->name }}</option>

										@endforeach

									</select>

								</div>
							</div>

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >From Depot <span class=" required"> *</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">

									<select  id="from_depot" name="from_depot" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 from_depot">

									<option value=""></option>
									</select>

								</div>
							</div>

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >To Division <span class=" required"> *</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">

									<select  id="to_division" name="to_division" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 to_division">

										<option value=""></option>

										@foreach($divisions as $division)

										<option value="{{ $division->id }}" {{($routemaster->to_division==$division->id)?'selected':''}}>{{ $division->name }}</option>

										@endforeach

									</select>

								</div>
							</div>

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >To Depot <span class="required"> *</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">

									<select  id="to_depot" name="to_depot" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 to_depot">

										<option value=""></option>

										@if($action=='update')

										@foreach($depots as $depot)

										@if($depot->division_id == $routemaster->to_division)

											<option value="{{ $depot->id }}" {{($depot->id==$routemaster->to_depot)?'selected':''}}>{{ $depot->name }}</option>

										@endif

										@endforeach

									@endif

									</select>

								</div>
							</div>

							<div class="form-group">
								<label  class=" col-md-3 col-sm-3 col-xs-12">Scheduled KM<span class=" required"> *</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control " name="scheduled_km" id="scheduled_km" value="" placeholder="Enter KM"/>
								</div>
							</div>

							<div class="form-group">
								<label  class=" col-md-3 col-sm-3 col-xs-12">Maximum Ideling Minutes<span class=" required"> *</span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control numberonly" name="maximum_ideling_minutes" id="maximum_ideling_minutes" value="" placeholder="Enter Maximum Ideling Minutes" maxlength="3" />
								</div>
							</div>

							<div class="form-group">
								<label  class=" col-md-3 col-sm-3 col-xs-12">Trip Duration<span class=" required"> *</span></label>
								<div class="col-md-3 col-sm-3 col-xs-12">
								Hours
								<input type="text" class="form-control numberonly" name="trip_hr" id="trip_hr" value="" placeholder="Hours"/>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-12">
								Minutes
								<input type="text" class="form-control numberonly" name="trip_min" id="trip_min" value="" placeholder="Minutes"/>
								</div>
							</div>


							<div class="row">
								<table class="table table-bordered" id="scheduled_time" cellspacing="0">
									<thead>
										<tr>
											<th>SrNo</th>
											<th width="25%">Schedule Timing</th>
											<th width="25%">Schedule Number</th>
											<th width="25%">Bus Type</th>
											<th>Action</th>
										</tr>
									<thead>
									<tbody>
										<tr class="scheduled_time">

											<td><label class="sr_no">1 </label></td>

											<td>
												<input  type="text" class="form-control s_time" name="s_time[]" id="s_time" value="" placeholder="Timing" readonly/>
											</td>
											<td>
												<input  type="text" class="form-control  schedule_number numberonly" name="schedule_number[]" id="schedule_number" value="" placeholder="Schedule Number"/>
											</td>
											<td>
												<select name="bus_type[]" id="bus_type" class="form-control bus_type select2_single" style="width:100%;">
													<option value="">Select</option>
													<option value="seater">Seater</option>
													<option value="sleeper">Sleeper</option>
												</select>
											</td>
											<td>
												<button type="button" class="add-row btn btn-success">+</button>
												<button type="button" class="delete-row btn btn-danger">-</button>
											</td>
										</tr>
										<tr>
											<td></td>
                                            <td>
												<label id="stime_required_err" ></label></br>
												<label id="server_time_label" ></label></br>
												<label id="stime_duplicate_err" ></label>
											</td>
											<td>
												<label id="snumber_required_err" name="server_num"></label></br>
												<label id="server_schNumber_label" name="server_num"></label></br>
												<label id="snumber_duplicate_err" name="server_num"></label>
												
											</td>
											<td>
												<label id="bus_type_err"></label>
											</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="form-group">
								<label class=" col-md-3 col-sm-3 col-xs-12" >Status<span class="error">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <div class="radio">
										<label style="margin-right:20px;">
											<input type="radio" name="status" id="status" value="1" checked> Active
										</label>
										<label>
											<input type="radio" name="status" id="status" value="0"> Deactive
										</label>
										<div id="errorClass">
										</div>
									</div>
								</div>
						</div>
						<label id="status-error" class="errors" for="status" style="margin-left:212px;"></label>

							<div class="form-group">
								<label  class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<input type="submit" id="form_btn" value="Save" class="btn  btn-primary"/>
								<a href="{{url('routemaster')}}"  class="btn btn-warning" >Cancel </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

@endsection
@section('script')
<script>

jQuery(document).ready(function() {
	var serverTimeStatus = 0;
	var serverNumberStatus = 0;

	$('.s_time').datetimepicker({
		format: 'HH:mm',
		ignoreReadonly: true
	}).on('dp.change', function (event) {
		checkvalidtime();
	});

	var form=$("#frm");

    $(document).on('change', '.division_id' ,function(){
        division_id = $(this).val();
        $.ajax({
            url: "{{url('/getdepot')}}",
            type: "POST",
            dataType:'html',
            data: {division_id : division_id},
            success:function(data){
                $("select[name='from_depot']").html(data);
             },
        });
    });

	$(document).on('change', '.to_division' ,function(){
		division_id = $(this).val();

		$.ajax({
			url: "{{url('/getdepot')}}",
			type: "POST",
			dataType:'html',
			data: {division_id : division_id},
			success:function(data){
				$("select[name='to_depot']").html(data);
			},
		});
	});

	/* check Schedule time server side start */
	function checkvalidtime()
	{
		var division_id = $('#division_id').val();
		var from_depot = $('#from_depot').val();
		var to_division = $('#to_division').val();
		var to_depot = $('#to_depot').val();
		var schedule_number =$(".schedule_number").map(function(){return $(this).val();}).get().join(",");
		var s_time = $(".s_time").map(function(){return $(this).val();}).get().join(",");

		$.ajax({
			url: "{{url('/checkScheduledTiming')}}",
			type: "POST",
			dataType:'json',
			data: { division_id:division_id, from_depot:from_depot, to_division:to_division, to_depot:to_depot, s_time:s_time, schedule_number:schedule_number },
			success:function(data){
				if(data == false){
					serverTimeStatus = 1;
					var str = 'This Schedule Time is already used this Route';
					var result = str.fontcolor("red");
					$('body').find('#server_time_label').html(result);
				} else {
					$('body').find('#server_time_label').html('');
					serverTimeStatus = 0;
				}
			},
		});
	}
	/* check Schedule time server side end */

	/* check Schedule Number server side start */
	function checkvalidSchNumber(){
		var division_id = $('#division_id').val();
		var from_depot = $('#from_depot').val();
		var to_division = $('#to_division').val();
		var to_depot = $('#to_depot').val();
		var schedule_number =$(".schedule_number").map(function(){return $(this).val();}).get().join(",");
		var s_time = $(".s_time").map(function(){return $(this).val();}).get().join(",");

		$.ajax({
			url: "{{url('/checkScheduledNumber')}}",
			type: "POST",
			dataType:'json',
			data: { division_id:division_id, from_depot:from_depot, to_division:to_division, to_depot:to_depot, schedule_number:schedule_number, s_time:s_time },
			success:function(data){
				if(data == false){
					serverNumberStatus = 1;
					var str = 'This Schedule Number is already used this Route';
					var result = str.fontcolor("red");
					$('body').find('#server_schNumber_label').html(result);
				} else {
					$('body').find('#server_schNumber_label').html('');
					serverNumberStatus = 0;
				}
			},
		});
	}

	$("body").on('keyup','.schedule_number' ,function(e){
		checkvalidSchNumber();
	});

	$("body").on('change', '#division_id, #from_depot, #to_division, #to_depot', function(e){
		checkvalidSchNumber();
		checkvalidtime();
	});
	/* check Schedule Number server side end */


	/* auto increment number in clone method start*/
    function sr_change(){
      var count= $('.scheduled_time').length;
      for(var i=0; i< count; i++){
        var cnt = i+1;
        $("label.sr_no").eq(i).text(cnt);
      }
	}
	/* auto increment number in clone method end*/

  $(document).on('click','.add-row' ,function(event){

	var $tr = $(this).closest('.scheduled_time');
	var $clone = $tr.clone();

	$clone.find('input').val('');
	$clone.find('span:nth-child(3)').remove();
	$clone.find("span").remove();

	$clone.find(".select2_single").select2({
        placeholder: "Select",
        allowClear: true
    });
	
	$clone.find(".s_time").datetimepicker({
		format: 'HH:mm',
		ignoreReadonly: true
	}).on('dp.change', function (event) {
		checkvalidtime();
	});

	$tr.after($clone);
	sr_change();

	//$clone.find(".s_time").rules('add', time_hr);


	/*var num = $('.scheduled_time').length;
	var t=$(this).closest('.scheduled_time');

	t.find('.s_time').datetimepicker('destroy');
	var clone=$(t).clone(true,true);

	clone.find('input').val('');
	$("#scheduled_time tbody").children().last().after(clone);
	clone.find(".s_time").attr('id', 's_time['+num+']').attr('name', 's_time['+num+']');
	clone.find(".s_time").datetimepicker({ format: 'HH:mm', ignoreReadonly: true});
	clone.find('td').each(function() {

	var el = $(this).find(':first-child');
	var elthis = "#"+el.attr("id");
	var id = el.attr('id') || null;

		if (id) {
			var i = id.substr(elthis.indexOf("[")-1);
			var j= i.replace(/[\[\]']+/g,'');
			var prefix = id.substr(0, elthis.indexOf("[")-1);
			if(j > -1){
				if(prefix=="s_time"){
					if(el.next().hasClass('errors')){
						el.next().remove();
					}
					el.addClass('s_time');
				}
			}
		}
	});
	t.find(".s_time").datetimepicker({ format: 'HH:mm',ignoreReadonly: true});
	clone.find(".s_time").rules('add', time_hr);
	sr_change();*/
  });

    /*var time_hr =  {
        required: true,
        messages: {
      		required: "Please Enter Scheduled Time",
        	}
		 }*/

	$(document).on('click','.delete-row' ,function(event){
		if($(".scheduled_time").length>1){
			$(this).closest(".scheduled_time").remove();
			sr_change();
		}
	});

	$('body').on('click','.minus' ,function(event){
		if($(".scheduled_time").length > 1){
			$(this).closest(".scheduled_time").remove();
			sr_change();
		}
	});

	/* Required Fields Schedule Time and Number start*/
	function requiredCheck()
	{
		var stimeCheck = [];
		var snumberCheck = [];
		var busTypeCheck = [];

		var errorStatus = 0;

		$('.s_time').each(function () {
			if ($(this).val() == '' ) {
				stimeCheck.push(0);
			} else  {
				stimeCheck.push(1);
			}
		});

		$('.schedule_number').each(function () {
			if ($(this).val() == '' ) {
				snumberCheck.push(0);
			} else  {
				snumberCheck.push(1);
			}
		});

		$('.bus_type').each(function () {
			if ($(this).val() == '' ) {
				busTypeCheck.push(0);
			} else  {
				busTypeCheck.push(1);
			}
		});

		var stime_err = stimeCheck.indexOf(0);
		var snumber_err = snumberCheck.indexOf(0);
		var busType_err = busTypeCheck.indexOf(0);

		if (stime_err != '-1') {
			var str = "Select Schedule Time";
			var result = str.fontcolor("red");
			document.getElementById('stime_required_err').innerHTML = result;
			errorStatus = 1;
		} else {
			document.getElementById('stime_required_err').innerHTML = '';
		}

		if (snumber_err != '-1') {
			var str = "Please Enter Schedule Number";
			var result = str.fontcolor("red");
			document.getElementById('snumber_required_err').innerHTML = result;
			errorStatus = 1;
		} else {
			document.getElementById('snumber_required_err').innerHTML = '';
		}

		if (busType_err != '-1') {
			var str = "Please Select Bus Type";
			var result = str.fontcolor("red");
			document.getElementById('bus_type_err').innerHTML = result;
			errorStatus = 1;
		} else {
			document.getElementById('bus_type_err').innerHTML = '';
		}

		return errorStatus;
	}
	/* Required Fields Schedule Time and Number end*/

	/* Check Schedule Time and number at a time not same insert Start*/
	function DuplicateCheck() {
		var timeVals = [];
		var submitStatus = 0;
		$('.s_time').each(function (){
			if ($(this).val() !='') {
				var snum = $(this).closest('tr').find('.schedule_number').val();

				var val = $(this).val()+'='+snum;
				if (jQuery.inArray( val,timeVals) !== -1) {
					submitStatus = 1;
					var str = 'Scheduled Time Already Exists.';
					var result = str.fontcolor("red");
					$('body').find('#stime_duplicate_err').html(result);
				} else {
					$('body').find('#stime_duplicate_err').html('');
					timeVals.push(val);
				}
			}
		});

		var scheduleNumberVals = [];

		$('.schedule_number').each(function (){
			if ($(this).val() !='') {
				var stime = $(this).closest('tr').find('.s_time').val();

				var val = $(this).val()+'='+stime;
				if (jQuery.inArray( val,scheduleNumberVals) !== -1) {
					submitStatus = 1;
					var str = 'Scheduled Number Already Exists.';
					var result = str.fontcolor("red");
					$('body').find('#snumber_duplicate_err').html(result);
				} else {
					$('body').find('#snumber_duplicate_err').html('');
					scheduleNumberVals.push(val);
				}
			}
		});
		return submitStatus;
	}
	/* Check Schedule Time and number at a time not same insert End*/

	$('#frm').validate({

		errorClass: 'errors',
		rules: {
			division_id:{required:true,},
			from_depot:{required:true,},
			to_depot:{required:true,},
			to_division:{required:true,},
			scheduled_km:{required:true,},
			maximum_ideling_minutes:{ required:true, jquerynumber:true, },
			'scheduled_hr[0]':{required:true,},
			'scheduled_min[0]':{required:true,},
			's_time[0]':{required:true,},
			'trip_hr':{required:true,jquerynumber:true},
			'trip_min':{required:true,jquerynumber:true},
			status: {required:true,},
		},
		messages: {
			division_id:{required:"Please Select Division",},
			from_depot:{required:"Please Select From Depot",},
			to_depot:{required:"Please Select To Depot ",},
			to_division:{required:"Please Select To Division",},
			scheduled_km:{required:"Please Enter Km",jquerynumber:"Please Enter Positive Numbers"},
			maximum_ideling_minutes:{
				required:"Please Enter Maximum Ideling Minutes",
				jquerynumber:"Please Enter Positive Numbers",
			},
			's_time[0]':{required:"Please Enter Sheduled Timing",},
			'trip_hr':{required:"Please Enter Trip Hours",jquerynumber:"Please Enter Positive Numbers"},
			'trip_min':{required:"Please Enter Trip Minutes",jquerynumber:"Please Enter Positive Numbers"},
			status: {required:"Please Select Status",},
		},
		errorPlacement: function(error, element){
			if(element.is('select')) {
				error.insertAfter(element.next());
			} else {
				error.insertAfter(element);
			}
		},
	});

    jQuery.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[0-9]+(\.[0-9][0-9]?)+$/i.test(value);
    });

    jQuery.validator.addMethod("jquerynumber", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
	});

	$("body").on("click","#form_btn",function(e){
        e.preventDefault();
		DuplicateCheck();
		requiredCheck();
        if ($("#frm").valid()) {
			var duplicateStatus = DuplicateCheck();
			var reqStatus = requiredCheck();

            if (serverTimeStatus == 0 && serverNumberStatus == 0 && reqStatus == 0 && duplicateStatus == 0) {
				$(':input[type="submit"]').prop('disabled', true);
                $("#frm").submit();
            } else {
                return false;
            }
        } else {
            return false;
		}
	});
});
</script>
@endsection