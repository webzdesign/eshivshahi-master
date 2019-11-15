@extends('layouts.master')
@section('content')
<?php
/*
  Hardik Ponkiya
  Date:24-8-18
*/
?>
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
                    <a  style="float:right"class="btn btn-primary" data-backdrop="static" data-toggle='modal' data-id='insert' id='new' data-target='#AddEditModal' ><i class="fa fa-plus"></i> New</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($usertypes as $key=> $usertypes)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$usertypes->name}}</td>
                          <td>
                          <!-- Condition given by sneha doshi on 12-9-18 -->
                          @if($usertypes->id > 3)
                            <a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='{{$usertypes->id}}' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                          @endif
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
                <form class="form-horizontal" id="frm" autocomplete="off">
                  @csrf
                  <input type="hidden" name="id" id="id" />
                  <input type="hidden" name="action" id="action" value="{{ $action }}"/>
                <div class="form-group accesstype_div">
                  <label  class="col-sm-3 control-label">Access Type<span class="required"> *</span></label>
                  <div class="col-sm-9">
                  <select  class="textonly form-control select2_single"  style="width:100%;" name="accesstype_id" id="accesstype_id">
                      <option value=""></option>
                      @foreach($accesstype as $accessVal)
                        <option value="{{$accessVal->id}}">{{$accessVal->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">User Type<span class="required"> *</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="textonly form-control" name="name" id="name" value="" placeholder="Enter User Type"/>
                  </div>
                </div>
                <div class="form-group">
                <label  class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <input type="submit" id="form_btn"   value="" class="btn  btn-primary"/>
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
$(document).ready(function(){
  datatabletable=$('#datatable-responsive').DataTable({
     columnDefs: [
		{ targets:[0,2], "orderable": false},
    ],

    "aaSorting": []
  });
   datatabletable.on( 'order.dt search.dt', function () {
    datatabletable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
   var form=$("#frm");
   //jquery validation
  $('#frm').validate({
    errorClass: 'errors',
    rules:
    {
      accesstype_id:{ required: true},
      name:{
        required: true,
        maxlength:30,
      },
    },
    messages:
    {
      accesstype_id:{ required: "Please Select Access Type"},
      name:{
        required: "Please Enter User Type",
        remote:"User Type Already Exists",
      },
    },
    submitHandler: function(form) {
      $(this).find(':input[type=submit]').prop('disabled', true);
    },
    errorPlacement: function(error, element){
      error.appendTo(element.parent("div"));
    },
  });
  /** on edit get data and fill in popup */
  $(document).on("click", "#edit", function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var u= '/'+id+'/edit';
    $.ajax({
        type: 'GET',
        url: "{{ url($route) }}"+u,
        dataType:'json',
        success: function(res){
          $('.accesstype_div').hide();
          $('input[name=name]').val(res.name);
          $('input[name=id]').val(res.id);
          $('input[type=submit]').val(res.button);
          $("#modal h4").text(res.popuptitle);
          $("#action").val(res.action);
          $("#frm").append(" <input type='hidden' name='_method' value='PUT'>");
        }
    });
  });

  $(document).on("click", "#new", function (event) {
    event.preventDefault();
    $("#id").val('');
  });

});

</script>
@endsection