@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add Plant Address   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Plant Address</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div  data-ng-controller="plantAddressesController" data-ng-init="viewCountryList();getPlantList();">
      <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
      </div>
      <section class="content">
        <!-- Default box -->
        <div class="box" id="plantAddressHolder">
          
          <div class="box-header with-border">
            <h3 class="box-title">Add PlantAddress</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="savePlantAddress();" id="plantAddressForm" name="plantAddressForm">
               {{csrf_field()}}

              <div class="form-group has-feedback">
                <select ng-model="selectPlant" name="selectPlant" id="selectPlant" ng-options="plantRecord.id as plantRecord.name for plantRecord in plantRecords" class="form-control" required>
                  <option value="" selected="selected">Select Plant</option>
                </select>
                 <span ng-show="plantAddressForm.selectPlant.$touched && plantAddressForm.selectPlant.$error.required">Please select the Plant</span>
              </div>  


              <div class="form-group has-feedback">
                <select ng-model="selectCountry" name="selectCountry" id="selectCountry" ng-options="record.id as record.country_name for record in records" class="form-control" required ng-change="viewStateList(selectCountry);">
                  <option value="" selected="selected">Select Country</option>
                </select>
                 <span ng-show="plantAddressForm.selectCountry.$touched && plantAddressForm.selectCountry.$error.required">Please select the Country</span>
              </div>

              <div class="form-group has-feedback">
                <select ng-model="selectState" name="selectState" id="selectState" ng-options="stateRecord.id as stateRecord.state_name for stateRecord in stateRecords" class="form-control" required ng-change="viewCityList(selectState);">
                  <option value="" selected="selected">Select State</option>
                </select>
                 <span ng-show="plantAddressForm.selectState.$touched && plantAddressForm.selectState.$error.required">Please select the State</span>
              </div>

              <div class="form-group has-feedback">
                <select ng-model="selectCity" name="selectCity" id="selectCity" ng-options="cityRecord.id as cityRecord.city_name for cityRecord in cityRecords" class="form-control" required>
                  <option value="" selected="selected">Select City</option>
                </select>
                 <span ng-show="plantAddressForm.selectCity.$touched && plantAddressForm.selectCity.$error.required">Please select the City</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Address" name="chosenPlace" ng-model="chosenPlace" id="chosenPlace" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantAddressForm.chosenPlace.$touched && plantAddressForm.chosenPlace.$error.required">The Address is required.</span>
              </div>
              
              <div class="form-group has-feedback">
                <input type="hidden" class="form-control" id="lat" placeholder="latitude" name="lat" ng-model="lat" ng-maxlength="100"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantAddressForm.lat.$touched && plantAddressForm.lat.$error.required">The Latitude is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="hidden" class="form-control" id="lng" placeholder="longitude" name="lng" ng-model="lng" ng-maxlength="100"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantAddressForm.lng.$touched && plantAddressForm.lng.$error.required">The Longitude is required.</span>
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
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/plantAddresses>Back</a>
                  <button type="submit" ng-disabled="plantAddressForm.$invalid" class="btn btn-primary">Submit</button>
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
  <script src="{{ asset('/angularJs/angularModules/plant-addresses/plantAddressApp.js') }}"></script>
@endsection

