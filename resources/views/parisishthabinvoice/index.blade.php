<?php
  /*
    Hardik
    Date:10-9-18
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
                          <th>Voucher No</th>
                          <th>Route(Schedule Time - Number)</th>
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

var form=$("#frm");

docdatatable=$('#datatable-responsive').DataTable({

  processing: true,

  serverSide: true,

  ajax:{

        "url": "{{ url($dataurl) }}",

        "dataType": "json",

        "type": "get",

        },
        "columnDefs": [ {
           "targets": [0,5],
           "orderable": false
        }],
    columns:[
        { data: 'DT_Row_Index'},
        { data: 'vendor_name' },
        { data: 'voucher_no'},
        { data: 'route_id'},
        { data: 'billing_period'},
        { data: 'actions' },
      ],
      "order": [[ 1, "desc" ]]
  });

});
</script>
@endsection