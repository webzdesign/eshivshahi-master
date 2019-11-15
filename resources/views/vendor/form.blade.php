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
            <h2>{{ $btn }} {{ $modulename }}</h2>
            <div class="clearfix"></div>
            </div>

            <div class="x_content">
            @if($action=='insert')
            <form id="frm_single" method="post"  action ="{{url("/$route")}}"   class="form-horizontal form-label-left">
            @else
            <form id="frm_single" method="post"  action ="{{url("/$route/".$result->id)}}" class="form-horizontal form-label-left">
            @method('PUT')
                    <input type="hidden" name="id" value="{{$result->id}}">
            @endif
            @csrf
                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >Vendor Name <span class="error">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="text" id="vendor_name" name="vendor_name"  class="form-control col-md-7 col-xs-12 vendor_name" value="{{ $action=='update'?$result->vendor_name:old('vendor_name') }}">
                            @if ($errors->has('vendor_name'))
                            <span class="error">
                                <b> {{ $errors->first('vendor_name') }}</b>
                            </span>
                                @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >Address<span class="error">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="address" name="address"  class="form-control col-md-7 col-xs-12 address">{{ $action=='update'?$result->address:old('address') }}</textarea>
                            @if ($errors->has('address'))
                            <span class="error">
                                <b> {{ $errors->first('address') }}</b>
                            </span>
                            @endif
                        </div>
                    </div>
                   <?php /* <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >PAN No
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="text" id="pan_no" name="pan_no"  class="form-control col-md-7 col-xs-12 pan_no" value="{{ $action=='update'?$result->pan_no:old('pan_no') }}">
                            @if ($errors->has('pan_no'))
                            <span class="error">
                                <b> {{ $errors->first('pan_no') }}</b>
                            </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >GST No
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="text" id="gst_no" name="gst_no"  class="form-control col-md-7 col-xs-12 gst_no" value="{{ $action=='update'?$result->gst_no:old('gst_no') }}">
                            @if ($errors->has('gst_no'))
                            <span class="error">
                                <b> {{ $errors->first('gst_no') }}</b>
                            </span>
                                @endif
                        </div>
                    </div>

                        <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >Bank Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="text" id="bank_name" name="bank_name"  class="form-control col-md-7 col-xs-12 bank_name" value="{{ $action=='update'?$result->bank_name:old('bank_name') }}">
                            @if ($errors->has('bank_name'))
                            <span class="error">
                                <b> {{ $errors->first('bank_name') }}</b>
                            </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >Account No
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="text" id="account_no" name="account_no"  class="form-control col-md-7 col-xs-12 account_no numberonly" value="{{ $action=='update'?$result->account_no:old('account_no') }}">
                            @if ($errors->has('account_no'))
                            <span class="error">
                                <b> {{ $errors->first('account_no') }}</b>
                            </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >IFSC Code
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="text" id="ifsc_code" name="ifsc_code"  class="form-control col-md-7 col-xs-12 ifsc_code" value="{{ $action=='update'?$result->ifsc_code:old('ifsc_code') }}">
                            @if ($errors->has('ifsc_code'))
                            <span class="error">
                                <b> {{ $errors->first('ifsc_code') }}</b>
                            </span>
                                @endif
                        </div>
                    </div> */ ?>

                    <div class="form-group">
                        <label class=" col-md-3 col-sm-3 col-xs-12" >Status<span class="error">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if($action=='insert')
                            <label><input type="radio" class="status" name="active_status" id="active_status" value="1" />Active</label> &nbsp;
                            <label> <input type="radio" class="status" name="active_status" id="inactive_status" value="0" />
                            Inactive</label>
                            @else
                            <label><input type="radio" class="status" name="active_status" id="active_status" value="1" {{ ($result->active_status == 1) ? 'checked' : '' }} />Active</label> &nbsp;
                            <label> <input type="radio" class="status" name="active_status" id="inactive_status" value="0" {{ ($result->active_status == 0) ? 'checked':'' }} />
                            Inactive</label>
                            @endif
                        </div>
                        @if ($errors->has('active_status'))
                        <span class="error">
                            <b style="margin-left: 211px;"> {{ $errors->first('active_status') }}</b>
                        </span>
                        @endif
                    </div>
                    <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{{url("/$route")}}"  class="btn btn-warning" >Cancel </a>
                    <button type="submit" class="btn btn-primary">{{ $btn }}</button>
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
<script type="text/javascript">
$('#frm_single').validate({
    submitHandler: function(form) {
        $(':input[type="submit"]').prop('disabled', true);
        form.submit();
    },
});
</script>
@endsection