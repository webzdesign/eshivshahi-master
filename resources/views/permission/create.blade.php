@extends('layouts.master')
@section('content')
<?php /*
    name:-Pratik
    on :- 12-09-18
*/
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"></div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
    @if(session()->has('msg'))
    <div class="alert alert-success">
      {{ session()->get('msg') }}
    </div>
    @endif
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{$modulename}}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form id="form" method="post"  action ="{{route('permission.store')}}" class="form-horizontal form-label-left" >
            @csrf
              <div class="form-group">
                <label class=" col-md-3 col-sm-3 col-xs-12" >Select User Type<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="select2_single usertype_id form-control" tabindex="-1" aria-hidden="true" name="usertype_id" id="usertype_id" style="width:100%">
                  <option></option>
                  @foreach($usertypes as $usertype)
                      <option value="{{$usertype->id}}">{{$usertype->name}}</option>
                  @endforeach
                  </select>
                  @if ($errors->has('usertype_id'))
                  <span class="error">
                     <b> {{ $errors->first('usertype_id') }}</b>
                  </span>
                @endif
                </div>

              </div>

              <div id="permissionData">

              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                  <input id="btn_item" type="submit" value="Set Permission" class="btn btn-primary">
                </div>
              </div>
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
    $(document).ready(function(){
      $('body').on('change','#usertype_id',function(e){
        var usertype_id = $('#usertype_id').val();
        var user_id = $('#user_id').val();

        if(usertype_id != ''){
            $.ajax({
              type: "POST",
              url: '{{url("getPermission")}}',
              dataType:'html',
              data: {usertype_id:usertype_id,user_id:user_id},
              success: function(res){
                $("#permissionData").empty().html(res);
              }
            });
        }else{
          $("#permissionData").empty().html('');
        }
      });
    });
  </script>

@endsection