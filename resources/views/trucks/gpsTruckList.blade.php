@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>GPS Tracking</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">GPS Tracking</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="trucksController" data-ng-init="getGPSTruckList();">
    
    
      <form ng-submit="trackTruck(selectTruck);" id="truckForm" name="truckForm">
        <div class="box box-default">
          <div class="box-body">
          <div class="select_plant">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label>Select Truck</label>
                  <select ng-model="selectTruck" name="selectTruck" ng-options="truckRecord.truck_no as truckRecord.optionData for truckRecord in truckRecords" class="form-control" required>
                    <option value="" selected="selected">Select Truck</option>
                  </select>
                   <span class="invalidInputErrorClass" ng-show="truckForm.selectTruck.$touched && truckForm.selectTruck.$error.required">Please select the Truck</span>
                </div>
                
                <div class="form-group">
                  <button type="submit" ng-disabled="truckForm.$invalid" class="btn btn-primary">Submit</button>
                </div>
              </div>
              
              </div>
            </div>
          </div>
        </div> 
      </form>

      <!-- result -->
      <div class="box box-default" ng-show="track > 0">
        <div class="newplant">
       
        <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message')  
          <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
          <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
        </div>
       
        <!-- /.box-header -->
          <div class="box-body">
            <iframe src="@{{iFrameURL}}" height="500px" width="100%">
            </iframe>
          </div> 
        </div>
      </div>
      <!-- result -->
      
  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/trucks/truckApp.js') }}"></script>
@endsection
