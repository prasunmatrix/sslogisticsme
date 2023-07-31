@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Petrolpump Laser</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Petrolpump Laser</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="PetrolpumpLaserController" data-ng-init="viewPetrolpumpList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
    
      <form ng-submit="searchPetrolpumpLaser(<?php echo date('Y');?>,'');" id="PetrolpumpLaserForm" name="PetrolpumpLaserForm">
        <div class="box box-default">
          <div class="box-body">
          <div class="select_plant">
            <div class="row">
              <div class="col-xs-9">
                <div class="form-group">
                <label>Select Petrol Pump</label>
                  <select ng-model="selectPetrolpump" name="selectPetrolpump" ng-options="record.id as record.petrol_pump_name for record in records" class="form-control" required>
                    <option value="" selected="selected">Select Petrol Pump</option>
                  </select>
                   <span class="invalidInputErrorClass" ng-show="PetrolpumpLaserForm.selectPetrolpump.$touched && PetrolpumpLaserForm.selectPetrolpump.$error.required">Please Select Petrol Pump</span>
                </div>
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <button type="submit" ng-disabled="PetrolpumpLaserForm.$invalid" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div> 
      </form>
      
  </section>
  <!-- /.content -->


@endsection


@section('scripts')
<script src="{{ asset('/angularJs/angularModules/petrol-pumps/petrolPumpApp.js') }}"></script>
@endsection
