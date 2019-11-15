<?php

  /*

    Hardik

    Date:24-8-18

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
                  @if(Auth::user()->usertype_id==1)
                    <a href="{{ url("/$route".'/create') }}" style="float:right;" class="btn btn-primary btn-sm">New</a>
                  @endif
                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                      <thead>

                        <tr>

                          <th>Sr no.</th>

                          <th>Vendor Name</th>

                          <th>Address</th>
						  <th>Status</th>
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

    ajax: '{{url('/getvendordata')}}',

    columns: [

      {data: 'DT_Row_Index'},
    @if(Auth::user()->usertype_id==1)

      {data: 'vendor_name'},

	  {data: 'address'},
	  {data: 'active_status'},

  @else
      {data: 'vendor.vendor_name'},

	  {data: 'vendor.address'},
	  {data: 'active_status'},
  @endif
      {data: 'action'},

    ],

    // 	columns: [
    // 	{data: 'DT_Row_Index'},
    // 	{data: 'vendor_name'},
    // 	{data: 'address'},
    // 	{data: 'action'},
    // ],


      "columnDefs": [ {
      "targets": [0,4],
      "orderable": false
      } ],
      "order": [[ 1, "desc" ]]
  });

     // Active and Deactive status message
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