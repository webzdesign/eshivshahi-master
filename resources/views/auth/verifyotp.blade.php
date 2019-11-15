@extends('layouts.app')

@section('content')
<style>
.error{
    color:red;
}
</style>
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form id="verifyOtp" method="POST" action="{{ route('login.changepwd') }}" aria-label="{{ __('Login') }}" autocomplete="off">
                @csrf
                <h1>Verification</h1>
                <div>
                    <input id="mobile" readonly maxlength="10" minlength="10" type="text" placeholder="Mobile" class="numberonly form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $verifyMobile }}" required >
                </div>
                <div>
                    <input id="otp" type="text" class="form-control" name="otp" placeholder="Enter Otp" required autofocus>
                </div>
                <div>
                    <button class="btn btn-default" type="submit">Next</a>
                </div>
                <div class="clearfix"></div>
                <div class="separator">

                    <div class="clearfix"></div>
                    <br />
                    <div>
						<?php   $title=DB::table('companydetails')->get(); ?>
                        <h1><i class="fa fa-bus"></i> {{$title[0]->name}}</h1>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>

@endsection
@section('script')
<script>
jQuery(document).ready(function($){
$('#verifyOtp').validate({
    onkeyup: function(element) {$(element).valid()},
        rules:
        {
            otp:{required: true,
                remote: {
                    url:'{{url("/checkOtp")}}',
                    type: "post",
                    data:
                    {
                        otp: function()
                        {
                            return $('#verifyOtp :input[name="otp"]').val();
                        },
                        mobile: function()
                        {
                            return $('#verifyOtp :input[name="mobile"]').val();
                        },
                    },
                },
            },
        },
        messages:
        {
            otp:{required:"Please Enter OTP",remote:"OTP Does Not Match."},
        },
        submitHandler: function(form){
            $(':input[type="submit"]').prop('disabled', true);
            form.submit();
        },
    });
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
});
</script>
@endsection
