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
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" autocomplete="off">
                @csrf
                <h1>Login Here</h1>
                <div>
                    <input id="mobile" maxlength="10" minlength="10" type="text" placeholder="Mobile" class="numberonly form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required autofocus>

                    @if ($errors->has('mobile'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
                <div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div>
                    <button class="btn btn-default" type="submit">Log in</button>
                    <a href="resetpassword"><button  class="btn btn-default" type="button"> Reset Password </button></a>
                </div>

                <div class="clearfix"></div>
                <div class="separator">
                <p class="change_link"><span style="font-size:16px;font-weight:bold">Verification ?</span>
                  <a href="#signup" class="to_register"><span style="font-size:18px;font-weight:bold;text-decoration:underline;">  Click here !</span> </a>
                </p>
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
    <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form id="verifyForm" method="POST" action="{{ route('login.sendotp') }}" autocomplete="off">
              <h1>Verification</h1>
              @csrf
              <div>
                <input type="text" id="verifyMobile" name="verifyMobile" class="form-control numberonly" minlength="10" maxlength="10" placeholder="Enter Mobile" />
                <label id="verifyMobile_error" for="verifyMobile" style="color: red;"></label>
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" id="submitButton" href="index.html">Send OTP</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link"><span style="font-size:16px;font-weight:bold">Already a member ?</span>
                  <a href="#signin" class="to_register"><span style="font-size:18px;font-weight:bold;text-decoration:underline;"> Log in </span></a>
                </p>

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
    var submitstatus = 0;
    $('body').on('keyup','#verifyMobile',function(e){
        var mobile = $('#verifyMobile').val();

        if(mobile != ''){
            $.ajax({
                type:"POST",
                url:"{{url('/checkMobileNumber')}}",
                data:{mobile: mobile},
                dataType:'json',
                success:function(response_array){
                    if(response_array['status'] == '0')
                    {
                        submitstatus=1;
                    $('#verifyMobile_error').empty().append(response_array['msg']);
                    }
                    else{
                        submitstatus=0;
                        $('#verifyMobile_error').empty();
                    }

                }
            });
        }
        else
        {
            submitstatus=0;
            $('#verifyMobile_error').empty();
        }
    });

    $("body").on("click","#submitButton",function(e){
        e.preventDefault();
        if(submitstatus == 0){
            $(':button[type="submit"]').prop('disabled', true);
            $("#verifyForm").submit();
        }
     });

$('#verifyForm').validate({
    onkeyup: function(element) {$(element).valid()},
        rules:
        {
            verifyMobile:{required: true,minlength:10,maxlength:10,

            },
        },
        messages:
        {
            verifyMobile:{required:"Please Enter Mobile No",remote:"Mobile Number Does Not Exist."},
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
