@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Plant Payment</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Plant Payment</li>
    </ol>
  </section>


  <div data-ng-controller="PlantPaymentController" data-ng-init="viewPlantList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
    <section class="content">
      <!-- Default box -->
      <div class="box" >
        
        <div class="box-header with-border">
          <h3 class="box-title">Add Plant Payment</h3>
          
        </div>
        <div class="box-body">
          <form ng-submit="addPlantPayment();" id="PlantPayForm" name="PlantPayForm">
             {{csrf_field()}}
            <div class="form-group has-feedback">
              <label>Select Plant</label>
              <select ng-model="selectPlant" name="selectPlant" ng-options="record.id as record.name for record in records" class="form-control" required>
                <option value="" selected="selected">Select Plant</option>
              </select>
               <span class="invalidInputErrorClass" ng-show="PlantPayForm.selectPlant.$touched && PlantPayForm.selectPlant.$error.required">Please Select Plant</span>
            </div>

            <div class="form-group has-feedback">
              <label>Amount</label>
              <input type="text" ng-model="amount" name="amount" class="form-control" placeholder="Please Enter Amount" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required>
               <span class="invalidInputErrorClass" ng-show="PlantPayForm.amount.$touched && PlantPayForm.amount.$error.required">Please Enter Amount</span>
            </div>

            <div class="form-group has-feedback">
              <label>Description</label>
              <textarea ng-model="description" name="description" class="form-control" placeholder="Please Enter Description" required></textarea>
               <span class="invalidInputErrorClass" ng-show="PlantPayForm.description.$touched && PlantPayForm.description.$error.required">Please Enter Description</span>
            </div>

            <div class="form-group has-feedback">
              <label>Select Entry Type</label>
              <select ng-model="entry_type" name="entry_type" class="form-control" ng-options="type.option as type.value for type in entryType" class="form-control" required>
                <option value="" selected="selected">Select Entry Type</option>
              </select>
               <span class="invalidInputErrorClass" ng-show="PlantPayForm.entry_type.$touched && PlantPayForm.entry_type.$error.required">Please Select Entry Type</span>
            </div>

            <div class="row submit-button-holder">
              <div class="col-xs-8">    
                                      
              </div><!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary">Submit</button>
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
  <script src="{{ asset('/angularJs/angularModules/plants/plantApp.js') }}"></script>
@endsection
