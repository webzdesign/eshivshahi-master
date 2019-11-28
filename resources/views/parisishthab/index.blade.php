<?php
  /*
    Hardik
    Date:24-8-18
  */
  /*
    Modified
    name :Puja Ramvani
    Date:7-9-18
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
                    @if($userTypeId != '1')
                      @if($permission[0]->create != '0')
                      <a href="{{ url("/$route".'/create') }}" style="float:right;" class="btn btn-primary btn-sm">New</a>
                      @endif
                    @else

                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>Vendor</th>
                          <th>Invoice No</th>
                          <th>Route(Schedule Time - Number)</th>
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
<script>
  jQuery(document).ready(function() {

var form=$("#frm");

docdatatable=$('#datatable-responsive').DataTable({

  processing: true,
  serverSide: true,
  ajax: "{{url('getparisishthab') }}",

  columns: [
        { data: 'DT_Row_Index',searchable: false, orderable: false},
        { data: 'vendor_name',  orderable: false },
        { data: 'invoice_no',  orderable: false },
        { data: 'route', orderable: false },
        { data: 'voucher_no', orderable: false },
        { data: 'voucher_date', orderable: false },
        { data: 'amount', orderable: false },
        { data: 'billing_period', orderable: false },
        { data: 'actions', orderable: false },
      ],


    'rowCallback': function(row, data, index){
      if(data['amount'] < 0){
        $(row).find('td:eq(6)').css('color', 'red');
      }
    }
  });

  $(document).on("click", ".pb-confirm-delete", function (e) {
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

                    if('{{$route}}' == 'parisishthab')
                    {
                      swal("Warning", "ParisishthaB is Already Used in ParisishthaA so, Can Not be Deleted", "warning");
                    }
                    else{
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