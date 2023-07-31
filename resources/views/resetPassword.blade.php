<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SSLogistics | Reset Password</title>
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('resources')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('resources')}}/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
     <script src="{{asset('resources')}}/plugins/jQuery/jQuery-2.1.4.min.js"></script>
   <style>
   [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {display: none !important;}
   </style>
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
       
     
      <div class="login-box-body" data-ng-controller="resetPasswordController">
       <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message')
          <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
        </div>
        <p class="login-box-msg">Reset Password </p>
          <form ng-submit="resetPassword();" id="resetPasswordForm" name="resetPasswordForm" data-ng-init="viewResetPassword();">
             {{csrf_field()}}
             <span ng-view='success' ng-bind='success'></span>
              <input type="hidden" ng-model="token" name="token" ng-bind='token'>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="New Password" name="password" ng-model="password" ng-minlength="8" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="resetPasswordForm.password.$touched  && resetPasswordForm.password.$error.required">Password is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="resetPasswordForm.password.$touched && resetPasswordForm.password.$invalid">Password must be atleast 8 characters long.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" ng-model="confirm_password" ng-minlength="8" compare-to="password" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="resetPasswordForm.confirm_password.$touched  && resetPasswordForm.confirm_password.$error.required">Confirm Password is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="resetPasswordForm.confirm_password.$touched && resetPasswordForm.confirm_password.$error.compareTo">Password and Confirm Password should match.</span>
              </div>
            
            
            <div class="row submit-button-holder">
              <div class="col-xs-8">    
                                      
              </div><!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" ng-disabled="resetPasswordForm.$invalid" class="btn btn-primary">Submit</button>
              </div><!-- /.col -->
            </div>
          </form>      

        <a href="<?php echo \URL::route('login'); ?>">Back to Login</a><br>
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

   <!-- Require Js-->
   <script src="{{ asset('/angularJs/bower_components/requirejs/require.js') }}"></script>
   <script src="{{ asset('/angularJs/require_config.js') }}"></script>
   <script src="{{ asset('/angularJs/angularModules/reset-password/resetPasswordApp.js') }}"></script>

  </body>
</html>