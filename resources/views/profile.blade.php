@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile page
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profile page</li>
      </ol>
    </section>

    <!-- Main content -->
    <div data-ng-controller="profileController" data-ng-init="getAdminProfileData();">
      <div class="flash-message"  ng-hide="msgDisplay">  
        @include('common.flash_message') 
        <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
        <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
      </div>

      <section class="content">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              Profile 
              <span ng-show="lastLoginIP != '' || lastLoginDateTime != ''">( </span>
                <span ng-show="lastLoginIP != ''">Last Login IP :- <span ng-view="lastLoginIP" ng-bind="lastLoginIP"></span> , </span>
                <span ng-show="lastLoginDateTime != ''">Last Login Date Time :- <span>@{{lastLoginDateTime | date:'dd-MM-YYYY HH:mm:ss'}}</span> </span> 
              <span ng-show="lastLoginIP != '' || lastLoginDateTime != ''">)</span>
            </h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="adminProfile();" id="profileForm" name="profileForm" enctype="multipart/form-data">
               {{csrf_field()}}

              <div class="form-group has-feedback">
                <label>Full Name</label>
                <input type="text" class="form-control" placeholder="Full Name" name="fullName" ng-model="fullName" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="profileForm.fullName.$touched && profileForm.fullName.$error.required">The Name is required.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Phone Number</label>
                <input type="text" class="form-control" placeholder="Phone Number" name="phoneNumber" ng-model="phoneNumber" ng-minlength="4" ng-maxlength="15" ng-pattern="phoneNumberPattern" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="profileForm.phoneNumber.$touched && profileForm.phoneNumber.$error.required">The Phone Number is invalid.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="profileForm.phoneNumber.$touched && profileForm.phoneNumber.$invalid">Please provide valid Phone Number.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Profile Picture</label>
                <input type = "file" file-model = "myFile"/>
                  <input type="hidden" class="form-control" name="profilePictureName" id="profilePictureName" ng-model="profilePictureName">
                  <img ng-src="@{{profilePicture}}" height="100" width="100">
              </div>

              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" ng-disabled="profileForm.$invalid" id="profile_submit" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>
            </form> 
            
           <!--  <div class="row">
              <div class="form-group has-feedback">
                  <div class="col-lg-4 col-md-4">
                    <slim data-size="200,200"
                          data-download="true"
                          data-initial-image="@{{profilePicture}}"
                          data-service="slim.service"
                          data-did-init="slim.init">
                        <input type="file" name="slim[]"/>
                    </slim>
                  </div>                
                </div>
            </div> -->
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->
    </div>

    
@endsection

@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/profile/profileApp.js') }}"></script>     
@endsection