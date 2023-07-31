@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Petrol Pump Payment</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Petrol Pump Payment</li>
    </ol>
  </section>


  <div data-ng-controller="PetrolpumpPaymentController" data-ng-init="viewPetrolpumpList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
    <section class="content">
      <!-- Default box -->
      <div class="box" >
        
        <div class="box-header with-border">
          <h3 class="box-title">Pay to Petrol Pump</h3>
          
        </div>
        <div class="box-body">
          <form ng-submit="addPetrolpumpPayment();" id="PetrolpumpPayForm" name="PetrolpumpPayForm">
             {{csrf_field()}}
            <div class="form-group has-feedback">
              <label>Select Petrol Pump</label>
              <select ng-model="selectPetrolpump" name="selectPetrolpump" ng-options="record.id as record.petrol_pump_name for record in records" class="form-control" required>
                <option value="" selected="selected">Select Petrol Pump</option>
              </select>
               <span class="invalidInputErrorClass" ng-show="PetrolpumpPayForm.selectPetrolpump.$touched && PetrolpumpPayForm.selectPetrolpump.$error.required">Please Select Petrol Pump</span>
            </div>

            <div class="form-group has-feedback">
              <label>Amount</label>
              <input type="text" ng-model="amount" name="amount" class="form-control" placeholder="Please Enter Amount" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required>
               <span class="invalidInputErrorClass" ng-show="PetrolpumpPayForm.amount.$touched && PetrolpumpPayForm.amount.$error.required">Please Enter Amount</span>
            </div>

            <div class="form-group has-feedback">
              <label>Description</label>
              <textarea ng-model="description" name="description" class="form-control" placeholder="Please Enter Description" required></textarea>
               <span class="invalidInputErrorClass" ng-show="PetrolpumpPayForm.description.$touched && PetrolpumpPayForm.description.$error.required">Please Enter Description</span>
            </div>

            <div class="row submit-button-holder">
              <div class="col-xs-8">    
                                      
              </div><!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" ng-disabled="PetrolpumpPayForm.$invalid" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('/angularJs/angularModules/petrol-pumps/petrolPumpApp.js') }}"></script>
@endsection
