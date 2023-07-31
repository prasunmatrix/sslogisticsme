<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SSLogistics | Forgot Password</title>
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
    
    <div class="login-box" data-ng-controller="forgotPasswordController">

       <div class="loading-spiner-holder" ng-model="showLoader" ng-show="showLoader">
          <div class="loading-spiner">
            <img id="spinner" class="spinner" src="{{ asset('/images/loader.gif') }}">
          </div>
       </div>
        <!--<div class="container_loading_wapper" id="loadingBar"><div class="container_loading"></div></div>-->

      <div class="login-box-data" ng-style="hideBox">
          <div class="login-logo">
            <a href="{{asset('')}}"><b>
              <img src="{{asset('images/logo.jpg')}}">
            </a>
          </div><!-- /.login-logo -->
       
      
          <div class="login-box-body" >
           <div class="flash-message" ng-hide="msgDisplay">
            @include('common.flash_message')
            <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
          </div>
           
            <p class="login-box-msg">Forgot Password </p>
              <form ng-submit="forgotPassword();" id="forgotPasswordForm" name="forgotPasswordForm">
                 {{csrf_field()}}
                 <span ng-view='success' ng-bind='success'></span>
                <div class="form-group has-feedback">
                  <input type="email" class="form-control" placeholder="Email" name="email" ng-model="email" required/>
                  <span class="invalidInputErrorClass" ng-cloak ng-show="forgotPasswordForm.email.$touched && forgotPasswordForm.email.$invalid">The email is invalid.</span>

                </div>
                
                
                <div class="row submit-button-holder">
                  <div class="col-xs-8">    
                                          
                  </div><!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" ng-disabled="forgotPasswordForm.$invalid" class="btn btn-primary">Submit</button>
                  </div><!-- /.col -->
                </div>
              </form>      

            <a href="<?php echo \URL::route('login'); ?>">Back to Login</a><br>
          </div><!-- /.login-box-body -->
      </div>
    </div><!-- /.login-box -->

   <!-- Require Js-->
   <script src="{{ asset('/angularJs/bower_components/requirejs/require.js') }}"></script>
   <script src="{{ asset('/angularJs/require_config.js') }}"></script>
   <script src="{{ asset('/angularJs/angularModules/forgot-password/forgotPasswordApp.js') }}"></script>

  </body>
</html>