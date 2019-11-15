<?php
  /*
   jinal Gajera
    Date:10-06-2019
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
                          <th>Query</th>
                          <th>Query Raised Date</th>
                          <th>UserName</th>
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
						ajax: "{{url('/getquerybillsummary')}}",
						columns: [
							{data: 'DT_Row_Index'},
              {data: 'query'},
              {data: 'date'},
              {data: 'username'},
							{data: 'action'},
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