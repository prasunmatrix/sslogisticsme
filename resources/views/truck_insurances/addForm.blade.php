@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add Truck Insurance   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Truck Insurance</li>
        </ol>
      </section>
      <!-- Main content -->
      

    <section class="content">
      <!-- Default box -->
      <div class="box" data-ng-controller="insurancesController" data-ng-init="getTruckList();">
      @include('common.flash_message') 
        
        <div class="box-header with-border">
          <h3 class="box-title">Add TruckInsurance</h3>
          
        </div>
        <div class="box-body">
          <form ng-submit="saveTruckInsurance();" id="truckInsuranceForm" name="truckInsuranceForm">
             {{csrf_field()}}
            <div class="form-group has-feedback">
              <select ng-model="selectTruck" name="selectTruck" ng-options="record.id as record.truck_no for record in truckRecords" class="form-control" required>
                <option value="" selected="selected">Select Truck</option>
              </select>
               <span ng-show="(truckInsuranceForm.selectType.$touched || submitted)  && truckInsuranceForm.selectType.$error.required">Please select the Type</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Policy Number" name="policyNo" ng-model="policyNo" ng-maxlength="150" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="truckInsuranceForm.policyNo.$touched && truckInsuranceForm.policyNo.$error.required">The Policy Number is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Name" name="name" ng-model="name" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="truckInsuranceForm.name.$touched && truckInsuranceForm.name.$error.required">The Name is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Policy On" name="policyOn" ng-model="policyOn" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="truckInsuranceForm.policyOn.$touched && truckInsuranceForm.policyOn.$error.required">The Policy On is required.</span>
            </div>
            <div id="calendar" style="width: 100%"></div>
            <div class="btn-group">
                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                      <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">Add new event</a></li>
                        <li><a href="#">Clear events</a></li>
                        <li class="divider"></li>
                        <li><a href="#">View calendar</a></li>
                      </ul>
                    </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Policy Start" name="policyStart" ng-model="policyStart" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="truckInsuranceForm.policyStart.$touched && truckInsuranceForm.policyStart.$error.required">The Policy Start is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Policy End" name="policyEnd" ng-model="policyEnd" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="truckInsuranceForm.policyEnd.$touched && truckInsuranceForm.policyEnd.$error.required">The Policy End is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Policy File" name="policyFile" ng-model="policyFile" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="truckInsuranceForm.policyFile.$touched && truckInsuranceForm.policyFile.$error.required">The Policy File is required.</span>
            </div>


            <div class="form-group has-feedback">
              <label>Active:- </label>
              <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
            </div>

          


            <div class="row submit-button-holder">
              <div class="col-xs-8">    
                                      
              </div><!-- /.col -->
              <div class="col-xs-4">
               <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/truckInsurances>Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div><!-- /.col -->
            </div>
          </form> 
        </div><!-- /.box-body -->
        <div class="box-footer">
           
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </section><!-- /.content -->

      <!-- /.content -->

@endsection



@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/truck-insurances/insuranceApp.js') }}"></script>
@endsection

