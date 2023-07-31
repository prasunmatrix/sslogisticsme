@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Pay Extra Cash   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Pay Extra Cash</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="extraCashDieselsController" data-ng-init="getCashPlantList();getCashVendorList();">  
      
      <section class="content">
        <!-- Default box -->
        <div class="box">
         <div class="flash-message" ng-hide="msgDisplay">
            @include('common.flash_message') 
            <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
         </div>
          
          <div class="box-header with-border">
            <h3 class="box-title">Pay Extra Cash</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveExtraCash();" id="cashForm" name="cashForm" class="cashForm">
               {{csrf_field()}}
              
              <div class="form-group has-feedback">
                  <label>Date</label>
	              <div class="date taxEnd tripDates">
	                <div class="input-group-addon">
	                  <i class="fa fa-calendar"></i>
	                </div>
	                <input type="text" class="form-control" placeholder="Bill Date" name="billDate" ng-model="billDate" id="billDate" ng-maxlength="255" required readonly/>
	              </div>
	              <span class="invalidInputErrorClass" ng-cloak ng-show="cashForm.tripDate.$touched && cashForm.tripDate.$error.required">The Date is required.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Plant</label>                
                <select ng-model="selectPlant" name="selectPlant" ng-options="plantRecord.id as plantRecord.name for plantRecord in plantRecords" class="form-control" required>
                  <option value="" selected="selected">Select Plant</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="cashForm.selectPlant.$touched && cashForm.selectPlant.$error.required">Please select the Plant</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Vendor</label>
                <select ng-model="company" name="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control" required ng-change="viewCashTruckList(company);">
                  <option value="" selected="selected">Select Vendor</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="cashForm.company.$touched && cashForm.company.$error.required">Please select the Vendor</span>
              </div>

              <div class="form-group has-feedback">
                <label>Select Truck</label>
                <select ng-model="selectTruck" name="selectTruck" ng-options="truckRecord.id as truckRecord.truck_no for truckRecord in truckRecords" class="form-control" required>
                  <option value="" selected="selected">Select Truck</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="cashForm.selectTruck.$touched && cashForm.selectTruck.$error.required">Please select the Truck</span>
              </div>

              <div class="form-group has-feedback">
               <label>Amount</label>
                <input type="text" class="form-control" placeholder="Amount" name="amount" ng-model="amount" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="cashForm.amount.$touched && cashForm.amount.$error.required">The Amount is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="cashForm.amount.$touched && cashForm.amount.$error.pattern">The Amount is invalid.</span>
	         </div>

	         <div class="form-group has-feedback">
              <label>Remarks</label>
                <input type="text" class="form-control" placeholder="Remarks" name="remarks" ng-model="remarks" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="cashForm.remarks.$touched && cashForm.remarks.$error.required">The Remarks is required.</span>
             </div>

             
              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/extra-cash-list>Back</a>
                  <button type="submit" ng-disabled="cashForm.$invalid" class="btn btn-primary">Submit</button>
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

