<?php
  /*
    Hardik Ponkiya
    Date:09-07-18
  */

?>

@extends('layouts.master')
@section('content')

    @if($action=='insert')
         @php
            $btn = 'Submit';
            $formUrl = route('vendormanager.store');
        @endphp
    @elseif($action=='update')
         @php
            $btn = 'Update';
            $formUrl = route('vendormanager.update',$result[0]->id);
         @endphp
    @endif

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $modulename }}</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <form id="frm" method="post"  action ="{{$formUrl}}"   class="form-horizontal form-label-left" autocomplete="off">
                  @if($action=='update')
                     @method('PUT')
                         <input type="hidden" name="id" id="id" value="{{$result[0]->id}}">
                         <input type="hidden" name="user_id" value="{{$result[0]->user_id}}">
                  @endif
                            @csrf
							 <input type="hidden" name="accesstype_id" value="{{$accesstypes[0]->id}}">
                            <input type="hidden" value="{{$usertypes[0]->id}}" name="usertype_id">

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Select Vendor<span class="required"> *</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="vendor_id" name="vendor_id"  class="form-control select2_single col-md-7 col-xs-12 vendor_id">
                                        <option value=""></option>
                                        @foreach($vendors as $vendorVal)
                                            <option value="{{$vendorVal->id}}" @if($action=='update') {{$result[0]->vendor_id==$vendorVal->id?'selected':''}} @else {{old('vendor_id')==$vendorVal->id?'selected':''}} @endif>{{$vendorVal->vendor_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vendor_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('vendor_id') }}</b>
                                    </span>
                                     @endif
                                 </div>
                            </div>

							 <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >First Name <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="first_name" placeholder="Enter First Name" name="first_name"  class="form-control col-md-7 col-xs-12 first_name" value="{{ $action=='update'?$result[0]->first_name:old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                    <span class="error">
                                     <b> {{ $errors->first('first_name') }}</b>
                                    </span>
                                     @endif
                                </div>

								</div>
						   <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Last Name <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="last_name" placeholder="Enter Last Name" name="last_name"  class="form-control col-md-7 col-xs-12 last_name" value="{{ $action=='update'?$result[0]->last_name:old('last_name') }}">
                                    @if ($errors->has('last_name'))
                                    <span class="error">
                                     <b> {{ $errors->first('last_name') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="email" name="email" placeholder="Enter Email Id" class="form-control col-md-7 col-xs-12 email" value="@if($action=='update'){{$result[0]->email}}@else{{old('email')}}@endif">
                                    @if ($errors->has('email'))
                                    <span class="error">
                                     <b> {{ $errors->first('email') }}</b>
                                    </span>
                                     @endif
                                 </div>
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Mobile<span class="required"> *</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="mobile" name="mobile" maxlength="10" placeholder="Enter Mobile" class="form-control col-md-7 col-xs-12 mobile numberonly" value="@if($action=='update'){{$result[0]->mobile}}@else{{old('mobile')}}@endif">
                                    @if ($errors->has('mobile'))
                                    <span class="error">
                                     <b> {{ $errors->first('mobile') }}</b>
                                    </span>
                                     @endif
                                 </div>
                            </div>

                            @if($action=='insert')
                            <?php /*<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Password<span class="required"> *</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="password" id="password" name="password" placeholder="Enter Password" class="form-control col-md-7 col-xs-12	password" value="">
                                    @if ($errors->has('password'))
                                    <span class="error">
                                     <b> {{ $errors->first('password') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Confirm Password<span class="required"> *</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="password" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" class="form-control col-md-7 col-xs-12 confirm_password" value="">
                                    @if ($errors->has('confirm_password'))
                                    <span class="error">
                                     <b> {{ $errors->first('confirm_password') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div> */ ?>
                            @endif

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Access Type
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="accesstype_id" name="accesstype_id" disabled class="form-control select2_single col-md-7 col-xs-12 accesstype_id">
                                        <option value=""></option>
                                        @foreach($accesstypes as $accesstype)
                                         <option value="{{ $accesstype->id }}" selected  @if($action=='update' ) {{ $result[0]->accesstype_id==$accesstype->id?'selected':''  }} @endif>{{ $accesstype->name }}</option>
                                        @endforeach
                                    <select>

                                    @if ($errors->has('accesstype_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('accesstype_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >User Type
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="usertype_id" name="usertype_id" disabled class="form-control select2_single col-md-7 col-xs-12 usertype_id">
                                        <option value=""></option>
                                        @foreach($usertypes as $usertype)
                                        <option value="{{ $usertype->id }}"   selected>{{ $usertype->name }}</option>
                                        @endforeach
                                    <select>
                                    @if ($errors->has('usertype_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('usertype_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>

                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">{{ $btn }}</button>
                            <a href="{{url($route)}}"  class="btn btn-danger">Cancel</a>
                           </div>
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
jQuery(document).ready(function($){
    $("body").on("change","#vendor_id",function(e){

        e.preventDefault();
        var vendor_id = $(this).val();
        var accesstype_id = $("#accesstype_id").val();
        var usertype_id = $("#usertype_id").val();
        var id = $("#id").val();
        $(".blockUI").show();
        $.ajax({
            type:'POST',
            url:'{{url('/checkVendorManagerAllowUser')}}',
            dataType:'JSON',
            data:{
                vendor_id:vendor_id,
                accesstype_id:accesstype_id,
                usertype_id:usertype_id,
                id:id
            },
            success:function(result){
                if(result[0]==false){
                    $("#vendor_id").val('').trigger('change');
                    alert(result[1]);
                    location.reload();
                }
                $(".blockUI").hide();
            }
        });

    });

});
</script>
@endsection