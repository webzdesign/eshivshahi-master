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
                    @if(Auth::user()->usertype_id=='3')
                    <a href="{{ url("/$route".'/create') }}" style="float:right;" class="btn btn-primary btn-sm">New</a>
                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap datatables" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>Vendor Name</th>
                          <th>Invoice No</th>
                          <th>Route (Number - Scheduled Time)</th>
                          <th>Invoice Date</th>
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
						ajax: '{{url('/getvendorinvoicedata')}}',
						columns: [
							{data: 'DT_Row_Index'},
              {data: 'vendor_name'},
              {data: 'invoice_no'},
              {data: 'route'},
              {data: 'date'},
              {data: 'grand_amount'},
              {data: 'billing_period'},
							{data: 'action'},
            ],

            'rowCallback': function(row, data, index){
              if(data['grand_amount'] < 0){
                $(row).find('td:eq(5)').css('color', 'red');
              }
            },

						 "columnDefs": [ {

							"targets": [0,5],

							"orderable": false

							} ],
							"order": [[ 0, "desc" ]]


          });


          $(document).on("click", ".vendor-confirm-delete", function (e) {
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
                            $('.datatables').DataTable().ajax.reload();
                            swal("Success", "Record Deleted Successfully!", "success");
                          }
                          else{

                              swal("Error", "Some Problem Occured...Please Try Again", "error");
                            }
                         }


                    });
                  }
                });
              });


				});



</script>
@endsection