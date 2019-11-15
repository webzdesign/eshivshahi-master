@extends('layouts.master')
@section('content')
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
             <form role="form" class="form-horizontal form-label-left" method="POST" action="" id="changepass">
                  <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12">Old Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" class="form-control col-md-7 col-xs-12" id="old_password" name="old_password" placeholder="Enter your Old Password"/>
                      </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 col-sm-3 col-xs-12">New Password<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" class="form-control col-md-7 col-xs-12" name="password" id="password" placeholder="Enter your New Password"/>
                         </div>
                    </div>
                    <div class="form-group">
                         <label class="col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span></label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"/>
                      </div>
                    </div>

          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a type="button" class="btn btn-default" id="close" href="{{ route('home')}}">Close</a>
             <input type="submit" name="btn_changepass" value="Change" class="btn btn-primary">
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
  <script type="text/javascript">
    jQuery(document).ready(function(){
      var check=false;
     var id= $("#user_id").val();  
     //form validation
    $('#changepass').validate({
       errorClass: 'errors',
      rules:
      {
        old_password:{
              required: true,
              remote: {
                  url: "{{url('checkpassword')}}",
                   type: "post",
                   data:
                   {
                     id:id,
                     name: function()
                     {
                       return $('#changepass :input[old_password=""]').val();
                     },
                  },
              },
          },
       password: {
            required: true,
            minlength: 6,
            maxlength:15,
        },
      confirmpassword: {
            required: true,
            equalTo: "#password"
        },
      },
      messages:
      {
        old_password:{
          required: "Please Enter Old Password",
          remote:"Password Is Wrong",
        },
        password:{
          required:"Please Enter New Password",
          minlength:"Minimum 6 Characters",
          maxlength:"Maximum 15 Characters"
        },
        confirmpassword:{
           required:"Please Re-Enter Password",
           equalTo:"Password And Confirm Password Does Not Match",
        },
      },
        highlight: function (element) {
                $(element).parent().addClass('error')
        },
            unhighlight: function (element) {
                $(element).parent().removeClass('error')
        },
      submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                check=true;
               //form.submit();
            },
            errorPlacement: function(error, element) {
      error.appendTo(element.parent("div"));
    },
      
    });
    //to set value of button
    $(document).on('click','#cp',function(){
        $("input[type='submit']").val('Change');
        $("input[type='password']").val('');
    });
    //ajax call for updating password
    $("#changepass").on('submit',function (event) {
      event.preventDefault();
       if(check)
       {
          var formData=$("#changepass").serialize();
         $.ajax({
                  type: 'POST',
                  url: '{{url("changepassword")}}',
                  dataType:'json',
                  data: {formdata:formData,id:$('input[name=user_id]').val()},
                  success: function(res){
                     $("#changepassword").modal('hide');
                     $(':input[type="submit"]').prop('disabled', false);
                     swal('success!','Password Changes Successfully');
                     location.href = "{{ route('home')}}";
                  }
            });
       }
       return false;
       
      });
  });
  </script>
  @endsection