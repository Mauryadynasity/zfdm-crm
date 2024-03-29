
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ZFDM | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    html, body {
    height: auto;
}
  </style>
</head>
<body class="hold-transition login-page">
<div class="row">
<div class="col-md-12 text-right">
  <br/>
  <select onchange='window.location.replace("{{url('greeting')}}/"+$(this).val())'>
    <option value="en" @if(Session::get('applocale')=='en') selected @endif>English</option>
    <option value="gm" @if(Session::get('applocale')=='gm') selected @endif>German</option>
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <br/>
</div>
</div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
    <img src="{{asset('images/logo.png')}}" alt="">
  </div>
    <h3 class="text-info text-center" style="margin-bottom: 15px;"><strong>{{__('messages.CRM_Login')}}</strong></h3>
    <hr style="height: 1px;background-color: #c0c0c0;"/>
    @if(session()->has('message'))
            <div class="alert alert-success">
              {{ session()->get('message') }}
            </div>
        @endif
        <div class="flash-message">
            @if(session('fail'))
            <div class='alert alert-danger'>
                <p align="center">{{ session('fail')}}</p>
            </div>
            @endif
    <form enctype="multipart/form-data" method="POST" id="form-data" action="{{url('/admin/login')}}" autocomplete="nope">
        @csrf      
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="nope">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if($errors->has('email'))
              <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if($errors->has('password'))
              <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="row">
          <!-- <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" value="1"> Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{__('messages.Sign_In')}}</button>
          </div>
          <!-- /.col -->
        </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
