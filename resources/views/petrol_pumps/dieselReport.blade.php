@extends('layouts.afterlogintemplate')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Diesel Report</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Diesel Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="dieselReportsController" data-ng-init="getDieselReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','',''); getDieselReportPetrolPumpList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
       <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
   
     
     
      <form ng-submit="getDieselReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,petrolPump,datefilter,dateRangeValue,1)">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
             
              <div class="col-md-4"> 
                <label>Petrol Pump</label>
                <div class="form-group">
                  <select ng-model="petrolPump" name="petrolPump" id="petrolPump" ng-options="petrolPumpRecord.id as petrolPumpRecord.petrol_pump_name for petrolPumpRecord in petrolPumpRecords" class="form-control">
                      <option value="" selected="selected">Select Petrol Pump</option>
                  </select>
                </div>            
              </div>
              <div class="col-md-4"> 
                <label>Date Range</label>
                <div class="form-group">
                  <input type="text" class="form-control date-picker" name="datefilter" id="datefilter" ng-model="datefilter"/>
                  <input type="hidden" name="dateRangeValue" id="dateRangeValue" ng-model="dateRangeValue">
                </div>            
              </div>
              <div class="col-md-4">
                <label>&nbsp;</label>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-primary" ng-click="getDieselReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','');getDieselReportPetrolPumpList();clearData();">Reset</button>
                </div>
              </div>
            </div>
           
          </div>
        </div> 
      </form>
      <div class="box box-default" ng-show="recordCount > 0">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="flash-message validation-error" id="message" style="display: none;"> 
              <p class="alert alert-danger"></p>
            </div> 
            <div class="align_left">
              <label>Last Day Balance : </label> Rs. @{{balanceLastDay}}<br>
              <label>Today Purchase : </label> Rs. @{{todaysPurchase}}<br>
              <label>Today Payment : </label> Rs. @{{todaysPayment}}<br>
            </div>    
            <div class="align_right" ng-hide="total == 0">
              <button export-to-csv class="btn btn-primary btn-flat">Export as CSV</button>
              <button type="button" class="btn btn-primary" ng-click="exportToPDF(records)">Download as PDF</button> 
            </div>   
              <div class="table-responsive no-padding" id="pdfDataHolder">
                <table id="hiddenTable" style="display: none;">
                  <tr style="display: none;" class="hiddenHeading">
                    <th>created_at</th> 
                    <th>diesel_slip</th> 
                    <th>petrol_pump_name</th> 
                    <th>truck_owner</th> 
                    <th>payment</th> 
                    <th>purchase</th> 
                    <th>balance</th> 
                    <th>plant_name</th> 
                    <th>truck_no</th> 
                  </tr>
                </table>
                <input type="hidden" class="carryForwardContainer" ng-model="carryForwardContainer" id="carryForwardContainer">
                <table class="table table-bordered table-hover" id="tableContainer"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr class="actualHeading">
                    <th>Date</th> 
                    <th>Diesel Slip</th> 
                    <th>Pump Name</th> 
                    <th>Truck Owner</th> 
                    <th>Payment</th> 
                    <th>Purchase</th> 
                    <th>Balance (Rs)</th> 
                    <th>Plant Name</th> 
                    <th>Truck No</th> 
                  </tr>
                  <!-- Showing carry forward balance-->
                  <tr>
                    <td>-</td>
                    <td>-</td>
                    <td><b>@{{pumpName}}</b></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><b>@{{carryForwardBalance}} ( CARRY FORWARD )</b></td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  <!-- Showing carry forward balance-->
                  <tr ng-repeat="row in records" ng-hide="total == 0">
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(row.created_at)|date:'dd/MM/yyyy'}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.diesel_slip}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.petrol_pump_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck_owner}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.payment}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.purchase}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.balance}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.plant_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck_no}} </td>
                  </tr>
                  <tr class="balanceCalculator" style="text-align: center;font-size: 20px; background: #BEE8F5" ng-hide="total == 0">
                    <td colspan="4">Total</td>
                    <td>@{{records[0]['totalPayment']}}</td>
                    <td>@{{records[0]['totalPurchase']}}</td>
                    <td class="balanceData">@{{records[0]['remainingBalance']}}</td>
                    <td colspan="2"></td>
                  </tr>
                  <tr style="text-align: center;" ng-show="total == 0">
                    <td colspan="9">No Record Found</td>
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
                paging-action="getDieselReport(page, paginationControl.orderby, paginationControl.ordertype,petrolPump,datefilter,dateRangeValue,1)">
              </div> 
        </div> 
      </div>
  </section>
  <!-- /.content -->
@endsection
@section('scripts')
  <script type="text/javascript">
    $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));

        var scope = angular.element(document.getElementById("dateRangeValue")).scope();
        scope.dateRangeValue = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
  </script>

  <script src="{{ asset('/angularJs/angularModules/petrol-pumps/petrolPumpApp.js') }}"></script>
  
@endsection
