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
            <a  style="float:right"class="btn btn-primary" data-backdrop="static" data-toggle='modal' data-id='insert' id='new' data-target='#AddEditModal' ><i class="fa fa-plus"></i> New</a>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <div class="datatable-responsive">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr no.</th>
                        <th>Bus Type</th>
                        <th>From Km</th>
                        <th>To Km</th>
                        <th>Rate</th>
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
    <div class="modal fade" id="AddEditModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
        <form class="form-horizontal" id="frm"  autocomplete="off">
        @csrf
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="action" id="action" value="{{ $action }}"/>
            <div class="form-group">
                <label class=" col-md-3 col-sm-3 col-xs-12" >Bus Type <span class=" required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select  id="bus_type" name="bus_type" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 bus_type">
                        <option value=""></option>
                        <option value="seater">Seater</option>
                        <option value="sleeper">Sleeper</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label  class=" col-md-3 col-sm-3 col-xs-12">From Km<span class=" required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control numberonly" name="from_km" id="from_km" value="" placeholder="Enter From KM"/>
                </div>
            </div>

            <div class="form-group">
                <label  class=" col-md-3 col-sm-3 col-xs-12">To Km<span class=" required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control numberonly" name="to_km" id="to_km" value="" placeholder="Enter To KM"/>
                </div>
            </div>

            <div class="form-group">
                <label  class=" col-md-3 col-sm-3 col-xs-12">Rate<span class=" required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control amountonly" name="rate" id="rate" value="" placeholder="Enter Rate"/>
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
            { data: 'id',searchable: false,visible:false},
            { data: 'DT_Row_Index',searchable: false,orderable: false},
            { data: 'bus_type'},
            { data: 'from_km'},
            { data: 'to_km'},
            { data: 'rate'},
            { data: 'action', orderable: false, searchable: false},
          ]
      });
      $("#new").click(function(){
        var user='{{Auth::user()->usertype_id}}';
        @if(isset($vendorselected[0]))
        var vendor='{{$vendorselected[0]->vendor_id}}';
        @else
          var vendor='';
        @endif
        if(user !='1')
        {
          $("select[name='vendor_id']").val(vendor).trigger('change');
        }
        else
        {
          $("select[name='vendor_id']").val('').trigger('change');
        }
      });
   var form=$("#frm");

  $('#frm').validate({
    errorClass: 'errors',
    rules:
    {
      bus_type:{required:true,},
      from_km:{required:true,alphanumspace:true,},
      to_km:{required:true,
      alphanumspace:true,tokm:true,},
      rate:{required:true,},
    },
    messages:
    {
      bus_type:{required:"Please Select bus Type",},
      from_km:{required:"Please Enter Km",
      alphanumspace:"Please Enter Positive Number",},
      to_km:{required:"Please Enter Km",
      alphanumspace:"Please Enter Positive Number",tokm:"To Km Should Be Greater Then From Km "},
      rate:{required:"Please Enter Rate",},

    },
    errorPlacement: function(error, element){
      error.appendTo(element.parent("div"));
    },
    submitHandler: function(form) {
      $(':input[type="submit"]').prop('disabled', true);
    }
  });
  jQuery.validator.addMethod("alphanumspace", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    });
    $.validator.addMethod("tokm", function(value, element) {
      console.log(value);
      var fromkm = parseInt($("input[name='from_km']").val());
      console.log(fromkm);
      if(parseInt(value)>fromkm)
      {
        return true;
      }
      else
      {
        return false;
      }
    });
  /* Hardik For Get Depot */
  $("body").on("change","#division_id",function(){
        var division_id = $("#division_id").val();
        var action = $("#action").val();
        var hidden_depot_id = $("#hidden_depot_id").val();
            $.ajax({
                url:'{{ url("/getvehicledepotdata")}}',
                type: "post",
                data:
                {
                    division_id:division_id
                },
                success:function(result){

                    if(action=='insert'){
                        $("#depot_id").empty().html(result);
                    }else{
                        $("#depot_id").empty().html(result);

                        $("#depot_id").val(hidden_depot_id).trigger('change');
                    }

                }
            });

});
  //on edit get data and fill in popup
  $(document).on("click", "#new", function (event) {
	  $("#id").val('');
	  $("#hidden_depot_id").val('');
  });
  $(document).on("click", "#edit", function (event) {
    var id = $(this).data('id');
    var u= '/'+id+'/edit';
    $.ajax({
        type: 'GET',
        url: "{{ url($route) }}"+u,
        dataType:'json',
        success: function(res){
          $('#hidden_depot_id').val(res.depot_id);
          $('input[name=id]').val(res.id);
          $('input[name=from_km]').val(res.from_km);
          $('input[name=to_km]').val(res.to_km);
          $('input[name=rate]').val(res.rate);
          $('input[type=submit]').val(res.button);
          $("#action").val(res.action);
          $('select[name=bus_type]').val(res.bus_type).trigger('change');
          $("#frm").append(" <input type='hidden' name='_method' value='PUT'>");
        }
    });
  });


});
</script>
@endsection