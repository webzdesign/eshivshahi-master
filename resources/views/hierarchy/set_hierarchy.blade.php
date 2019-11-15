@extends('layouts.master')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">

    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{$msgName}}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ url($route.'/update_hierarchy') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="frm">
              @csrf
              <input type="hidden" name="module" value="{{$module}}">
              <table width="100%"  class="table table-bordered table-striped table-condensed" >
                <thead>
                  <tr>
                    <td width="10%">Sr. No.</td>
                    <td width="35%">User Type</td>
                    <td width="35%">Hierarchy Sequence</td>
                    <td width="20%">Action</td>
                  </tr>
                </thead>
                <tbody  id="addrow">
                  @if(count($heirarchy_data) == 0)
                    <tr class="clone_tr">
                      <td align="center" >
                        <label class="sr_no">1</label>
                      </td>
                      <td>
                        <select name="usertype[1]"    class="form-control usertype select2_single">
                          <option value="">Select</option>
                          @foreach($usertype as $k=>$v)
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                          @endforeach
                        </select>
                        <label class="label_lbl"></label>
                      </td>
                      <td> <input type="text" readonly name="sequence[1]" value="{{1}}" class="sequence form-control"></td>
                      <td>
                          <button  tabindex="1" type="button" class="btn btn-success add_row" >+</button>
                          <button tabindex="1" type="button" class="btn btn-danger remove_row" >-</button>
                      </td>
                    </tr>
                  @else
                    @foreach($heirarchy_data as $hk=>$hv)
                    <tr class="clone_tr">
                        <td align="center" >
                          <label class="sr_no">{{$hk + 1}}</label>
                        </td>
                        <td>
                          <select name="usertype[{{$hk + 1}}]"    class="form-control usertype select2_single">
                            <option value="">Select</option>
                            @foreach($usertype as $k=>$v)
                              <option value="{{ $v->id }}" @if($hv->usertype_id == $v->id) selected @endif>{{ $v->name }}</option>
                            @endforeach
                          </select>
                          <label class="label_lbl"></label>
                        </td>
                        <td> <input type="text" readonly name="sequence[{{$hk + 1}}]" value="{{$hk + 1}}" class="sequence form-control"></td>
                        <td>
                            <button  tabindex="1" type="button" class="btn btn-success add_row" >+</button>
                            <button tabindex="1" type="button" class="btn btn-danger remove_row" >-</button>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>

              <button class="btn btn-primary col-md-offset-5">Submit </button>

              <a href={{ url($route) }} id="reset_btn"  class="btn btn-danger" >Cancel </a>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
  /* Add Row  */
  _.templateSettings.variable = "element";
  var tpl = _.template($("#form_tpl").html());
  var counter = 1;
  $("body").on("click",".add_row", function (e) {
     e.preventDefault();
    var tplData = {
      i: counter
    };
    $(this).closest("tr").after(tpl(tplData));
     counter += 1;
     $(".select2_single").select2({
        placeholder: "Select",
        allowClear: true
      });

     var row_index = $(this).closest("tr").index() + 1;
     sr_change();
  });


  /* Remove Row For Custom Fields */
  $("body").on("click",".remove_row", function (e) {
    var count= $('.clone_tr').length;
    var value=count-1;
    if(value>=1){
      $(this).closest('.clone_tr').fadeOut('fast', function(){$(this).closest('.clone_tr').remove();
        sr_change();
      });
    }
  });

  /* To Display Sr. No  On + and - */
  function sr_change()
  {
     var count= $('.clone_tr').length;
      for(var i=0; i< count; i++){
        var cnt = i+1;

        $(".sequence").eq(i).attr('name', 'sequence['+cnt+']');
        $(".usertype").eq(i).attr('name', 'usertype['+cnt+']');
        $(".sequence").eq(i).val(cnt);
        $("label.sr_no").eq(i).text(cnt);

      }
    }

    /* For submit */
    $('#frm').on('submit', function(e){
      e.preventDefault();
      var form = this;
      var labelVals = [];
      var u_a = [];

      $('.usertype').each(function (){

        if($(this).val() ==''){
          var str = 'Select User Type';
          var result = str.fontcolor("red");
          $(this).closest('tr').find('.label_lbl').html(result);
          u_a.push(0);
        }else{
          var val = $(this).val();
          var val = val.trim();
          if(jQuery.inArray( val,labelVals ) !== -1){
            var str = 'User Type Already Selected';
            var result = str.fontcolor("red");
            $(this).closest('tr').find('.label_lbl').html(result);
            u_a.push(0);
          } else{
            u_a.push(1);
            $(this).closest('tr').find('.label_lbl').html('');
            labelVals.push(val);
          }
        }
      });

      var u = u_a.indexOf(0);
      if(u!= '-1'){
        return false;
      }else{
        $('.label_lbl').html('');
        form.submit();
      }
    });
});
</script>

/* Script to add row */
<script  type="text/html" id="form_tpl">
  <tr class="clone_tr">
      <td align="center" >
        <label class="sr_no"></label>
      </td>
      <td>
        <select name="usertype[]" class="form-control usertype select2_single ">
          <option value="">Select</option>
          @foreach($usertype as $k=>$v)
            <option value="{{ $v->id }}">{{ $v->name }}</option>
          @endforeach
        </select>
        <label class="label_lbl"></label>
      </td>
      <td> <input type="text" readonly name="sequence[]" value="" class="sequence form-control"></td>
      <td>
          <button  tabindex="1" type="button" class="btn btn-success add_row" >+</button>
          <button tabindex="1" type="button" class="btn btn-danger remove_row" >-</button>
      </td>
    </tr>
</script>
@endsection