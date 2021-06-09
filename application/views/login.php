

<div class="container login">
  <div class="row">
    <div class="col-md-6 mb-5">

      <!-- Registration-->
      <div class="card shadow p-5 animated zoomIn slow">
        <h3 class="text-center font-weight-bold text-uppercase mb-3">SIGN UP</h3>
         <div class="alert alert-danger" id="alert-danger" role="alert"></div>
        <div class="alert alert-success" id="alert-success" role="alert"></div>
        <form id="data-insert"  data-parsley-validate action="javascript:void(0);" method="post" name="data-insert" class="">
          <div class="form-group">
            <label>Enter Username</label>
            <input type="text" id="f_user_name" name="f_user_name" class="form-control">
          </div>
          <div class="form-group">
            <label>Enter Phoneno</label>
            <input type="text" id="f_user_phoneno" name="f_user_phoneno" class="form-control">
          </div>
          <div class="form-group">
            <label>Enter Email Address</label>
            <input type="text" id="f_user_email" name="f_user_email" class="form-control">
          </div>
          <div class="form-group">
            <label>Enter Password</label>
            <input type="password" id="f_user_password"  name="f_user_password" class="form-control">
          </div>
          <!-- <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" id="f_user_password_con" class="form-control">
          </div> -->
        <button type="submit" class="btn btn-outline-dark btn-block rounded-pill">Register</button>
         <!--  <h6 class="mt-3">Don't have an account? <a href="#"> Create Account Here</a></h6> -->
        </form>

      </div>
    </div>
    
    <div class="col-md-6 mb-5">

      <!-- Login-->
      <div class="card shadow animated zoomIn slow p-5">
        <h3 class="text-center font-weight-bold text-uppercase mb-3">Login Here</h3>
        <div class="alert alert-danger" role="alert"></div>
        <div class="alert alert-success" role="alert"></div>
        <form autocomplete="off" id="data-check"  data-parsley-validate action="javascript:void(0);" method="post" name="data-check" class="">
          <div class="form-group">
            <label>Enter Email Address</label>
            <input type="text" id="f_user_name" name="f_user_name" class="form-control">
          </div>
          <div class="form-group">
            <label>Enter Password</label>
            <input type="password" id="f_user_password" name="f_user_password" class="form-control">
          </div>

          <button type="submit" class="btn btn-outline-dark btn-block rounded-pill">Login</button>
        </form>
        <!-- <h6 class="mt-3">Don't have an account? <a href="#"> Create Account Here</a></h6> -->
        <!-- <p class="text-center mt-3"> or Login with<p> -->
          <div class="text-center">
            <i class="fab fa-facebook mx-2 fa-2x"></i>
            <i class="fab fa-twitter  mx-2 fa-2x"></i>
            <i class="fab fa-instagram  mx-2 fa-2x"></i>
            <i class="fab fa-google  mx-2 fa-2x"></i>
          </div>

        </div>
      </div>

    </div>
  </div>
  <script type="text/javascript">
     jQuery(document).ready(function ($) {
       $('.alert-danger').hide();
       $('.alert-success').hide();
      var url = '<?php echo base_url(); ?>';
  $(function() {
  $("form[name='data-check']").validate({
    rules: {
      f_user_name: {
        required: true,
        email: true
      },
      f_user_password: {
        required: true,
        minlength: 8
      }
    },
    messages: {
      f_user_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
      },
      f_user_name: "Please enter a valid email address"
    },
    submitHandler: function(form) {
       $.ajax({
                    url: url + '/Customer/Customerlogin',
                    type: 'post',
                    data: $('#data-check').serialize(),
                    dataType: 'json',
                    cache: false,
                    success: function (response) {
                       if(response['process']==true)
                       {
                        $('#alert-danger').hide();
                         $('#alert-success').hide();
                         $('.alert-danger').hide();
                         $('.alert-success').show();
                          
                         $('.alert-success').hide().fadeIn(1000).html(response['message']);
                          setTimeout(function () {
                                        location.replace(response.location);
                            }, 1500);

                       }
                       else{
                        $('#alert-danger').hide();
                         $('#alert-success').hide();
                         $('#alert-danger').hide();
                         $('.alert-danger').show();
                         $('.alert-danger').hide().fadeIn(1000).html(response['message']);
                       }
                        
                    }, error: function (error) {
                        $('.alert-danger').fadeIn(1000).html('<p>Please try again</p>');
                    }
                });
    }
  });
});
   $("form[name='data-insert']").validate({
    rules: {
      f_user_name: {
        required: true,
      },
       f_user_email: {
        required: true,
      },
      f_user_password: {
        required: true,
         minlength: 8
      },
      f_user_password_con: {
        equalTo: "#f_user_password"
      },
      f_user_phoneno:{
        required: true,
        number: true
      }
    },
    messages: {
      f_user_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
      },
      f_user_email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
       $.ajax({
                    url: url + '/Customer/Customerinsert',
                    type: 'post',
                    data: $('#data-insert').serialize(),
                    dataType: 'json',
                    cache: false,
                    success: function (response) {
                       if(response['process']==true)
                       {
                         $('#alert-danger').hide();
                         $('#alert-success').show();
                         $('#alert-success').hide().fadeIn(1000).html(response['message']);

                       }
                       else{
                         $('#alert-danger').show();
                         $('#alert-danger').hide().fadeIn(1000).html(response['message']);
                       }
                        
                    }, error: function (error) {
                        $('.alert-danger').fadeIn(1000).html('<p>Please try again</p>');
                    }
                });
    }
  });

     });
  </script>
