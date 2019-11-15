@extends('layouts.app')

@section('content')
<style>
.error{
    color:red;
}
</style>
<div class="login_wrapper">
  <div id="resetpassword" class="resetpassword_form">
          <section class="login_content">
            <form id="verifyForm" method="POST" action="{{ route('login.resetsendotp') }}" autocomplete="off">
              <h1>Reset Password</h1>
              @csrf
              <div>
                <input type="text" id="verifyMobile" name="verifyMobile" class="form-control numberonly" minlength="10" maxlength="10" placeholder="Enter Mobile" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" href="index.html">Send OTP</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link"><span style="font-size:16px;font-weight:bold">Already a member ?</span>
                  <a href="{{route('login')}}" class="to_register"><span style="font-size:18px;font-weight:bold;text-decoration:underline;"> Log in </span></a>
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
$('#verifyForm').validate({
    onkeyup: function(element) {$(element).valid()},
        rules:
        {
            verifyMobile:{required: true,minlength:10,maxlength:10,
                remote: {
                    url:'{{url("/resetcheckMobileNumber")}}',
                    type: "post",
                    data:
                    {
                        mobile: function()
                        {
                            return $('#verifyForm :input[name="verifyMobile"]').val();
                        },
                    },
                },
            },
        },
        messages:
        {
            verifyMobile:{required:"Please Enter Mobile No",remote:"Mobile Number Does Not Exist."},
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