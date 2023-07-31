@extends('layouts.afterlogintemplate')
@section('content')

<!-- Main content -->
<div class="container">
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit PetrolPump   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit PetrolPump</li>
        </ol>
      </section>
      <!-- Main content -->
      

    <section class="content">
      <!-- Default box -->
      <div class="box" data-ng-controller="petrolPumpsController" data-ng-init="petrolPumpEdit();">
      @include('common.flash_message') 
        
        <div class="box-header with-border">
          <h3 class="box-title">Edit PetrolPump</h3>
          
        </div>
        <div class="box-body">
          <form ng-submit="savePetrolPump();" id="petrolPumpForm" name="petrolPumpForm">
             {{csrf_field()}}
            <input type="hidden" name="petrolPumpId" ng-model="petrolPumpId"> 
            <div class="form-group has-feedback">
              <select ng-model="selectCountry" name="selectCountry" ng-options="record.id as record.country_name for record in records" required ng-change="viewStateList(selectCountry);">
                <option value="" selected="selected">Select Country</option>
              </select>
               <span ng-show="petrolPumpForm.selectCountry.$touched && petrolPumpForm.selectCountry.$error.required">Please select the Country</span>
            </div>

            <div class="form-group has-feedback">
              <select ng-model="selectState" name="selectState" ng-options="stateRecord.id as stateRecord.state_name for stateRecord in stateRecords" required ng-change="viewCityList(selectState);">
                <option value="" selected="selected">Select State</option>
              </select>
               <span ng-show="petrolPumpForm.selectState.$touched && petrolPumpForm.selectState.$error.required">Please select the State</span>
            </div>

            <div class="form-group has-feedback">
              <select ng-model="selectCity" name="selectCity" ng-options="cityRecord.id as cityRecord.city_name for cityRecord in cityRecords" required">
                <option value="" selected="selected">Select City</option>
              </select>
               <span ng-show="petrolPumpForm.selectCity.$touched && petrolPumpForm.selectCity.$error.required">Please select the City</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Petrol Pump Name" name="petrolPumpName" ng-model="petrolPumpName" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.petrolPumpName.$touched && petrolPumpForm.petrolPumpName.$error.required">The PetrolPump Name is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Adress" name="address" ng-model="address" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.address.$touched && petrolPumpForm.address.$error.required">The Address is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber" ng-model="contactNumber" ng-maxlength="20" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactNumber.$touched && petrolPumpForm.contactNumber.$error.required">The Contact Number is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="email" class="form-control" placeholder="Contact Email" name="contactEmail" ng-model="contactEmail" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactEmail.$touched && petrolPumpForm.contactEmail.$error.required">The Contact Email is required.</span>
              <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactEmail.$touched && petrolPumpForm.contactEmail.$invalid">The Contact Email is invalid.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Contact Person" name="contactPerson" ng-model="contactPerson" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactPerson.$touched && petrolPumpForm.contactPerson.$error.required">The Contact Person is required.</span>
            </div>

            <div class="form-group has-feedback">
              <label>Active:- </label>
              <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
            </div>


            <div class="row">
              <div class="col-xs-8">    
                                      
              </div><!-- /.col -->
              <div class="col-xs-4">
               <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/petrolPumps>Back</a>
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
</div>
<!-- /.container -->
@endsection



@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/petrol-pumps/petrolPumpApp.js') }}"></script>
@endsection

