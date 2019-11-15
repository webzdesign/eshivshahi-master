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
                    @if($userTypeId != '1')
                      @if($permission[0]->create == '1')
                        <a href="{{ url("/$route".'/create') }}" style="float:right;" class="btn btn-primary btn-sm">New</a>
                      @endif
                    @else

                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Vendor</th>
                            <th>Date</th>
                            <th>Division</th>
                            <th>Depot</th>
                            <th>Billing  Period</th>
                            <th>Action</th>
                        </tr>
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

					$('#datatable').DataTable({
						processing: true,
						serverSide: true,
						ajax:{
              "url": "{{ url($dataTableUrl) }}",
              "dataType": "json",
              "type": "get",
            },
						columns: [
              {data: 'DT_Row_Index'},
              {data: 'vendor_name'},
              {data: 'date'},
              {data: 'division'},
              {data: 'depot_name'},
              {data: 'billing_period'},
              {data: 'actions'},
            ],
            "columnDefs": [{
              "targets": [0,4],
              "orderable": false
            }],
						"order": [[ 0, "desc" ]]
          });

          $(document).on("click", ".bill-confirm-delete", function (e) {
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
                            $('#datatable').DataTable().ajax.reload();
                            swal("Success", "Record Deleted Successfully!", "success");
                          }
                          else{
                            swal("Error", res , "error");
                          }
                         }


                    });
                  }
                });
              });

            $(document).on('click', '#query', function(e) {
              e.preventDefault();
              var linkURL = $(this).attr("href");
              swal({
              title: "Are you sure to Query Resolved?",
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