@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password page
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <div data-ng-controller="changePasswordController">
      <div class="flash-message" ng-hide="msgDisplay">
        @include('common.flash_message')
        <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
      </div>
      <section class="content">

        <!-- Default box -->
        <div class="box">
          
          <div class="box-header with-border">
            <h3 class="box-title">Change Password</h3>
            
          </div>

          <div class="box-body">
            <form ng-submit="changePassword();" id="changePasswordForm" name="changePasswordForm">
               {{csrf_field()}}
                
               <span ng-view='success' ng-bind='success'></span>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Old Password" name="old_password" ng-model="old_password" ng-minlength="8" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="changePasswordForm.old_password.$touched  && changePasswordForm.old_password.$error.required">Old Password is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="changePasswordForm.old_password.$touched && changePasswordForm.old_password.$invalid">Password must be atleast 8 characters long.</span>
              </div>
              
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="New Password" name="password" ng-model="password" ng-minlength="8" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="changePasswordForm.password.$touched  && changePasswordForm.password.$error.required">New Password is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="changePasswordForm.password.$touched && changePasswordForm.password.$invalid">Password must be atleast 8 characters long.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" ng-model="confirm_password" ng-minlength="8" compare-to="password" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="changePasswordForm.confirm_password.$touched  && changePasswordForm.confirm_password.$error.required">Confirm Password is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="changePasswordForm.confirm_password.$touched && changePasswordForm.confirm_password.$error.compareTo">Password and Confirm Password should match.</span>
              </div>
              <div class="row">
                
                <div class="col-xs-12">
                  <button type="submit" ng-disabled="changePasswordForm.$invalid" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>
            </form> 
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/change-password/changePasswordApp.js') }}"></script>
@endsection

