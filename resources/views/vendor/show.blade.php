<?php
  /*
    Hardik
    Date:23-8-18
  */

?>

@extends('layouts.master')
@section('content')
@if($action=='insert')
   @php  $btn = 'Add'; @endphp
@else
    @php $btn = 'Update'; @endphp
@endif
<div class="right_col" role="main">
	<div class="">
	<div class="page-title">
		<div class="title_left">

		</div>
		<div class="title_right">
			<a href="{{url("/$route")}}"  class="btn btn-primary" >Back</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
			<h2>{{ $btn }} {{ $modulename }}</h2>
			<div class="clearfix"></div>
			</div>

			<div class="x_content">
			@if($action=='insert')
			<form id="frm" method="post"  action ="{{url("/$route")}}"   class="form-horizontal form-label-left">
			@else
			<form id="frm" method="post"  action ="{{url("/$route/".$result->id)}}" class="form-horizontal form-label-left">
				<input type="hidden" name="_method" value="PUT">
			@endif

					<input type="hidden" name="_token" value="{{csrf_token()}}">

					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >First Name
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input  type="text" id="first_name" name="first_name" readonly  class="form-control col-md-7 col-xs-12 first_name" value="{{ $action=='update'?$result->first_name:old('first_name') }}">
							@if ($errors->has('first_name'))
							<span class="error">
								<b> {{ $errors->first('first_name') }}</b>
							</span>
								@endif
						</div>

					</div>
					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >Last Name
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input  type="text" id="last_name" name="last_name" readonly class="form-control col-md-7 col-xs-12 last_name" value="{{ $action=='update'?$result->last_name:old('last_name') }}">
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
							<input  type="text" id="email" name="email" readonly  class="form-control col-md-7 col-xs-12 email" value="{{ $action=='update'?$result->email:old('email') }}">
							@if ($errors->has('email'))
							<span class="error">
								<b> {{ $errors->first('email') }}</b>
							</span>
								@endif
						</div>
					</div>
					@if($action=='insert')
					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >Password
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input  type="password" id="password" name="password"  class="form-control col-md-7 col-xs-12	password" value="">
							@if ($errors->has('password'))
							<span class="error">
								<b> {{ $errors->first('password') }}</b>
							</span>
								@endif
						</div>
					</div>
					@endif
					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >Divison
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select  id="division_id" name="division_id" disabled style="width:100%;" class="form-control select2_single col-md-7 col-xs-12 division_id">
								<option value=""></option>
								@foreach($division as $division_val)
								<option value="{{ $division_val->id }}" @if($action=='update') {{ $division_val->id==$result->division_id?'selected':''}} @endif>{{ $division_val->name }}</option>
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
						<label class=" col-md-3 col-sm-3 col-xs-12" >Depot
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">

							<select  id="depot_id" name="depot_id" disabled class="form-control select2_single col-md-7 col-xs-12 depot_id" style="width:100%;">
								<option value=""></option>
								@foreach($depot as $depot_val)
								<option value="{{$depot_val->id}}"  @if($action=='update') {{ $depot_val->id==$result->depot_id?'selected':''}} @endif>{{$depot_val->name}}</option>
								@endforeach
							<select>
								@if ($errors->has('depot_id'))
							<span class="error">
								<b> {{ $errors->first('depot_id') }}</b>
							</span>
								@endif
						</div>
					</div>
					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >User Type
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<select  id="usertype_id" name="usertype_id" disabled  class="form-control select2_single col-md-7 col-xs-12 usertype_id" style="width:100%;">
								<option value=""></option>
								@foreach($usertype as $usertype_val)
								<option value="{{$usertype_val->id}}"  @if($action=='update') {{ $usertype_val->id==$result->usertype_id?'selected':''}} @endif>{{$usertype_val->name}}</option>
								@endforeach
							<select>
							@if ($errors->has('usertype_id'))
							<span class="error">
								<b> {{ $errors->first('usertype_id') }}</b>
							</span>
								@endif
						</div>
					</div>

					<div class="form-group">
						<label class=" col-md-3 col-sm-3 col-xs-12" >Access Type
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select  id="accesstype_id" disabled name="accesstype_id"  class="form-control select2_single col-md-7 col-xs-12 accesstype_id">
								<option value=""></option>
								@foreach($accesstype as $accesstype_val)
								<option value="{{ $accesstype_val->id }}"  @if($action=='update') {{ $accesstype_val->id==$result->accesstype_id?'selected':''}} @endif>{{ $accesstype_val->name }}</option>
								@endforeach
							<select>

							@if ($errors->has('accesstype_id'))
							<span class="error">
								<b> {{ $errors->first('accesstype_id') }}</b>
							</span>
								@endif
						</div>
					</div>
					<div class="ln_solid"></div>


			</div>
		</div>
		</div>
	</div>
	</div>
</div>

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection