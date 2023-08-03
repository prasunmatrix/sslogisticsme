<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SSLogistics | Log in</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('resources')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('resources')}}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
   [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {display: none !important;}
   </style>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      var baseUrl ='{{url('')}}';  
    </script>
  </head>
  
  <body class="login-page" data-ng-controller="commonController" ng-cloak>
  
    <div class="login-box">
      <div class="login-logo">
        <a href="{{asset('')}}"><b>
          <img src="{{asset('images/logo.jpg')}}">
        </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" data-ng-controller="usersController">
       <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message')
          <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
        </div>
        <p class="login-box-msg">Sign in </p>
        <form ng-submit="adminLogin();" id="loginForm" name="loginForm">
           {{csrf_field()}}
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="username" ng-model="username" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="invalidInputErrorClass" ng-cloak ng-show="loginForm.username.$touched && loginForm.username.$invalid">The username is invalid.</span>

          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" ng-model="password" ng-minlength="8" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="invalidInputErrorClass" ng-cloak ng-show="loginForm.password.$touched  && loginForm.password.$error.required">Password is required.</span>
            <span class="invalidInputErrorClass" ng-cloak ng-show="loginForm.password.$touched && loginForm.password.$invalid">Password must be atleast 8 characters long.</span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
                                    
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" >Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>        

        <a href="<?php echo \URL::route('viewForgotPassword'); ?>">I forgot my password</a><br>
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

   <!-- Require Js-->
   <script src="{{ asset('/angularJs/bower_components/requirejs/require.js') }}"></script>
   <script src="{{ asset('/angularJs/require_config.js') }}"></script>
   <script src="{{ asset('/angularJs/angularModules/users/usersApp.js') }}"></script>

  </body>
</html>