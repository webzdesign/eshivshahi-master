<?php
  /*
    Pratik
    Date:10-09-18
  */
?>
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
			@if(session()->has('msg'))
				<div class="alert alert-success">
					{{ session()->get('msg') }}
				</div>
			@endif
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>{{ $modulename }}</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Sr no.</th>
									<th>Vendor</th>
									<th>Route (Schedule Time)</th>
									<th>Voucher No</th>
									<th>Voucher Date</th>
									<th>Amount</th>
									<th>Billing Period</th>
									<th>Action</th>
								</tr>
							</thead>
								<tbody>
								</tbody>
								<tfoot>
								</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {

    /*  Server Side Datatable */
	$('#datatable-responsive').DataTable({
		processing: true,
		serverSide: true,
		ajax:{
			"url": "{{ url($dataurl) }}",
			"dataType": "json",
			"type": "get",
		},
		columns: [
			{data: 'DT_Row_Index'},
			{data: 'vendor_name'},
			{data: 'route_id'},
			{data: 'voucher_no'},
			{data: 'voucher_date'},
			{data: 'amount_payable'},
			{data: 'billing_period', orderable: false },
			{data: 'actions'},
		],
		'rowCallback': function(row, data, index){
			if(data['amount_payable'] < 0){
				$(row).find('td:eq(5)').css('color', 'red');
			}
		},
		"columnDefs": [{
			"targets": [0,5],
			"orderable": false
		}],
		"order": [[ 0, "desc" ]]
	});

	$(document).on("click", ".pa-confirm-delete", function (e) {
		var id = $(this).data('id');
		@if(isset($route))
			var url = "{{url($route)}}"+'/'+id;
			@else
			var url = '';
		@endif
		e.preventDefault();
		swal({
			title: "Are you sure want to delete?",
			text: "Once delete, action can not be undone!!!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: 'DELETE',
					url:url,
					dataType:'json',
					data: {id:$(this).data('id')},
					success: function(res){
						if(res == true){
						$('#datatable-responsive').DataTable().ajax.reload();
						swal("Success", "Record Deleted Successfully!", "success");
						}
						else{
						if('{{$route}}' == 'parisishthaa'){
							swal("Warning", "ParisishthaA is Already Used in BillSummary so, Can Not be Deleted", "warning");
						} else {
						swal("Error", "Some Problem Occured...Please Try Again", "error");
						}

						}
					}
				});
			}
		});
	});
});
</script>
@endsection