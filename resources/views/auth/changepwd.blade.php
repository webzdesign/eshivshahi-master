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
            <form id="verifyOtp" method="POST" action="{{ route('login.changepassword') }}" aria-label="{{ __('Login') }}" autocomplete="off">
                @csrf
                <h1>Set Password</h1>
                <div>
                    <input id="mobile" readonly maxlength="10" minlength="10" type="text" placeholder="Mobile" class="numberonly form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $mobile }}" required >
                </div>
                <div>
                    <input id="password" maxlength="16" type="password" class="form-control" name="password" placeholder="Enter Password" autofocus>
                </div>
                <div>
                    <input id="confirmpassword" maxlength="16" type="password" class="form-control" name="confirmpassword" placeholder="Enter Confirm Password" >
                </div>
                <div>
                    <button class="btn btn-default" type="submit">Login</a>
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
            password:{required: true,minlength:6,maxlength:16},
            confirmpassword:{equalTo: "#password",required: true,minlength:6,maxlength:16},
        },
        messages:
        {
            password:{required:"Please Enter Password",},
            confirmpassword:{required:"Please Enter Confirm Password",},
        },
        submitHandler: function(form){
            $(':input[type="submit"]').prop('disabled',true);
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
