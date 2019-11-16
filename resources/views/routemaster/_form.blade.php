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
								<table class="table" id="scheduled_time">
									<tbody>
										<tr>
										    <td>
											    <input type="text" class="form-control numberonly s_time" name="s_time" id="s_time" value="{{date('H:i',strtotime($routemaster->scheduled_time)) }}" placeholder="Timing" />
										    </td>
									    </tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="form-group">
							<label class=" col-md-3 col-sm-3 col-xs-12" >Status<span class="error">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="radio">
									<label style="margin-right:20px;">
										<input type="radio" name="status" id="status" value="1" checked {{($result->status == 1) ? 'checked' : '' }}> Active
									</label>
									<label>
										<input type="radio" name="status" id="status" value="0" {{($result->status == 0) ? 'checked' : '' }}> Deactive
									</label>
									<div id="errorClass">
									</div>
								</div>
							</div>
						</div>

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

    $('.s_time').datetimepicker({
      format: 'HH:mm',
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


    $(document).on('click','.add-row' ,function(event){

    	var num = $('.scheduled_time').length;
      	var t=$(this).closest('.scheduled_time');
		t.find('.s_time').datetimepicker('destroy');

      	var clone=$(t).clone(true,true);

		clone.find('input').val('');
		$("#scheduled_time tbody").children().last().after(clone);
		clone.find(".s_time").attr('id', 's_time['+num+']').attr('name', 's_time['+num+']');
		clone.find(".s_time").datetimepicker({ format: 'HH:mm'});

		clone.find('td').each(function() {
			var el = $(this).find(':first-child');
			var elthis = "#"+el.attr("id");
			var id = el.attr('id') || null;

			if (id) {
				var i = id.substr(elthis.indexOf("[")-1);
				var j= i.replace(/[\[\]]+/g,'');
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
		t.find(".s_time").datetimepicker({ format: 'HH:mm'});
		clone.find(".s_time").rules('add', time_hr);
    });

    var time_hr =  {
        required: true,
        messages: {
      	required: "Please Enter Scheduled Time",
		}
	}

  	$(document).on('click','.delete-row' ,function(event){
      if($(".scheduled_time").length>1){
        $(this).closest(".scheduled_time").remove();
      }
    });

    var form=$("#frm");
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
			'scheduled_hr[0]':{required:true,},
			'scheduled_min[0]':{required:true,},
			's_time[0]':{required:true,},
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
		submitHandler: function(form) {
			$(':input[type="submit"]').prop('disabled', true);
			form.submit();
		}
	});

  	jQuery.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[0-9]+(\.[0-9][0-9]?)+$/i.test(value);
    });

    jQuery.validator.addMethod("jquerynumber", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    });
});

</script>
@endsection