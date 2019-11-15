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
                    <h2>Division Details</h2>
                    <a  style="float:right"class="btn btn-primary" data-backdrop="static" data-toggle='modal' data-id='insert' id='new' data-target='#AddEditModal' ><i class="fa fa-plus"></i> New</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr no.</th>
                          <th>Name</th>
                          <th>Action</th>
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
                  <label  class="col-sm-3 control-label">Division<span class="required"> *</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="textonly form-control" name="name" id="name" value="" placeholder="Name"/>
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
              /*  Server Side Datatable */
					$('#datatable-responsive').DataTable({
						processing: true,
						serverSide: true,
						ajax: '{{url("$dataurl")}}',
						columns: [
							{data: 'DT_Row_Index'},
							{data: 'name'},
							{data: 'actions'},
						 ],
						 "columnDefs": [ {
							"targets": [0,2],
							"orderable": false
							} ],
					});
  var form=$("#frm");
   //jquery validation
  $('#frm').validate({
    errorClass: 'errors',
    rules:
    {
      name:{
        required: true,
        maxlength:50,
      },
    },
    messages:
    {
      name:{
        required: "Please Enter Division",
      },
    },
    submitHandler: function(form) {
      $(this).find(':input[type=submit]').prop('disabled', true);
    },
    errorPlacement: function(error, element){
      error.appendTo(element.parent("div"));
    },
  });
  $(document).on("click", "#edit", function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var u= '/'+id+'/edit';
    $.ajax({
        type: 'GET',
        url: "{{ url($route) }}"+u,
        dataType:'json',
        success: function(res){
          console.log(res);
          $('input[name=name]').val(res.name);
          $('input[name=id]').val(res.id);
          $('input[type=submit]').val(res.button);
          $("#modal h4").text(res.popuptitle);
          $("#action").val(res.action);
          $("#frm").append(" <input type='hidden' name='_method' value='PUT'>");
        }
    });
  });
  $(document).on("click", ".confirm-delete-division", function (e) {

var d=$(this).data('id');

url="{{url($route)}}"+'/'+d;

e.preventDefault();

swal({

  title: "Are you sure?",

  text: "Once You Delete This Division All Depot Related To This Will Be Deleted",

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

        data: {id:d},

        success: function(res){

            if(res==true) {

                swal('Success!','Deleted Successful','success');

                //controller variable condition for datatable

                if('{{$tabletype}}'=='serverside')

                {

                  $('#datatable-responsive').DataTable().ajax.reload(null,false);

                }

                else

                {

                   var datatabletable=$('#datatable-responsive').DataTable({

                            ajax:{

                                "url": "{{ url($dataurl) }}",

                            },

                            columnDefs: [

                                { orderable: false, targets: [0,2] }

                            ],

                            aaSorting:[],

                            });
                            datatabletable.on( 'order.dt search.dt', function () {
                            datatabletable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                            cell.innerHTML = i+1;
                            } );
                            } ).draw();

                }

            }

            else {

                swal('Warning!','Used in Other Module So Can Not Delete It','warning');

            }

        }

});

  }

});

});
});

</script>
@endsection