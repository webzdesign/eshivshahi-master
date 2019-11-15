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
            <a href="{{ url("/$route".'/create') }}" style="float:right;" class="btn btn-primary btn-sm">New</a>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <div class="datatable-responsive">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr no.</th>
                        <th>From Division</th>
                        <th>From Depot</th>
                        <th>To Division</th>
                        <th>To Depot</th>
                        <th>Schedule Km</th>
                        <th>Trip Time</th>
                        <th>Scheduled Timings</th>
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
    <!-- <div class="modal fade" id="AddEditModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        Modal Header -->
        <!--<div class="modal-header">
        <button type="button" class="close"
            data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
        {{ $title }}
        </h4>
        </div>
        Modal Body
        <div class="modal-body">
        <form class="form-horizontal" id="frm"  autocomplete="off">
        @csrf
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="action" id="action" value="{{ $action }}"/>
            <div class="form-group">
                <label class=" col-md-3 col-sm-3 col-xs-12" >From Depot <span class=" required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select  id="from_depot" name="from_depot" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 from_depot">
                        <option value=""></option>
                        @foreach($depot as $depo)
                        <option value="{{ $depo->id }}">{{ $depo->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class=" col-md-3 col-sm-3 col-xs-12" >To Depot <span class="required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select  id="to_depot" name="to_depot" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 to_depot">
                        <option value=""></option>
                        @foreach($depot as $depo)
                        <option value="{{ $depo->id }}">{{ $depo->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="form-group">
                <label  class=" col-md-3 col-sm-3 col-xs-12">Scheduled KM<span class=" required"> *</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control numberonly" name="scheduled_km" id="scheduled_km" value="" placeholder="Enter KM"/>
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
</div> -->
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
            { data: 'name'},
            { data: 'from_depot'},
            { data: 'to_division'},
            { data: 'to_depot'},
            { data: 'scheduled_km'},
            { data: 'trip_time'},
            { data: 'scheduled_time'},
            { data: 'action',orderable: false, searchable: false},
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
      from_depot:{required:true,},
      to_depot:{required:true,},
      scheduled_km:{required:true,},
    },
    messages:
    {
      from_depot:{required:"Please Select From Depot",},
      to_depot:{required:"Please Select To Depot ",},
      scheduled_km:{required:"Please Enter Km",},
    },
    errorPlacement: function(error, element){
      error.appendTo(element.parent("div"));
    },
    submitHandler: function(form) {
      $(':input[type="submit"]').prop('disabled', true);
    }
  });

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
          $('input[name=id]').val(res.id);
          $('input[name=scheduled_km]').val(res.scheduled_km);
          $('input[type=submit]').val(res.button);
          $("#action").val(res.action);
          $('select[name=from_depot]').val(res.from_depot).trigger('change');
          $('select[name=to_depot]').val(res.to_depot).trigger('change');
          $("#frm").append(" <input type='hidden' name='_method' value='PUT'>");
        }
    });
  });


});
</script>
@endsection