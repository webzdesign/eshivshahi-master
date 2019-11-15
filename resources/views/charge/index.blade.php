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
              @if (Session::has('msgName'))
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                  </button>
                      {!! session('msgName') !!}
              </div>
              @endif
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $modulename }}</h2>
                    {{-- <button href="{{route('charges.create')}}"><button class="btn btn-primary btn-sm" style="float:right;"> New</button></button> --}}
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>Diesel Rate</th>
                          {{-- <th>Vor Charges	</th>
                          <th>Washing Charges</th>
                          <th>Parking Charges</th> --}}
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
						ajax: "{{ url($dataurl) }}",
						columns: [
              { data: 'DT_Row_Index',orderable:false,searchable:false},
              { data: 'diesel_rate'},
             /* { data: 'vor_charges'},
              { data: 'washing_charges'},
              { data: 'parking_charges'},*/
              { data: 'action',orderable:false,searchable:false},
						 ],
						 "columnDefs": [ {

							"targets": [0,2],

							"orderable": false

							} ],
							"order": [[ 1, "desc" ]]


					});
				});



</script>
@endsection