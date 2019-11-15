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
				<a  style="float:right"class="btn btn-primary" data-backdrop="static" data-toggle='modal' data-id='insert' id='new' data-target='#AddEditModal' ><i class="fa fa-plus"></i> New</a>
				<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<div class="datatable-responsive">
					<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th>Id</th>
						<th>Sr no.</th>
						<th>Vendor</th>
						<th>Vehicle No.</th>
						<th>Bus Type</th>
						<th>Status</th>
						<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="AddEditModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
			{{ $title }}
			</h4>
			</div>
			<!-- Modal Body -->
			<div class="modal-body">
				<form class="form-horizontal" id="frm">
					@csrf
					<input type="hidden" name="id" id="id" />
					<input type="hidden" name="action" id="action" value="{{ $action }}"/>
					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >Vendor <span class=" required"> *</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select  id="vendor_id" name="vendor_id" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 vendor_id"  @if(Auth::user()->usertype_id != 1) disabled @endif>
							<option value=""></option>

							@foreach($vendors as $vendor)
								<option value="{{ $vendor->id }}" @if(Auth::user()->usertype_id != 1 ) {{ ($vendor->id == $vendorselected[0]->vendor_id) ? 'selected' : '' }} @endif >{{ $vendor->vendor_name }}</option>
							@endforeach
							<select>
							@if(Auth::user()->usertype_id !=1)
								<input type="hidden" name="vendor_id" value="{{$vendorselected[0]->vendor_id}}"  />
							@endif
						</div>
					</div>

					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >Bus Type<span class=" required"> *</span> </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select  id="bus_type" name="bus_type" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 bus_type">
							<option value=""></option>
							<option value="seater">Seater</option>
							<option value="sleeper">Sleeper</option>
							<select>
						</div>
					</div>
					<div class="form-group">
						<label  class=" col-md-3 col-sm-3 col-xs-12">Vehicle No.<span class=" required"> *</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="vehicle_no" id="vehicle_no" value="" placeholder="Enter Vehicle No."/>
						</div>
					</div>
					<div class="form-group">
						<label  class=" col-md-3 col-sm-3 col-xs-12">Status<span class=" required"> *</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label><input type="radio" class="status" name="status" id="active_status" value="1" checked />Active</label> &nbsp;
							<label> <input type="radio" class="status" name="status" id="inactive_status" value="0" />
						Inactive</label>
						</div>
					</div>
					<div class="form-group">
					<label  class="col-sm-3 control-label"></label>
						<div class="col-sm-9">
						<input type="submit" id="form_btn" value="" class="btn  btn-primary"/>
						<button type="button" name="btn_close" class="cancle btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
  jQuery(document).ready(function() {
    var form=$("#frm");
    docdatatable=$('#datatable-responsive').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
            "url": "{{ url($dataurl) }}",
            "dataType": "json",
            "type": "get",
            },
      columns: [
            { data: 'id',searchable: false,visible:false},
            { data: 'DT_Row_Index',searchable: false,orderable: false},
            { data: 'vendor.vendor_name',orderable: false },
            { data: 'vehicle_no' },
            { data: 'bus_type' },
            { data: 'status' },
            { data: 'action', orderable: false, searchable: false},
          ]
      });
      $("#new").click(function(){
        var user='{{Auth::user()->usertype_id}}';
        @if(isset($vendorselected[0]))
        var vendor='{{$vendorselected[0]->vendor_id}}';
        @else
          var vendor='';
        @endif
        if(user !='1')
        {
          $("select[name='vendor_id']").val(vendor).trigger('change');
        }
        else
        {
          $("select[name='vendor_id']").val('').trigger('change');
        }
      });
   	var form=$("#frm");
   	/*jquery validation*/
	$('#frm').validate({
		errorClass: 'errors',
		rules:
		{
		vendor_id:{
			required:true,
		},
		bus_type:{
			required:true,
		},
		vehicle_no:{
			required: true,
			maxlength:20,
		},
		status:{
			required: true,
		},
		},
		messages:
		{
		vendor_id:{
			required:"Please Select Vendor",
		},
		bus_type:{
			required:"Please Select Bus Type",
		},
		vehicle_no:{
			required: "Please Enter Vehicle No.",
		},
		status:{
			required: "Please Enter Status.",
		},
		},
		submitHandler: function(form) {
		$(':input[type="submit"]').prop('disabled', true);
		},
		errorPlacement: function(error, element){
		error.appendTo(element.parent("div"));
		},
	});

	/*on edit get data and fill in popup*/
	$(document).on("click", "#new", function (event) {
		$("#id").val('');
	$("#active_status").attr('checked', 'checked');
	});

	$(document).on("click", "#edit", function (event) {
	var id = $(this).data('id');
	var u= '/'+id+'/edit';
		$.ajax({
			type: 'GET',
			url: "{{ url($route) }}"+u,
			dataType:'json',
			success: function(res){


				$('input[name=id]').val(res.id);
				$('input[name=vehicle_no]').val(res.vehicle_no);

				if(res.status == 0){
				  $("#inactive_status").prop('checked', true);
				  $("#active_status").removeAttr("checked");
				}else{
				  $("#active_status").prop('checked', true);
				  $("#inactive_status").removeAttr("checked");
				}

				$('input[type=submit]').val(res.button);
				$("#action").val(res.action);
				$('select[name=vendor_id]').val(res.vendor_id).trigger('change');
				$('select[name=bus_type]').val(res.bus_type).trigger('change');
				$("#frm").append(" <input type='hidden' name='_method' value='PUT'>");
			  }
		});
	});

	/*Active and Deactive status message*/
	$(document).on('click', '#active', function(e) {
		e.preventDefault();
		var linkURL = $(this).attr("href");
		swal({
			title: "Are you sure want to Active?",
			text: "As that can be undone by doing reverse.",
			icon: "success",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = linkURL;
			}
		});
	});

	$(document).on('click', '#inactive', function(e) {
		e.preventDefault();
		var linkURL = $(this).attr("href");
		swal({
		title: "Are you sure want to Inactive?",
		text: "As that can be undone by doing reverse.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = linkURL;
			}
		});
	});
});
</script>
@endsection