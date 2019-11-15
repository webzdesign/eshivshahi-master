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
                    <!--<a  style="float:right"class="btn btn-primary" data-backdrop="static" data-toggle='modal' data-id='insert' id='new' data-target='#AddEditModal' ><i class="fa fa-plus"></i> New</a>
                    -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>User Type</th>
                          <th>Access Type</th>
                          <th>No Of User</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($allowuser as $key=> $allowuser)
					          	@if($allowuser->unm!='Super Admin')
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$allowuser->unm}}</td>
                          <td>{{$allowuser->name}}</td>
                          <td>{{$allowuser->no_of_users}}</td>
                          <td><a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='{{$allowuser->id}}' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>
                        </tr>
					          	@endif
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          <div class="modal fade" id="AddEditModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <div class="form-group">
                  <label  class="col-sm-3 control-label">User Type<span class="required"> *</span></label>
                  <div class="col-sm-9">
                    <select  class="textonly form-control select2_single usertype_id" disabled  style="width:100%;" name="usertype_id" id="usertype_id">
                      <option value=""></option>
                      @foreach($usertype as $userVal)
                          <option value="{{ $userVal->id }}">{{ $userVal->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Access Type<span class="required"> *</span></label>
                  <div class="col-sm-9">
                  <select  class="textonly form-control select2_single" disabled  style="width:100%;" name="accesstype_id" id="accesstype_id">
                      <option value=""></option>
                      @foreach($accesstype as $accessVal)
                        <option value="{{$accessVal->id}}">{{$accessVal->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">No Of Users<span class="required"> *</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="numberonly form-control" name="no_of_users" id="no_of_users" value="" placeholder="Enter No Of User"/>
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
		{ targets:[0,4], "orderable": false},
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
      usertype_id:{ required: true},
      accesstype_id:{ required: true},
      no_of_users:{ required: true}

    },
    messages:
    {
      usertype_id:{ required: "Please Select User Type"},
      accesstype_id:{ required: "Please Select Access Type"},
      no_of_users:{ required: "Please Enter No Of User"},
    },
    submitHandler: function(form) {
      $(this).find(':input[type=submit]').prop('disabled', true);

    },
    errorPlacement: function(error, element){
      error.appendTo(element.parent("div"));
    },
  });
  //on edit get data and fill in popup
  $(document).on("click", "#edit", function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var u= '/'+id+'/edit';
    $.ajax({
        type: 'GET',
        url: "{{ url($route) }}"+u,
        dataType:'json',
        success: function(res){
          $('input[name=id]').val(res.id);
          $('input[name=no_of_users]').val(res.no_of_users);
          $("#usertype_id").val(res.usertype_id).trigger('change');
          $("#accesstype_id").val(res.accesstype_id).trigger('change');
         // $("#accesstype_id").attr('disabled','disabled');
          $('input[type=submit]').val(res.button);
          $("#modal h4").text(res.popuptitle);
          $("#action").val(res.action);
          $("#frm").append(" <input type='hidden' name='_method' value='PUT'>");
        }
    });
  });

  $(document).on("click", "#new", function (event) {
		event.preventDefault();
    $("#accesstype_id").removeAttr('disabled','disabled');
		$("#id").val('');
		$(".select2_single").select2({
          placeholder: "Select",
          allowClear: true
        });
  });

  $(document).on("change", "#no_of_users", function (e) {
		e.preventDefault();
		if($(this).val()=='0')
		{
			alert('No Of User Can Not Be 0');
			$(this).val('');
		}

  });

  $(document).on("change", "#usertype_id,#accesstype_id", function (event) {
      event.preventDefault();
      var usertype_id = $("#usertype_id").val();
			var accesstype_id = $("#accesstype_id").val();
			var id = $("#id").val();

          $.ajax({
          type: 'POST',
          url: "{{ url($checkDuplicateURL) }}",
          data:{
            usertype_id:usertype_id,
            accesstype_id:accesstype_id,
            id:id
          },
          success: function(res){
            if(res=='false'){
               $("#usertype_id").val('').trigger('change');
               $("#accesstype_id").val('').trigger('change');
               alert('Already Entry Exist !!');
            }
          }
        });
  });


});

</script>
@endsection