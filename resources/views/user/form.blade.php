<?php
  /*
    Hardik
    Date:24-8-18
  */

?>

@extends('layouts.master')
@section('content')
@if($action=='insert')
   @php  $btn = 'Submit'; @endphp
@else
    @php $btn = 'Update'; @endphp
@endif
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
                    <h2> {{ $modulename }}</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                  @if($action=='insert')
                  <form id="frm_single" method="post"  action ="{{url("/$route")}}"   class="form-horizontal form-label-left" autocomplete="off">
                  @else
                  <form id="frm_single" method="post"  action ="{{url("/$route/".$result->id)}}" class="form-horizontal form-label-left" autocomplete="off">
                  @method('PUT')
                         <input type="hidden" name="id" value="{{$result->id}}">
                  @endif

                             @csrf

                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >First Name <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="first_name" placeholder="Enter First Name" name="first_name"  class="form-control col-md-7 col-xs-12 first_name" value="{{ $action=='update'?$result->first_name:old('first_name') }}">
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
                                    <input  type="text" id="last_name" placeholder="Enter Last Name" name="last_name"  class="form-control col-md-7 col-xs-12 last_name" value="{{ $action=='update'?$result->last_name:old('last_name') }}">
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

                                    <input  type="text" id="email" name="email" placeholder="Enter Email Id" class="form-control col-md-7 col-xs-12 email" value="{{ $action=='update'?$result->email:old('email') }}">
                                    @if ($errors->has('email'))
                                    <span class="error">
                                     <b> {{ $errors->first('email') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Mobile <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="text" id="mobile" maxlength="10" placeholder="Enter Mobile Number" name="mobile"  class="form-control col-md-7 col-xs-12 mobile numberonly" value="{{ $action=='update'?$result->mobile:old('mobile') }}">
                                    @if ($errors->has('mobile'))
                                    <span class="error">
                                     <b> {{ $errors->first('mobile') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            @if($action=='insert')
                            <?php /* <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Password  <span class="error">*</span>
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
							<div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Confirm Password  <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  type="password" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password"  class="form-control col-md-7 col-xs-12	confirm_password" value="">
                                    @if ($errors->has('confirm_password'))
                                    <span class="error">
                                     <b> {{ $errors->first('confirm_password') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div> */ ?>
                            @endif
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Divison  <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="division_id" name="division_id" style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 division_id">
                                        <option value=""></option>
                                        @foreach($division as $division_val)
                                        <option value="{{ $division_val->id }}" @if($action=='update') {{ $division_val->id==$result->division_id?'selected':''}} @else {{$division_val->id==old('division_id')?'selected':''}}  @endif>{{ $division_val->name }}</option>
                                        @endforeach
                                    <select>
                                   @if ($errors->has('division_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('division_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Depot  <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <select  id="depot_id" name="depot_id"  class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;">
                                        <option value=""></option>
                                            @if(!empty(old('division_id')))
                                                    @php $depot = App\Model\Depot::where('division_id',old('division_id'))->get(); @endphp
                                                    @foreach($depot as $depot_val)
                                                    <option value="{{$depot_val->id}}" {{ $depot_val->id==old('depot_id')?'selected':'' }}>{{$depot_val->name}}</option>
                                                    @endforeach
                                            @else
                                                @foreach($depot as $depot_val)
                                                <option value="{{$depot_val->id}}"  @if($action=='update') {{ $depot_val->id==$result->depot_id?'selected':''}} @else @endif>{{$depot_val->name}}</option>
                                                @endforeach
                                            @endif

                                    <select>
                                     @if ($errors->has('depot_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('depot_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >User Type  <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select  id="usertype_id" name="usertype_id"  class="form-control select2_single col-md-7 col-xs-12 usertype_id" style="width:100%;">
                                        <option value=""></option>
                                        @foreach($usertype as $usertype_val)
                                            @if($usertype_val->name != 'Vendor Accountant')
                                        <option value="{{$usertype_val->id}}"  @if($action=='update') {{ $usertype_val->id==$result->usertype_id?'selected':''}}@else  {{ $usertype_val->id==old('usertype_id')?'selected':''}}   @endif>{{$usertype_val->name}}</option>
                                        @endif
                                        @endforeach
                                    <select>
                                    @if ($errors->has('usertype_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('usertype_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                          <?php /*
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Access Type  <span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  id="accesstype_id" name="accesstype_id"  class="form-control select2_single col-md-7 col-xs-12 accesstype_id">
                                        <option value=""></option>
                                        @foreach($accesstype as $accesstype_val)
                                        <option value="{{ $accesstype_val->id }}"  @if($action=='update') {{ $accesstype_val->id==$result->accesstype_id?'selected':''}} @else  {{ $accesstype_val->id==old('accesstype_id')?'selected':''}}   @endif>{{ $accesstype_val->name }}</option>
                                        @endforeach
                                    <select>

                                    @if ($errors->has('accesstype_id'))
                                    <span class="error">
                                     <b> {{ $errors->first('accesstype_id') }}</b>
                                    </span>
                                     @endif
                                </div>
                            </div>
                            */ ?>
                            <div class="form-group">
                                <label class=" col-md-3 col-sm-3 col-xs-12" >Status<span class="error">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if($action=='insert')
                                    <label><input type="radio" class="status" name="active_status" id="active_status" value="1" checked />Active</label> &nbsp;
                                    <label> <input type="radio" class="status" name="active_status" id="inactive_status" value="0" />
                                    Inactive</label>
                                    @else
                                    <label><input type="radio" class="status" name="active_status" id="active_status" value="1" @if($result->active_status == 1) { checked } @endif/>Active</label> &nbsp;
                                    <label> <input type="radio" class="status" name="active_status" id="inactive_status" value="0" @if($result->active_status == 0) { checked } @endif />
                                    Inactive</label>
                                    @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>

                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a href="{{url("/$route")}}"  class="btn btn-warning" >Cancel </a>
                            <button type="submit" class="btn btn-primary">{{ $btn }}</button>
                           </div>
                        </div>
                        @if(count($data)>0)
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                <th>Sr no.</th>
                                <th>User Name</th>
                                <th>Updated Date</th>
                                <th>Updated Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                  @foreach($data as $key=>$history)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ $history->first_name.' '.$history->last_name}}</td>
                                        <td>{{ date('d-m-Y',strtotime($history->updated_at))}}</td>
                                        <td>{{ date('H:i',strtotime($history->updated_at))}}</td>
                                    </tr>
                                  @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
@section('script')
<script type="text/javascript">
$('#frm_single').validate({
                        submitHandler: function(form) {
                            $(':input[type="submit"]').prop('disabled', true);
                            form.submit();
                        },
					});

					    jQuery(document).ready(function(){

							$("body").on("change","#division_id",function(){
								var division_id =  $("#division_id").val();
								$.ajax({
									type:'POST',
									url:'{{url('/getuserdepotdata')}}',
									data:{
										division_id:division_id
									},
									success:function(result){
										$("#depot_id").empty().html(result);
									}
								});
							});

						});
</script>
@endsection