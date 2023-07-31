@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit Vendor   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit Vendor</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="vendorsController" data-ng-init="vendorEdit();getQueryString()">  
      
      <section class="content">
        <!-- Default box -->
        <div class="box">
         <div class="flash-message" ng-hide="msgDisplay">
            @include('common.flash_message') 
            <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
         </div>
          
          <div class="box-header with-border">
            <h3 class="box-title">Edit Vendor</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveVendor();" id="vendorForm" name="vendorForm">
               {{csrf_field()}}
               <input type="hidden" name="vendorId" ng-model="vendorId"> 
              
              <div class="form-group has-feedback">
                <label>Vendor Name</label>
                <input type="text" class="form-control upperCaseTransform" placeholder="Vendor Name" name="vendorName" ng-model="vendorName" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.vendorName.$touched && vendorForm.vendorName.$error.required">The Vendor Name is required.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Contact Person</label>
                <input type="text" class="form-control upperCaseTransform" placeholder="Contact Person" name="contactPerson" ng-model="contactPerson" ng-maxlength="255"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactPerson.$touched && vendorForm.contactPerson.$error.required">The Contact Person is required.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Contact Number</label>
                <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber" ng-model="contactNumber" maxlength="10" ng-pattern="phoneNumberPattern" onkeypress="return keyRestrict(event,'1234567890')"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactNumber.$touched && vendorForm.contactNumber.$error.required">The Contact Number is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactNumber.$touched && vendorForm.contactNumber.$error.pattern">The Contact Number is invalid.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Contact Email</label>
                <input type="email" class="form-control" placeholder="Contact Email" name="contactEmail" ng-model="contactEmail" ng-maxlength="255" ng-pattern="emailPattern"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactEmail.$touched && vendorForm.contactEmail.$invalid">The Contact Email is invalid.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Pan Number</label>
                <input type="text" class="form-control upperCaseTransform" placeholder="Pan Number" name="panNumber" ng-model="panNumber" ng-maxlength="255" ng-pattern="panNumberPattern" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.panNumber.$touched && vendorForm.panNumber.$error.required">The Pan Number is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.panNumber.$touched && vendorForm.panNumber.$invalid">The Pan Number is invalid.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Bank Name</label>
              
                <!--<select ng-model="selectBank" name="selectBank" id="selectBank" ng-options="bankRecord.id as bankRecord.name for bankRecord in bankRecords" class="form-control" required ng-change="bankChanged();getBankifscDetails(selectBank);">-->
                <select ng-model="selectBank" id="selectBank" name="selectBank" ng-options="bankRecord.id as bankRecord.name for bankRecord in bankRecords" class="form-control" required>
                  <option value="" selected="selected">Select Bank</option>
                </select>
                <input type="hidden" name="bankNameChange" ng-model="bankNameChange" id="bankNameChange">

                <span class="invalidInputErrorClass" ng-show="vendorForm.selectBank.$touched && vendorForm.selectBank.$error.required">Please select the Bank</span>
              </div>

              <div class="form-group has-feedback">
                <label>IFSC Code</label>
                <input type="text" class="form-control" placeholder="IFSC Code" name="ifsc" ng-model="ifsc" ng-maxlength="255" required/>

                <!--<ul class="list-group">
                    <li class="list-group-item" ng-repeat="ifscdata in filterIFSC" ng-click="fillTextbox(ifscdata)">@{{ifscdata}}</li>
                </ul>-->

                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.ifsc.$touched && vendorForm.ifsc.$error.required">The IFSC Code is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.ifsc.$touched && vendorForm.ifsc.$invalid">The IFSC Code is invalid.</span>
              </div>


              <div class="form-group has-feedback">
                <label>Account Number</label>
                <input type="text" class="form-control" placeholder="Account Number" name="accountNo" ng-model="accountNo" ng-maxlength="255" ng-pattern="bankAccNoPattern" onkeypress="return keyRestrict(event,'1234567890')" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.accountNo.$touched && vendorForm.accountNo.$error.required">The Account Number is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.accountNo.$touched && vendorForm.accountNo.$error.pattern">The Account Number is invalid.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Account Holder Name</label>
                <input type="text" class="form-control upperCaseTransform" placeholder="Account Holder Name" name="accountHolderName" ng-model="accountHolderName" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.accountHolderName.$touched && vendorForm.accountHolderName.$error.required">The Account Holder Name is required.</span>
              </div>


              <div class="form-group has-feedback">
                <div class="active_checkbox">
                  <label>Active:- </label>
                  <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
                </div>
                <input type="hidden" ng-model="addNew" name="addNew">
              </div>
              

              <input type="hidden" name="currentPageNo" id="currentPageNo" ng-model="currentPageNo">


              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/vendors>Back</a>
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
  <script src="{{ asset('/angularJs/angularModules/vendors/vendorApp.js') }}"></script>
@endsection

