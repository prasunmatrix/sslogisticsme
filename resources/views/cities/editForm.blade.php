@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit City   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit City</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="citiesController" data-ng-init="cityEdit();"  >
     <div class="flash-message" ng-hide="msgDisplay">
        @include('common.flash_message') 
        <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
     </div>
      <section class="content">
        <!-- Default box -->
        <div class="box">
          
          <div class="box-header with-border">
            <h3 class="box-title">Edit City</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveCity();" id="cityForm" name="cityForm">
               {{csrf_field()}}
              <input type="hidden" name="cityId" ng-model="cityId"> 
              <div class="form-group has-feedback">
                <select ng-model="selectCountry" name="selectCountry" ng-options="record.id as record.country_name for record in records" class="form-control" required ng-change="viewStateList(selectCountry);">
                  <option value="" selected="selected">Select Country</option>
                </select>
                 <span ng-show="cityForm.selectCountry.$touched && cityForm.selectCountry.$error.required">Please select the Country</span>
              </div>


              <div class="form-group has-feedback">
                <select ng-model="selectState" name="selectState" ng-options="stateRecord.id as stateRecord.state_name for stateRecord in stateRecords" class="form-control" required>
                  <option value="" selected="selected">Select State</option>
                </select>
                 <span ng-show="cityForm.selectState.$touched && cityForm.selectState.$error.required">Please select the State</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="City Name" name="cityName" ng-model="cityName" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="cityForm.cityName.$touched && cityForm.cityName.$error.required">The City Name is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="City Code" name="cityCode" ng-model="cityCode" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="cityForm.cityCode.$touched && cityForm.cityCode.$error.required">The City Code is required.</span>
              </div>

              <div class="form-group has-feedback">
                <div class="active_checkbox">
                  <label>Active:- </label>
                  <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
                </div>
              </div>


              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <a href="<?php echo URL('');?>/cities" class="btn btn-default btn-flat">Back</a>
                  <button type="submit" ng-disabled="cityForm.$invalid" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>
            </form> 
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->
    </div>

      <!-- /.content -->

@endsection



@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/cities/cityApp.js') }}"></script>
@endsection

