@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit Extra Diesel   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit Extra Diesel</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="extraCashDieselsController" data-ng-init="extraDieselEdit();">  
      
      <section class="content">
        <!-- Default box -->
        <div class="box">
         <div class="flash-message" ng-hide="msgDisplay">
            @include('common.flash_message') 
            <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
         </div>
          
          <div class="box-header with-border">
            <h3 class="box-title">Edit Extra Diesel</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveExtraDiesel();" id="dieselForm" name="dieselForm" class="cashForm">
               {{csrf_field()}}
              
              <div class="form-group has-feedback">
                  <label>Date</label>
	              <div class="date taxEnd tripDates">
	                <div class="input-group-addon">
	                  <i class="fa fa-calendar"></i>
	                </div>
	                <input type="text" class="form-control" placeholder="Bill Date" name="billDate" ng-model="billDate" id="billDate" datepickershow ng-maxlength="255" required readonly/>
	              </div>
	              <span class="invalidInputErrorClass" ng-cloak ng-show="dieselForm.tripDate.$touched && dieselForm.tripDate.$error.required">The Date is required.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Plant</label>                
                <select ng-model="selectPlant" name="selectPlant" ng-options="plantRecord.id as plantRecord.name for plantRecord in plantRecords" class="form-control" required>
                  <option value="" selected="selected">Select Plant</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="dieselForm.selectPlant.$touched && dieselForm.selectPlant.$error.required">Please select the Plant</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Vendor</label>
                <select ng-model="company" name="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control" required ng-change="viewCashTruckList(company);">
                  <option value="" selected="selected">Select Vendor</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="dieselForm.company.$touched && dieselForm.company.$error.required">Please select the Vendor</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Truck</label>
                <select ng-model="selectTruck" name="selectTruck" ng-options="truckRecord.id as truckRecord.truck_no for truckRecord in truckRecords" class="form-control" required>
                  <option value="" selected="selected">Select Truck</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="dieselForm.selectTruck.$touched && dieselForm.selectTruck.$error.required">Please select the Truck</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Petrol Pump</label>
                <select ng-model="selectPetrolPump" name="selectPetrolPump" ng-options="petrolPumpRecord.id as petrolPumpRecord.petrol_pump_name for petrolPumpRecord in petrolPumpRecords" class="form-control" required>
                  <option value="" selected="selected">Select Petrol Pump</option>
                </select>
                <span class="invalidInputErrorClass" ng-show="dieselForm.selectPetrolPump.$touched && dieselForm.selectPetrolPump.$error.required">Please select the Petrol Pump</span>
              </div>

              <div class="form-group has-feedback">
               <label>Amount</label>
                <input type="text" class="form-control" placeholder="Amount" name="amount" ng-model="amount" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="dieselForm.amount.$touched && dieselForm.amount.$error.required">The Amount is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="dieselForm.amount.$touched && dieselForm.amount.$error.pattern">The Amount is invalid.</span>
	         </div>

	         <div class="form-group has-feedback">
              <label>Remarks</label>
                <input type="text" class="form-control" placeholder="Remarks" name="remarks" ng-model="remarks" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="dieselForm.remarks.$touched && dieselForm.remarks.$error.required">The Remarks is required.</span>
             </div>

             
              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/extra-diesel-list>Back</a>
                  <button type="submit" ng-disabled="dieselForm.$invalid" class="btn btn-primary">Submit</button>
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
  <script type="text/javascript">
  	var date      = new Date();
    var today     = new Date(date.getFullYear(), date.getMonth(), date.getDate()); /*get today*/
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";

    /*setting trip date 1 day prior to current date*/
    $.fn.datepicker.defaults.startDate  = "-19y";
    $.fn.datepicker.defaults.endDate    = "+19y";


    /*set today as default date in datepicker*/
    $('.date').datepicker();
    $('.date').datepicker('setDate', today);
  </script>
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection

