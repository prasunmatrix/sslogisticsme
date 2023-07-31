@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit State   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit State</li>
        </ol>
      </section>
      <?php //echo '<pre>';print_r($projectList); ?>
      <!-- Main content -->
      
    <div data-ng-controller="statesController" data-ng-init="stateEdit();">
      <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
      </div>
       
      <section class="content">
        <!-- Default box -->
        <div class="box">
          
          <div class="box-header with-border">
            <h3 class="box-title">Edit State</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveState();" id="stateForm" name="stateForm">
               {{csrf_field()}}
              <input type="hidden" name="stateId" ng-model="stateId"> 
              <div class="form-group has-feedback">
                <select ng-model="selectCountry" name="selectCountry" ng-options="record.id as record.country_name for record in records" class="form-control" required>
                  <option value="" selected="selected">Select Country</option>
                </select>
                 <span ng-show="stateForm.selectCountry.$touched && stateForm.selectCountry.$error.required">Please select the Country</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="State Name" name="stateName" ng-model="stateName" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="stateForm.stateName.$touched && stateForm.stateName.$error.required">The State Name is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="State Code" name="stateCode" ng-model="stateCode" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="stateForm.stateCode.$touched && stateForm.stateCode.$error.required">The State Code is required.</span>
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
                  <a href="<?php echo URL('');?>/states" class="btn btn-default btn-flat">Back</a>
                  <button type="submit" ng-disabled="stateForm.$invalid" class="btn btn-primary">Submit</button>
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
  <script src="{{ asset('/angularJs/angularModules/states/stateApp.js') }}"></script>
@endsection

