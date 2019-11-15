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

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>{{$title}}</h2>

                   <!-- <a  style="float:right"class="btn btn-primary" data-backdrop="static" data-toggle='modal' data-id='insert' id='new' data-target='#AddEditModal' ><i class="fa fa-plus"></i> New</a>-->

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                      <thead>

                        <tr>

                          <th>Sr no.</th>

                          <th>Name</th>

                          <!--<th>Actions</th>-->

                        </tr>

                      </thead>

                      <tbody>

                      @foreach($accesstypes as $key=> $accesstype)

                        <tr>

                          <td>{{$key+1}}</td>

                          <td>{{$accesstype->name}}</td>

                            <!-- <td>
                        <a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='{{$accesstype->id}}' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>

                          <a data-id='{{$accesstype->id}}' class='btn btn-danger btn-xs confirm-delete' ><i class='fa fa-trash'></i> Delete</a></td> -->

                        </tr>

                      @endforeach

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

          <div class="modal fade" id="AddEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          <div class="modal-dialog">

            <div class="modal-content">

              <!-- Modal Header -->

              <div class="modal-header">

                <button type="button" class="close"

                  data-dismiss="modal">

                    <span aria-hidden="true">&times;</span>

                    <span class="sr-only">Close</span>

                </button>

                <h4 class="modal-title" id="myModalLabel">

                {{ $title }}

                </h4>

              </div>

              <!-- Modal Body -->

              <div class="modal-body">

                <form class="form-horizontal" id="frm">

                @csrf

                  <input type="hidden" name="id" id="id" />

                  <input type="hidden" name="action" id="action" value="{{ $action }}"/>

                <div class="form-group">

                  <label  class="col-sm-3 control-label">Access Type<span class="required"> *</span></label>

                  <div class="col-sm-9">

                    <input type="text" class="textonly form-control" name="name" id="name" value="" placeholder="Enter Access Type"/>

                  </div>

                </div>

                <div class="form-group">

                <label  class="col-sm-3 control-label"></label>

                  <div class="col-sm-9">

                    <input type="submit" id="form_btn" value="" class="btn  btn-primary"/>

                    <button type="button" name="btn_close" class="cancle btn btn-default" data-dismiss="modal">Cancel</button>

                  </div>

                </div>

                </form>

              </div>

            </div>

          </div>

      </div>

@endsection

@section('script')

<script>

var form_0=$("#frm");

$(document).ready(function(){

  datatabletable=$('#datatable-responsive').DataTable({

    columnDefs: [

    {  targets:[0,2], "orderable": false},

    ],

    "aaSorting": []

  });
  datatabletable.on( 'order.dt search.dt', function () {
    datatabletable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
   //jquery validation

   form_0.validate({

    keyup:false,

    errorClass: 'errors',

    rules:

    {

      name:{

        required: true,

        maxlength:30,

      },

    },

    messages:

    {

      name:{

        required: "Please Enter Access Type",

      },

    },

    submitHandler: function(form_0) {

      $(':input[type="submit"]').prop('disabled', true);

    },

    errorPlacement: function(error, element){

      error.appendTo(element.parent("div"));

    },

  });

  //on edit get data and fill in popup

  $(document).on("click", "#edit", function (event) {

    var id = $(this).data('id');

    var u= '/'+id+'/edit';

    $.ajax({

        type: 'GET',

        url: "{{ url($route) }}"+u,

        dataType:'json',

        success: function(res){

          $('input[name=name]').val(res.name);

          $('input[name=id]').val(res.id);

          $('input[type=submit]').val(res.button);

          $("#modal h4").text(res.popuptitle);

          $("#action").val(res.action);

          form_0.append(" <input type='hidden' name='_method' value='PUT'>");

        }

    });

  });

});

</script>

@endsection