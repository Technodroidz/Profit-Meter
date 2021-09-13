<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profitrack | Super admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('')}}admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
    <!-- /.login-logo -->

    <div class="login-box-body">
      <div class="login-logo">
      <img src="{{asset('files\assets\images\favicon.ico')}}" style="height:50px">
       
      </div>

      <p class="login-box-msg">Profitrack | Super admin</p>

      <form id="login_form" action="{{asset('admin-login')}}" method="post">
        @csrf
        <div class="form-group has-feedback">
          <input type="email" id="email_id" class="form-control" name="email" placeholder="Email" required="required">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <div id="errorMsg"></div>
        </div>

        <input type="hidden" class="form-control" id="userType" name="usertype">


        <div class="form-group has-feedback">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password"
            required="required">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <div id="error_message"></div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <!--   -->
    </div>
 

  </div>
  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>

  <!-- <script type="text/javascript" src="{{asset('js/custom_js.js')}}"></script> -->

  <script>


    $(document).ready(function () {

      function checkUser(email) {
        $.ajax({
          type: 'GET',
          url: '{{ url("/check-user-id") }}',
          data: { "_token": "{{ csrf_token() }}", "email": email },
          success: function (data) {
            if (data.isValid == "Valid") {
              $('#errorMsg').html("<span style='color:green;'>" + data.msg + "</span>");
              $('#userType').val(data.user_type);
            } else {
              $('#errorMsg').html("<span style='color:red;'>" + data.msg + "</span>");
            }
            if (email == '') {
              $('#errorMsg').html('');
              $('#userType').val('');
            }

          }
        });
      }


      $("#login_form").validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: "required"
        },
        messages: {
          email: {
            required: "Please insert valid email id",
            email: "Enter valid email id"
          },
          password: "Please Enter valid password"
        },
        submitHandler: function (form) {
          var email = $('#email_id').val();
          var password = $('#password').val();
          $.ajax({
            type: 'POST',
            url: '{{ url("/admin-login") }}',
            data: { "_token": "{{ csrf_token() }}", "email": email, "password": password },
            success: function (responseText) {
              if (responseText.status == "valid") {
                window.location.href = '{{ url("/admin-panel") }}';
              }else if (responseText.status == 'invalid') {
                $('#error_message').html('<span style="color:red;">Wrong email and password</span>');
              }
            }
          });
        }
      });

      $('#email_id').on('change', function () {
        var email = $('#email_id').val();
        checkUser(email);
      });

    });
  </script>

</body>

</html>