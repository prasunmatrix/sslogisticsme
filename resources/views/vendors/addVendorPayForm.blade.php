@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Vendor Payment   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Vendor Payment</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="vendorPaymentController" data-ng-init="getVendorList();">  
      <div class="flash-message" ng-hide="msgDisplay">
        @include('common.flash_message')
        <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
        <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
      </div>
      <section class="content">
        <!-- Default box -->
        <div class="box">
          
          <div class="box-header with-border">
            <h3 class="box-title">Add Vendor Payment</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveVendorPay();" id="vendorForm" name="vendorForm" class="cashForm">
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
                <label>Select Vendor</label>
                <select ng-model="company" name="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control" required ng-change="viewCashTruckList(company);">
                  <option value="" selected="selected">Select Vendor</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="vendorForm.company.$touched && vendorForm.company.$error.required">Please select the Vendor</span>
              </div>

              <div class="form-group has-feedback">
               <label>Amount</label>
                <input type="text" class="form-control" placeholder="Amount" name="amount" ng-model="amount" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.amount.$touched && vendorForm.amount.$error.required">The Amount is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.amount.$touched && vendorForm.amount.$error.pattern">The Amount is invalid.</span>
	         </div>

	         <div class="form-group has-feedback">
              <label>Remarks</label>
                <input type="text" class="form-control" placeholder="Remarks" name="remarks" ng-model="remarks" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.remarks.$touched && vendorForm.remarks.$error.required">The Remarks is required.</span>
             </div>

             
              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" ng-disabled="vendorForm.$invalid" class="btn btn-primary">Submit</button>
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
  <script src="{{ asset('/angularJs/angularModules/vendors/vendorApp.js') }}"></script>
@endsection

