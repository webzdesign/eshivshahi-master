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
                @if(session()->has('msgAlert'))
                <div class="alert alert-danger">
                  {{ session()->get('msgAlert') }}
                </div>
				      	@endif
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $modulename }}</h2>
                    @if($userTypeId != '2' && $userTypeId != '3')
                    <a href="{{ url("/$route".'/create') }}" style="float:right;" class="btn btn-primary btn-sm">New</a>
                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Mobile No</th>
                          <th>Depot</th>
                          <th>Division</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                    <hr>
                    <h2>User Histroy</h2>
                    <div class="clearfix"></div>

                    <table id="datatable-responsive_histroy" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Updated Date</th>
                          <th>Updated Time</th>
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

@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
        /*  Server Side Datatable */
    $('#datatable-responsive').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url('/getuserdata')}}',
      columns: [
        {data: 'DT_Row_Index'},
        {data: 'first_name'},
        {data: 'last_name'},
        {data: 'email'},
        {data: 'mobile'},
        {data: 'depot'},
        {data: 'division'},
        {data: 'role'},
        {data: 'active_status'},
        {data: 'action'},
        ],
        "columnDefs": [ {

        "targets": [0,9],

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

  $('#datatable-responsive_histroy').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{url('/getuserhistroy')}}',
    columns: [
      {data: 'DT_Row_Index',searchable: false,orderable: false},
      {data: 'user.first_name',},
      {data: 'user.last_name'},
      {data: 'updated_date', name:'updated_at'},
      {data: 'updated_time', name:'updated_at'},
      ],
      "columnDefs": [ {

      "targets": [0,4],

      "orderable": false

      } ],
      "order": [[ 1, "desc" ]]
  });


});



</script>
@endsection