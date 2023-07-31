@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit Truck   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit Truck</li>
        </ol>
      </section>
      
      <!-- Main content -->
      
    <div data-ng-controller="trucksController" data-ng-init="truckEdit();getAllVendorList();selectVendor();">
      <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
       </div>
      <section class="content">
        <!-- Default box -->
        <div class="box">
        @include('common.flash_message') 
         
          <div class="box-header with-border">
            <h3 class="box-title">Edit Truck</h3>
            
          </div>
          <div class="box-body truckfrm">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a rel="#ownerInfo">Owner's Info</a></li>
                  <li><a rel="#truckInfo">Truck Info</a></li>
                  <li ng-show="company==='SSLogistics'"><a rel="#permits">Permits</a></li>
                  <li ng-show="company==='SSLogistics'"><a rel="#insurance">Insurance</a></li>
                  <li ng-show="company==='SSLogistics'"><a rel="#tax">Tax</a></li>
                  <li ng-show="company==='SSLogistics'"><a rel="#pollution">Pollution</a></li>
                </ul>
                <form ng-submit="saveTruck();" id="truckForm" name="truckForm">
                  <div class="tab-content">


                    <!-- Owner's Info -->
                    <div class="tab-pane active" id="ownerInfo">
                    <div class="box-body">
                      <div class="row">
                        {{csrf_field()}}
                        <input type="hidden" name="truckId" ng-model="truckId"> 

                        <div class="col-md-10 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Select Vendor</label>
                              <input type="text" name="company" id="company" ng-model="company" ng-keyup="complete(company)" class="form-control" required />
                                <ul class="list-group">
                                  <li class="list-group-item" ng-repeat="companydata in filterCompany" ng-click="fillTextbox(companydata)">@{{companydata}}</li>
                                </ul>
                                <span class="invalidInputErrorClass" ng-show="truckForm.company.$touched && truckForm.company.$error.required">Please select the Vendor</span>
                          </div>
                        </div>
                        <div class="submit-button-holder col-md-2 col-xs-12">
                          <label class="labelHeight">&nbsp;</label>
                           <a class="btn btn-primary btn-block nxtTab" ng-disabled="truckForm.company.$invalid" href="">Next</a>
                        </div>



                        <div class="col-md-12 col-xs-12">
                        <input type="hidden" ng-model="selectType" name="selectType" id="selectType">
                        <hr>
                        <h3 class="row"><label class="col-md-12 col-xs-12">OR</label></h3>
                        <div class="row">
                          <div class="col-md-4 col-xs-12">
                            <a href="{{ asset('/view-vendor-add-form') }}?q=addNew" class="btn btn-primary">Add New Vendor</a>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="active_checkbox col-xs-12 labelwithcheck">
                            <label>Active:- </label>
                            <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
                          </div>
                        </div>
                        </div>

                        </div>
                      </div>
                    </div><!-- /.tab-pane -->

                    <!-- Truck Info -->
                    <div class="tab-pane" id="truckInfo">
                        <div class="form-group has-feedback">
                          <label>Truck Number</label>
                          <input type="text" class="form-control upperCaseTransform" placeholder="Truck Number" name="truckNo" ng-model="truckNo" ng-maxlength="150" ng-pattern="truckNumberPattern" required/>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.truckNo.$touched && truckForm.truckNo.$error.required">The Truck Number is required.</span>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.truckNo.$touched && truckForm.truckNo.$error.pattern">The Truck Number is invalid. It must be in the format like "WB-12E-1234" OR "WB-12-1234".</span>
                        </div>

                        <!--<div class="form-group has-feedback">
                          <label>Registration Number</label>
                          <input type="text" class="form-control upperCaseTransform" placeholder="Registration Number" name="regNo" ng-model="regNo" ng-maxlength="150"/>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.regNo.$touched && truckForm.regNo.$error.required">The Registration Number is required.</span>
                        </div>-->

                        
                        <div class="row" ng-show="company==='SSLogistics'">
                        <div class="form-group has-feedback col-sm-6">
                          <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Registered On</label>
                            <input type="text" class="form-control" placeholder="Registered On" name="registeredOn" ng-model="registeredOn" datepickershow ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                          </div>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.registeredOn.$touched && truckForm.registeredOn.$error.required">The Registered On is required.</span>
                        </div>

                        
                        <div class="form-group has-feedback col-sm-6">
                          <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Registered End</label>
                            <input type="text" class="form-control" placeholder="Registration End" name="registrationEnd" datepickershow ng-model="registrationEnd" ng-maxlength="255" start-date="@{{registeredOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                          </div>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.registrationEnd.$touched && truckForm.registrationEnd.$error.required">The Registration End is required.</span>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.registrationEnd.$touched || truckForm.registrationOn.$touched) && truckForm.registrationEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                        </div>                      

                        </div>

                        <div class="form-group has-feedback">
                           <label>Registration File</label>
                           <input type="file" class="form-control" id ="registrationFile" ng-model="registrationFile" file-model="registrationFile"/>
                           <span ng-view='registrationFileName' ng-cloak ng-bind='registrationFileName'></span>
                           <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.registrationFile.$touched && truckForm.registrationFile.$error.required">The Registration File is required.</span>
                        </div>

                        <div class="row submit-button-holder">
                          <div class="col-xs-8"> </div>   
                          <div class="col-xs-4">
                           <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                           <a class="btn btn-primary nxtTab" ng-disabled="truckForm.truckNo.$invalid || truckForm.regNo.$invalid || truckForm.registeredOn.$invalid || truckForm.registrationEnd.$invalid" ng-show="company==='SSLogistics'" href="">Next</a>
                           <button type="submit" ng-disabled="truckForm.$invalid" ng-hide="company==='SSLogistics'" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                    </div><!-- /.tab-pane -->

                    <!-- Permit Info -->
                    <div class="tab-pane" id="permits" ng-show="company==='SSLogistics'">
                      <div class="form-group has-feedback">
                        <label>Permit Number</label>
                        <input type="text" class="form-control upperCaseTransform" placeholder="Permit Number" name="permitNo" ng-model="permitNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitNo.$touched && truckForm.permitNo.$error.required">The Permit Number is required.</span>
                      </div>

                      <div class="row">
                      <div class="form-group has-feedback col-sm-6">
                        <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Permit On</label>
                            <input type="text" class="form-control" placeholder="Permit On" name="permitOn" ng-model="permitOn" datepickershow ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                        </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitOn.$touched && truckForm.permitOn.$error.required">The Permit On is required.</span>
                      </div>

                      <div class="form-group has-feedback col-sm-6">
                        <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Permit End</label>
                            <input type="text" class="form-control" placeholder="Permit End" name="permitEnd" ng-model="permitEnd" ng-maxlength="255" datepickershow start-date="@{{permitOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                        </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitEnd.$touched && truckForm.permitEnd.$error.required">The Permit End is required.</span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.permitOn.$touched || truckForm.permitEnd.$touched) && truckForm.permitEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                      </div>
                      
                      </div>

                      <div class="form-group has-feedback">
                        <label>Permit File</label>
                        <input type="file" class="form-control" id ="permitFile" ng-model="permitFile" file-model="permitFile"/>
                        <span ng-view='permitFileName' ng-cloak ng-bind='permitFileName'></span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitFile.$touched && truckForm.permitFile.$error.required">The Permit File is required.</span>
                      </div>

                      <div class="row submit-button-holder">
                        <div class="col-xs-8"> </div>   
                        <div class="col-xs-4">
                         <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                         <a class="btn btn-primary nxtTab" ng-disabled="truckForm.permitNo.$invalid ||  truckForm.permitOn.$invalid || truckForm.permitEnd.$invalid" href="">Next</a>
                        </div>
                      </div>
                    </div>

                    <!-- Insurance Info -->
                    <div class="tab-pane" id="insurance" ng-show="company==='SSLogistics'">
                      <div class="form-group has-feedback">
                        <label>Policy Number</label>
                        <input type="text" class="form-control upperCaseTransform" placeholder="Policy Number" name="policyNo" ng-model="policyNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyNo.$touched && truckForm.policyNo.$error.required">The Policy Number is required.</span>
                      </div>

                      <div class="row">
                      <div class="form-group has-feedback col-sm-6">
                        <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Policy On</label>
                            <input type="text" class="form-control" placeholder="Policy On" name="policyOn" ng-model="policyOn" ng-maxlength="255" datepickershow ng-required="company==='SSLogistics'"/>
                        </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyOn.$touched && truckForm.policyOn.$error.required">The Policy On is required.</span>
                      </div>

                      <div class="form-group has-feedback col-sm-6">
                        <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Policy End</label>
                            <input type="text" class="form-control" placeholder="Policy End" name="policyEnd" ng-model="policyEnd" ng-maxlength="255" datepickershow start-date="@{{policyOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                        </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyEnd.$touched && truckForm.policyEnd.$error.required">The Policy End is required.</span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.policyOn.$touched || truckForm.policyEnd.$touched) && truckForm.policyEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                      </div>
                      </div>

                      <div class="form-group has-feedback">
                        <label>Policy File</label>
                        <input type="file" class="form-control" id ="insuranceFile" ng-model="insuranceFile" file-model="insuranceFile"/>
                        <span ng-view='insuranceFileName' ng-cloak ng-bind='insuranceFileName'></span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyFile.$touched && truckForm.policyFile.$error.required">The Policy File is required.</span>
                      </div>

                      <div class="row submit-button-holder">
                        <div class="col-xs-8"> </div>   
                        <div class="col-xs-4">
                         <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                         <a class="btn btn-primary nxtTab" href="" ng-disabled="truckForm.policyNo.$invalid ||  truckForm.policyOn.$invalid || truckForm.policyEnd.$invalid">Next</a>
                        </div>
                      </div>
                    </div>

                    <!-- Tax Info -->
                    <div class="tab-pane" id="tax" ng-show="company==='SSLogistics'">
                      <div class="form-group has-feedback">
                        <label>Invoice Number</label>
                        <input type="text" class="form-control upperCaseTransform" placeholder="Invoice Number" name="invoiceNo" ng-model="invoiceNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.invoiceNo.$touched && truckForm.invoiceNo.$error.required">The Invoice Number is required.</span>
                      </div>

                      <div class="row">
                      <div class="form-group has-feedback col-sm-6">
                        <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Tax Paid Date</label>
                            <input type="text" class="form-control" datepickershow placeholder="Tax Paid Date" name="taxPaidDate" ng-model="taxPaidDate" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                        </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.taxPaidDate.$touched && truckForm.taxPaidDate.$error.required">The Tax On is required.</span>
                      </div>

                      <div class="form-group has-feedback col-sm-6">
                          <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Tax Period End</label>
                            <input type="text" class="form-control" placeholder="Tax Period End" name="taxEnd" ng-model="taxEnd" ng-maxlength="255" datepickershow start-date="@{{taxStart}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                          </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.taxEnd.$touched && truckForm.taxEnd.$error.required">The Tax Period End is required.</span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.taxPaidDate.$touched || truckForm.taxEnd.$touched) && truckForm.taxEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                      </div>
                      </div>

                      <div class="form-group has-feedback">
                        <label>Tax File</label>
                        <input type="file" class="form-control" id ="taxFile" ng-model="taxFile" file-model="taxFile"/>
                        <span ng-view='taxFileName' ng-cloak ng-bind='taxFileName'></span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.taxFile.$touched && truckForm.taxFile.$error.required">The Tax File is required.</span>
                      </div>

                      <div class="row submit-button-holder">
                        <div class="col-xs-8"> </div>   
                        <div class="col-xs-4">
                         <a class="btn btn-default btn-flat prvTab" href="" >Previous</a>
                         <a class="btn btn-primary nxtTab" href="" ng-disabled="truckForm.invoiceNo.$invalid ||  truckForm.taxPaidDate.$invalid || truckForm.taxEnd.$invalid">Next</a>
                        </div>
                      </div>
                    </div>

                    <!-- Pollution Info -->
                    <div class="tab-pane" id="pollution" ng-show="company==='SSLogistics'">
                      <div class="form-group has-feedback">
                        <label>Pollution Number</label>
                        <input type="text" class="form-control upperCaseTransform" placeholder="Pollution Number" name="pollutionNo" ng-model="pollutionNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionNo.$touched && truckForm.pollutionNo.$error.required">The Pollution Number is required.</span>
                      </div>

                      <div class="row">
                      <div class="form-group has-feedback col-sm-6">
                        <div class="date taxEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Pollution On</label>
                            <input type="text" class="form-control" datepickershow placeholder="Pollution On" name="pollutionOn" ng-model="pollutionOn" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                        </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionOn.$touched && truckForm.pollutionOn.$error.required">The Pollution On is required.</span>
                      </div>

                      <div class="form-group has-feedback col-sm-6">
                          <div class="date pollutionEnd">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <label>Pollution End</label>
                            <input type="text" class="form-control" placeholder="Pollution End" name="pollutionEnd" ng-model="pollutionEnd" ng-maxlength="255" datepickershow start-date="@{{pollutionOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                          </div>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionEnd.$touched && truckForm.pollutionEnd.$error.required">The Pollution End is required.</span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.pollutionOn.$touched || truckForm.pollutionEnd.$touched) && truckForm.pollutionEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                      </div>
                      </div>

                      <div class="form-group has-feedback">
                        <label>Pollution File</label>
                        <input type="file" class="form-control" id ="pollutionFile" ng-model="pollutionFile" file-model="pollutionFile"/>
                        <span ng-view='pollutionFileName' ng-cloak ng-bind='pollutionFileName'></span>
                        <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionFile.$touched && truckForm.pollutionFile.$error.required">The Pollution File is required.</span>
                      </div>


                      <div class="row submit-button-holder">
                        <div class="col-xs-8"> </div>   
                        <div class="col-xs-4">
                         <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                         <button type="submit" ng-disabled="truckForm.$invalid" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                  </div><!-- /.tab-content -->
                  <hr/>
                  <div class="row">
                      <div class="col-md-12 col-xs-12" style="text-align:left;">  
                        <a href=<?php echo url(''); ?>/trucks class="btn btn-default btn-flat">Back</a>
                      </div>
                  </div>                                                                                                <input type="hidden" name="currentPageNo" id="currentPageNo" ng-model="currentPageNo">                             
                </form> 
              </div>              
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

    /*setting trip date 1 day prior to current date*/
    $.fn.datepicker.defaults.startDate  = "-19y";
    $.fn.datepicker.defaults.endDate    = "+19y";


    /*next button functionality*/
    $('.nxtTab').click(function(){
      var current = $('.nav-tabs li.active');
      current.next('li').click();
      current.removeClass('active');
      current.next('li').addClass('active');
      var target = $('.nav-tabs li.active a').attr('rel');
      $('.tab-pane').removeClass('active');
      $(target).addClass('active');
    });



    /*previous button functionality*/
    $('.prvTab').click(function(){
      var current = $('.nav-tabs li.active');
      current.prev('li').click();
      current.removeClass('active');
      current.prev('li').addClass('active');
      var target = $('.nav-tabs li.active a').attr('rel');
      $('.tab-pane').removeClass('active');
      $(target).addClass('active');
    });
  </script>
  <script src="{{ asset('/angularJs/angularModules/trucks/truckApp.js') }}"></script>
@endsection

