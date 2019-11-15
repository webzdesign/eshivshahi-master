<?php

  /*

    Puja

    Date:27-8-18

  */



?>


<?php //echo "<pre>"; print_r($user);exit; ?>

@extends('layouts.master')

@section('content')

@php  $redirect = $route; @endphp

@if($action=='insert')

   @php  $btn = 'Submit'; @endphp

   @php  $route=route('vendoraccountant.store'); @endphp

@elseif($action=='update')

    @php $btn = 'Update'; @endphp

    @php  $route=route('vendoraccountant.update',Crypt::encryptString($vendoraccountant->id)); @endphp

@else

@php $btn = 'View'; @endphp

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

                  <form id="frm" method="post"  action ="{{$route}}"   class="form-horizontal form-label-left" autocomplete="off">

                  @if($action=='update')

                  @method('PUT')

                         <input type="hidden" name="id" id="id" value="{{$vendoraccountant->id}}">

                  @endif

                             @csrf

                                <div class="form-group">
	                                <label class=" col-md-3 col-sm-3 col-xs-12" >Vendor<span class="required"> *</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  id="vendor_id" name="vendor_id"  class="form-control select2_single col-md-7 col-xs-12 vendor_id" @if(Auth::user()->usertype_id!=1) disabled @endif>
                                        <option value=""></option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{$vendor->id}}" {{(old('vendor_id')==$vendor->id)?'selected':''}} @if(Auth::user()->usertype_id!=1 ){{($vendor->id==$vendorselected[0]->vendor_id)?'selected':''}} @endif <?php if(isset($vendoraccountant)){
                                                    if($vendoraccountant->vendor_id==$vendor->id){
                                                        echo "selected";
                                                    }
                                                    else
                                                    {
                                                        echo '';
                                                    }
                                                } ?>>{{$vendor->vendor_name}} </option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('vendor_id'))
                                    <span class="error">
                                    <b> {{ $errors->first('vendor_id') }}</b>
                                    </span>
                                    @endif
                                    </div>
                                </div>
                                @if(Auth::user()->usertype_id !=1)
                                    <input type="hidden" name="vendor_id" value="{{$vendorselected[0]->vendor_id}}"  />
                                @endif

                              <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >First Name<span class="required"> *</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="first_name" placeholder="Enter First Name" name="first_name"  class="textonly form-control col-md-7 col-xs-12 first_name" value="{{ $action=='update'|| $action=='view'?$vendoraccountant['user']->first_name:old('first_name') }}">

                                    @if ($errors->has('first_name'))

                                    <span class="error">

                                     <b> {{ $errors->first('first_name') }}</b>

                                    </span>

                                     @endif

                                </div>

                            </div>

                            <div class="form-group">

                                <label class=" col-md-3 col-sm-3 col-xs-12" >Last Name<span class="required"> *</span>

                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <input  type="text" id="last_name" placeholder="Enter Last Name" name="last_name"  class="textonly form-control col-md-7 col-xs-12 last_name" value="{{ $action=='update' || $action=='view' ?$vendoraccountant['user']->last_name:old('last_name') }}">

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
                                    <input  type="text" id="email" name="email" placeholder="Enter Email"  class="form-control col-md-7 col-xs-12 email" value="{{ $action=='update' || $action=='view'?$vendoraccountant['user']->email:old('email') }}">
                                    @if ($errors->has('email'))
                                    <span class="error">
                                     <b> {{ $errors->first('email') }}</b>
                                    </span>
                                     @endif
                                </div>
                                @if($action=='update' || $action=='view')
                                <input type="hidden" name="user_id" value="{{$vendoraccountant['user']->id}}">
                                @endif
                            </div>

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Mobile <span class="required"> *</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="mobile" maxlength="10" name="mobile" placeholder="Enter Mobile Number"  class="form-control col-md-7 col-xs-12 mobile numberonly" value="{{ $action=='update' || $action=='view'?$vendoraccountant['user']->mobile:old('mobile') }}">
                                    @if ($errors->has('mobile'))
                                    <span class="error">
                                     <b> {{ $errors->first('mobile') }}</b>
                                    </span>
                                     @endif
                                </div>
                                @if($action=='update' || $action=='view')
                                <input type="hidden" name="user_id" value="{{$vendoraccountant['user']->id}}">
                                @endif
                            </div>

                            @if($action=='insert')
                            <?php /*
                            <div class="form-group">

                                <label class=" col-md-3 col-sm-3 col-xs-12" >Password<span class="required"> *</span>

                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <input  type="password" id="password" placeholder="Enter Password" name="password"  class="form-control col-md-7 col-xs-12	password" value="">

                                    @if ($errors->has('password'))

                                    <span class="error">

                                     <b> {{ $errors->first('password') }}</b>

                                    </span>

                                     @endif

                                </div>

                            </div>
                            */ ?>
                            @endif
                            @if($action=='insert')
                            <?php /*
                                <div class="form-group">
                                    <label class=" col-md-3 col-sm-3 col-xs-12" >Confirm Password<span class="required"> *</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  type="password" id="password_confirmation"placeholder="Enter Confirn Password" name="password_confirmation"  class="form-control col-md-7 col-xs-12	password_confirmation" value="">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="error">
                                        <b> {{ $errors->first('password_confirmation') }}</b>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            */ ?>
                            @endif
                            <div class="form-group">

                                <label class=" col-md-3 col-sm-3 col-xs-12" >Access Type<span class="required"> *</span>

                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <select  id="accesstype_id" name="accesstype_id_select"  class="form-control select2_single col-md-7 col-xs-12 accesstype_id" disabled>
                                        <option value=""></option>

                                        @foreach($accesstypes as $accesstype)
                                        <option value="{{ $accesstype->id }}"  {{ $accesstype->name=='Vendor'?'selected':''}}>{{ $accesstype->name }}</option>
                                        @endforeach

                                    <select>

                                   <input type="hidden" name="accesstype_id" value="{{$user[0]->accesstype_id}}">

                                    @if ($errors->has('accesstype_id'))

                                    <span class="error">

                                     <b> {{ $errors->first('accesstype_id') }}</b>

                                    </span>

                                     @endif

                                </div>

                            </div>

                            <div class="form-group">

                                <label class=" col-md-3 col-sm-3 col-xs-12" >User Type<span class="required"> *</span>

                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <select  id="usertype_id_select" name="usertype_id"  class="form-control select2_single col-md-7 col-xs-12 usertype_id" disabled>


                                        @foreach($usertypes as $usertype)

                                        @if($usertype->name=='Vendor Accountant')

                                        <option value="{{ $usertype->id }}" selected >{{ $usertype->name }}</option>
                                        <input type="hidden" name="usertype_id" id="usertype_id" value="{{ $usertype->id }}">
                                        @endif

                                        @endforeach

                                    </select>



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

                            <a href="{{url($redirect)}}"  class="btn btn-danger">Cancel</a>

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

    $(document).ready(function(){

        if('{{$action}}'=='view')

        {

            $("input").prop('readonly',true);

            $("select").prop('disabled',true);

            $("button").hide();

        }

         $("body").on("change","#vendor_id",function(e){

             /*   e.preventDefault();
                var vendor_id = $(this).val();
                var accesstype_id = $("#accesstype_id").val();
                var usertype_id = $("#usertype_id").val();
                var id = $("#id").val();

                $(".blockUI").show();
                $.ajax({
                    type:'POST',
                    url:'{{url('/checkVendorAcAllowUser')}}',
                    dataType:'JSON',
                    data:{
                        vendor_id:vendor_id,
                        accesstype_id:accesstype_id,
                        usertype_id:usertype_id,
                        id:id
                    },
                    success:function(result){
                        if(result[0]==false){
                            alert(result[1]);
                            location.reload();
                        }
                        $(".blockUI").hide();
                    }
                });*/

         });
    });

</script>

@endsection