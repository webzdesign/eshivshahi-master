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
						<form class="form-horizontal" id="frm" method="POST" action="{{route('routemaster.update', $routemaster->id)}}" autocomplete="off">
							@csrf
							@method('PUT')
						<input type="hidden" name="id" id="id" value="{{$routemaster->id}}"/>

						<div class="form-group">
							<label class=" col-md-3 col-sm-3 col-xs-12" >Division <span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select  id="division_id" name="division_id" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 division_id">
									<option value=""></option>
									@foreach($divisions as $division)
										<option value="{{ $division->id }}" {{($routemaster->division_id == $division->id)?'selected':''}}>{{ $division->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class=" col-md-3 col-sm-3 col-xs-12" >From Depot <span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select  id="from_depot" name="from_depot" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 from_depot">
									<option value=""></option>
									@foreach($fromDepots as $key => $val)
										<option value="{{$val->id}}" {{ ($val->id == $routemaster->from_depot) ? 'selected' : '' }}>{{$val->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class=" col-md-3 col-sm-3 col-xs-12" >To Division <span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select  id="to_division" name="to_division" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 to_division">
									<option value=""></option>
									@foreach($divisions as $division)
									<option value="{{ $division->id }}" {{($routemaster->to_division == $division->id)?'selected':''}}>{{ $division->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class=" col-md-3 col-sm-3 col-xs-12" >To Depot <span class="required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select  id="to_depot" name="to_depot" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 to_depot">
									<option value=""></option>
									@foreach($toDepots as $depot)
										<option value="{{ $depot->id }}" {{($depot->id== $routemaster->to_depot) ? 'selected' : ''}}>{{ $depot->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label  class=" col-md-3 col-sm-3 col-xs-12">Scheduled KM<span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control " name="scheduled_km" id="scheduled_km" value="{{$routemaster->scheduled_km}}" placeholder="Enter KM"/>
							</div>
						</div>

						<div class="form-group">
							<label  class=" col-md-3 col-sm-3 col-xs-12">Maximum Ideling Minutes<span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" class="form-control numberonly" name="maximum_ideling_minutes" id="maximum_ideling_minutes" value="{{$routemaster->maximum_ideling_minutes}}" placeholder="Enter Maximum Ideling Minutes" maxlength="3" />
							</div>
						</div>

						<div class="form-group">
							<label  class=" col-md-3 col-sm-3 col-xs-12">Trip Duration<span class=" required"> *</span></label>
							<div class="col-md-3 col-sm-3 col-xs-12">
							Hours
							<input type="text" class="form-control numberonly" name="trip_hr" id="trip_hr" value="{{isset($routemaster->trip_hrs)?$routemaster->trip_hrs:''}}" placeholder="Hours"/>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12">
							Minutes
							<input type="text" class="form-control numberonly" name="trip_min" id="trip_min" value="{{isset($routemaster->trip_min)?$routemaster->trip_min:''}}" placeholder="Minutes"/>
							</div>
						</div>

						<div class="form-group">
							<label  class=" col-md-3 col-sm-3 col-xs-12">Scheduled Timing<span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">

								<input type="text" class="form-control numberonly s_time" name="s_time" id="s_time" value="{{date('H:i',strtotime($routemaster->scheduled_time)) }}" placeholder="Timing" readonly/>

								<label id="s_time_server_error" class="server_time_label" name="server_s_time"></label>
							</div>
						</div>

						<div class="form-group">
							<label  class=" col-md-3 col-sm-3 col-xs-12">Scheduled Number<span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">

								<input type="text" class="form-control numberonly schedule_number" name="schedule_number" id="schedule_number" value="{{$routemaster->scheduled_number}}" placeholder="Schedule Number" />

								<label id="schedule_number_server_error" class="server_schNumber_label" name="server_schedule_number"></label>
							</div>
						</div>

						<div class="form-group">
							<label  class=" col-md-3 col-sm-3 col-xs-12">Bus Type<span class=" required"> *</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="bus_type" id="bus_type" class="form-control bus_type select2_single" style="width:100%;">
									<option value="">Select</option>
									<option {{ ($routemaster->bus_type == 'seater') ? 'selected' : '' }} value="seater">Seater</option>
									<option {{ ($routemaster->bus_type == 'sleeper') ? 'selected' : '' }} value="sleeper">Sleeper</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class=" col-md-3 col-sm-3 col-xs-12" >Status<span class="error">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="radio">
									<label style="margin-right:20px;">
										<input type="radio" name="status" id="status" value="1" {{($routemaster->status == 1) ? 'checked' : '' }}> Active
									</label>
									<label>
										<input type="radio" name="status" id="status" value="0" {{($routemaster->status == 0) ? 'checked' : '' }}> Deactive
									</label>
									<div id="errorClass">
									</div>
								</div>
							</div>
						</div>

						<div class="ln_solid"></div>

						<div class="form-group">
							<label  class="col-sm-3 control-label"></label>
							<div class="col-sm-9">
								<input type="submit" id="form_btn" value="Update" class="btn  btn-primary"/>
								<a href="{{url('routemaster')}}" class="btn btn-warning" >Cancel </a>
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
	var serverStatus = 0;
	var serverNumberStatus = 0;

    $('.s_time').datetimepicker({
	  format: 'HH:mm',
	  ignoreReadonly: true
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
	function checkvalidtime(){
		var id = $('#id').val();
		var division_id = $('#division_id').val();
		var from_depot = $('#from_depot').val();
		var to_division = $('#to_division').val();
		var to_depot = $('#to_depot').val();
		var s_time = $('.s_time').val();
		var schedule_number = $('.schedule_number').val();

		$.ajax({
			url: "{{url('/checkScheduledTiming')}}",
			type: "POST",
			dataType:'json',
			data: { id:id, division_id:division_id, from_depot:from_depot, to_division:to_division, to_depot:to_depot, s_time:s_time,schedule_number:schedule_number },
			success:function(data){
				if(data == false){
					serverStatus = 1;
					var str = 'This Schedule Time is already used this Route';
					var result = str.fontcolor("red");
					$('body').find('.server_time_label').html(result);
				} else {
					serverStatus = 0;
					$('body').find('.server_time_label').html('');
				}
			},
		});
	}

	$('.s_time').on('dp.change', function(e){
		checkvalidtime();
		checkvalidSchNumber();
	});
	/* check Schedule time server side End */


	/* check Schedule Number server side start */
	function checkvalidSchNumber(){
		var id = $('#id').val();
		var division_id = $('#division_id').val();
		var from_depot = $('#from_depot').val();
		var to_division = $('#to_division').val();
		var to_depot = $('#to_depot').val();
		var schedule_number = $('.schedule_number').val();
		var s_time = $('.s_time').val();
		

		$.ajax({
			url: "{{url('/checkScheduledNumber')}}",
			type: "POST",
			dataType:'json',
			data: { id:id, division_id:division_id, from_depot:from_depot, to_division:to_division, to_depot:to_depot, schedule_number:schedule_number,s_time:s_time },
			success:function(data){
				if(data == false){
					serverNumberStatus = 1;
					var str = 'This Schedule Number is already used this Route';
					var result = str.fontcolor("red");
					$('body').find('.server_schNumber_label').html(result);
				} else {
					serverNumberStatus = 0;
					$('body').find('.server_schNumber_label').html('');
				}
			},
		});
	}

	$("body").on('keyup','.schedule_number' ,function(e){
		checkvalidSchNumber();
		checkvalidtime();
	});

	$("body").on('change', '#division_id, #from_depot, #to_division, #to_depot', function(e){
		checkvalidSchNumber();
		checkvalidtime();
	});
	/* check Schedule Number server side end */


	$('#frm').validate({

		errorClass: 'errors',
		rules: {
			division_id:{required:true,},
			from_depot:{required:true,},
			to_depot:{required:true,},
			to_division:{required:true,},
			scheduled_km:{required:true,},
			maximum_ideling_minutes:{
				required:true,
				jquerynumber:true,
			},
			's_time[0]':{required:true,},
            schedule_number:{required:true,},
			bus_type:{required:true,},
			'trip_hr':{required:true,jquerynumber:true},
			'trip_min':{required:true,jquerynumber:true},
			status:{required:true,},
		},
		messages:
		{
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
			schedule_number:{required:"Please Enter Sheduled Number",},
			bus_type:{required:"Please Select Bus Type",},
			'trip_hr':{required:"Please Enter Trip Hours",jquerynumber:"Please Enter Positive Numbers"},
			'trip_min':{required:"Please Enter Trip Minutes",jquerynumber:"Please Enter Positive Numbers"},
			status:{required:"Please Enter Status"},
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

        if ($("#frm").valid()) {
            if (serverStatus == 0 && serverNumberStatus == 0) {
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