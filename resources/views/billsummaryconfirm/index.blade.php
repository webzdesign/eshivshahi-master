<?php
 /*
    name:Pratik Donga
    on: 13-09-2018
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
                  <div>
                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" > Select Depot
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="depot_id" name="depot_id"  class="form-control select2_single col-md-7 col-xs-12 depot_id">
                                <option value=""></option>
                                @foreach($depo as $key=>$val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="x_content" id="confirmData">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>Vendor</th>
                          <th>Depot</th>
                          <th>Division</th>
                          <th>Route</th>
                          <th>Voucher No</th>
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
<script>
  jQuery(document).ready(function() {


    $('body').on('change','#depot_id',function(e){
      var depot_id = $(this).val();
      $.ajax({
					type:'POST',
					url:'{{url('/getconfirmdatasummary')}}',
					data:{
            depot_id:depot_id
					},
					success:function(result){
							$("#confirmData").empty().html(result);
					}
			});
    });

var form=$("#frm");

docdatatable=$('#datatable-responsive').DataTable({
  dom: 'Bfrtip',
  buttons: [{ extend: 'csv', text: 'Export To CSV' }],
  processing: true,
  serverSide: true,
  ajax:{
        "url": "{{ url($dataurl) }}",
        "dataType": "json",
        "type": "get",
        },
        "columnDefs": [ {
           "targets": [0,4],
           "orderable": false
        }],
    columns:[
        { data: 'DT_Row_Index'},
        { data: 'vendor_name' },
        { data: 'depo' },
        { data: 'division' },
        { data: 'route_id' },
        { data: 'voucher_no'},
        { data: 'billing_period'},
        { data: 'actions' },
      ],
      "order": [[ 1, "desc" ]]
  });
});
</script>
@endsection