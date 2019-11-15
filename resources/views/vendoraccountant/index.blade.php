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

                    <h2>{{$title}}</h2>

                    <a  style="float:right"class="btn btn-primary" href={{$route.'/create'}}><i class="fa fa-plus"></i> New</a>

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                    <div class="datatable-responsive">

                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                        <thead>

                          <tr>



                            <th>Sr no.</th>

                            <th>Vendor Name</th>

                            <th>Verdor Accountant Name</th>
                            <th>Mobile No</th>

                            <th>Email</th>

                            <th>Actions</th>

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

      columns: [



            { data: 'DT_Row_Index',searchable: false, orderable: false},

            { data: 'vendor.vendor_name',  orderable: false },



            { data: 'user_name', orderable: false },
            { data: 'user_mobile',  orderable: false },

            { data: 'user_email' ,orderable: false},

            { data: 'actions', orderable: false, searchable: false},

          ]

      });

  });

</script>

@endsection