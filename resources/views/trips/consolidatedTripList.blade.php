@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Consolidated Trip</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Consolidated Trip</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="consolidatedTripsController" data-ng-init="getConsolidatedTripVendorList();" ng-click="clearAutoFillContainer();">
    
    
      <form ng-submit="searchTrip();" id="vendorForm" name="vendorForm" class="consolidatedTripForm">
        <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Consolidated Trip</h3>
        </div>
          <div class="box-body">
          <!-- <div class="select_plant"> -->
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group col-md-6 col-sx-12" id="vendorContainer">
                  <label>Select Vendor</label>
                  <!--<select ng-model="selectCompany" name="selectCompany" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control" required ng-change="getConsolidatedTripVendorList();">
                    <option value="" selected="selected">Select Vendor</option>
                  </select>-->

                  <input type="text" class="form-control upperCaseTransform" placeholder="Vendor" name="selectCompany" ng-model="selectCompany" ng-maxlength="255" ng-keyup="complete(selectCompany)" autocomplete="off" required/>

                  <ul class="list-group">
                      <li class="list-group-item" ng-repeat="vendordata in filterVENDOR" ng-click="fillTextbox(vendordata)">@{{vendordata}}</li>
                  </ul>

                   <span class="invalidInputErrorClass" ng-show="vendorForm.selectCompany.$touched && vendorForm.selectCompany.$error.required">Please select the Vendor</span>
                </div>

                <div class="col-md-2 col-sx-12">
                  <div class="form-group has-feedback">
                    <div class="date taxEnd">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <label>Start Date</label>
                        <input type="text" class="form-control" placeholder="Start Date" name="startDate" ng-model="startDate" ng-maxlength="255" />
                        <span>(dd-mm-yyyy)</span>
                    </div>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.startDate.$touched && vendorForm.startDate.$error.required">The Start Date is required.</span>
                  </div>
                </div>

                <div class="col-md-2 col-sx-12">
                  <div class="form-group has-feedback">
                    <div class="date taxEnd">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <label>End Date</label>
                        <input type="text" class="form-control" placeholder="End Date" name="endDate" ng-model="endDate" ng-maxlength="255" start-date="@{{startDate}}" compare-with-start-date />
                        <span>(dd-mm-yyyy)</span>
                    </div>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.endDate.$touched && vendorForm.endDate.$error.required">The  End Date is required.</span>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="(vendorForm.startDate.$touched || vendorForm.endDate.$touched) && vendorForm.endDate.$invalid">The End date must be greater than or equals to Start Date.</span>
                  </div>
                </div>

                <div class="form-group col-md-2 col-sx-12">
                <label class="col-md-12 col-sx-12 labelHeight">&nbsp;</label>
                  <button type="submit" ng-disabled="vendorForm.$invalid" class="btn btn-block btn-primary">Submit</button>
                </div>
              </div>
              
              </div>
            <!-- </div> -->
          </div>
        </div> 
      </form>

      <!-- result -->
      <div class="box box-default" ng-show="recordCount > 0">
        <div class="newplant">
        <h3>@{{plantName}}</h3>
       
        <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message')  
          <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
          <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
        </div>
       
        <!-- /.box-header -->
          <div class="box-body">
              <div ng-show="records[0].checkboxCount > '0' " style="padding-bottom: 10px;">
                <div class="row">
                  <div class="col-md-3"> 
                    <label>Bill Number</label>
                    <div class="form-group">
                      <input type="text" name="billNo" id="billNo" ng-model="billNo" placeholder="Bill Number" class="form-control">
                    </div>            
                  </div>
                  <div class="col-md-3">
                    <label>Challan Exps</label>
                    <div class="form-group">
                      <input type="text" name="challanExps" id="challanExps" ng-model="challanExps" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="numberPattern" placeholder="Challan Exps" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label>TDS</label>
                    <div class="form-group">
                      <select name="tds" id="tds" ng-model="tds" class="form-control">
                          <option value="">Select TDS</option>
                          @for($i=0; $i<=30; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-3"> 
                    <label>&nbsp;</label>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" ng-click="generateBill()">Generate Bill</button>
                      <button type="button" class="btn btn-primary" ng-click="clear()">Reset</button>
                    </div>            
                  </div>
                </div>
              </div>
              <div class="table-responsive no-padding">
                <table class="table table-bordered consolidatedTripTable" id="tableContainer">
                  <tr>
                    <th width="4%">Trip</th>   
                    <th width="6%">Truck</th>           
                    <th width="1%">POD</th>
                    <th width="2%">QTY (MT)</th>
                    <th width="10%">Rate</th>
                    <th width="10%">U/L</th>
                    <th width="10%">Toll</th>
                    <th width="10%">Tare</th>
                    <th width="2%">Short Bags</th>
                    <th width="7%">Short Bag Amount</th>
                    <th width="6%">Freight Charge</th>
                    <th width="4%">ADV</th>
                    <th width="4%">DSL</th>
                    <th width="6%">Balance</th>
                    <th width="3%">Status</th>
                    <th width="3%">Action</th>
                  </tr>
                  <tr ng-repeat="row in records">
                    
                      <td>
                        <span ng-show="row.checkBoxStatus === 'y'" id="tripChckBoxContainer">
                          <input type="checkbox" name="tripChckBox[]" id="tripChckBox_@{{$index}}" value="@{{row.id}}" ng-model="tripChckBox" class="tripCheckbox" >
                          <label for="tripChckBox_@{{$index}}"></label>
                        </span>

                        @{{row.tripName}}
                      </td>
                      <td>@{{row.truck_no}}</td>
                      <td ng-show="row.podFileStatus === 'Yes'"><i class="{{\Config::get('constants.rightIcon')}}" aria-hidden="true" style="color:green;"></i> </td>
                      <td ng-show="row.podFileStatus === 'No'"><i class="{{\Config::get('constants.crossIcon')}}" aria-hidden="true" style="color:red;"></i> </td>
                      <td>@{{row.quantity}}</td>

                      <td><input type="text" class="form-control smallerInput" placeholder="Rate" name="rate" ng-model="row.rate" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/></td>

                      <td><input type="text" class="form-control smallerInput" placeholder="U/L" name="unloading_charge" ng-model="row.unloading_charge" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/></td>

                      <td><input type="text" class="form-control smallerInput" placeholder="Toll" name="toll" ng-model="row.toll" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/></td>

                      

                      <td><input type="text" class="form-control smallerInput" placeholder="Tare" name="tare_charge" ng-model="row.tare_charge" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/></td>

                      <td>@{{row.bags}}</td>

                      <td ng-show="row.podFileStatus === 'Yes'"><input type="text" class="form-control" placeholder="Bag" name="short_bag_amount" ng-model="row.short_bag_amount" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/></td>

                       <td ng-show="row.podFileStatus === 'No'"><input type="text" class="form-control" placeholder="0.00" name="short_bag_amount" ng-model="row.short_bag_amount" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern" readonly="readonly" /></td>

                      <!--<td><input type="text" class="form-control" placeholder="Freight" name="freight_charge" ng-model="row.freight_charge" ng-maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/></td>-->

                      <td>
                        <span id="freight_@{{$index}}"> @{{row.freight_charge}}</span>
                      </td>
                      <td>@{{row.advance_amount}}</td>
                      <td>@{{row.diesel_amount}}</td>
                      <td>
                        <span id="balance_@{{$index}}"> @{{row.balance}}</span>
                      </td> 
                      <td ng-show="row.trip_status === 'Settled'">
                          <a style="cursor: default; pointer-events: none;" class="btn btn-settled">SETTLED</a>
                      </td>
                      </td>
                      <td ng-show="row.trip_status !== 'Settled'">
                        <a style="cursor: default;pointer-events: none;" class="btn btn-unsettled">UNSETTLED </a>
                      </td>
                      <td><button type="button" class="btn btn-primary btn-consolidated-trip-save" ng-click="saveTripPayment(row.id,row.freight_charge,row.toll,row.unloading_charge,row.tare_charge,row.quantity,row.rate,row.advance_amount,row.diesel_amount,row.short_bag_amount,$index)">Save</button></td>
                      
                  </tr>
                  
                  <tr style="text-align: center;" ng-show="(records).length == 0">
                    <td colspan="16"><strong>No Record Found</strong></td>
                  </tr>
                </table>
              </div>
              <div paging
                class="pagination pagination-sm no-margin pull-right"
                page="paginationControl.currentPage" 
                page-size="paginationControl.perPageRecord" 
                total="total"
                show-prev-next="true"
                show-first-last="true"
                paging-action="searchTrip()">
              </div>

          </div> 
        </div>
      </div>
      <!-- result -->
      
  </section>
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
    $('body').addClass('consolidatedContainer');
  </script>  
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection
