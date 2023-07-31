@extends('layouts.afterlogintemplate')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Customer Report</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Customer Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="customerReportsController" data-ng-init="getCustomerReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','','');getCustomerVendorList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
       <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
   
     
     
       <form ng-submit="getCustomerReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,challanStatus,pendingPeriod,company,datefilter,dateRangeValue)">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-3"> 
                <label>Customer</label>
                <div class="form-group">
                  <select ng-model="company" name="company" id="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control">
                      <option value="" selected="selected">Select Customer</option>
                  </select>
                </div>            
              </div>
              <div class="col-md-3">
                <label>Challan Status</label>
                <div class="form-group">
                  <select class="form-control" name="challanStatus" ng-model="challanStatus" id="challanStatus">
                    <option value = ''> Select Challan Status </option>
                    <option value = 'All'> ALL </option>
                    <option value = 'OK CHALLAN'> OK CHALLAN </option>
                    <option value = 'UNSTAMPED CHALLAN'> UNSTAMPED CHALLAN </option>
                    <option value = 'STAMPED SHORT CHALLAN'> STAMPED SHORT CHALLAN </option>
                    <option value = 'UNSTAMPED SHORT CHALLAN'> UNSTAMPED SHORT CHALLAN </option>
                    <option value = 'No'> NOT RECEIVED </option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                 <label>Pending Period</label>
                <div class="form-group">
                  <select class="form-control" name="pendingPeriod" ng-model="pendingPeriod" id="pendingPeriod">
                    <option value = ''> Select Pending Period </option>
                    <option value = 'all'> All </option>
                    <option value = '<30'> <30 Days </option>
                    <option value = '30TO90'> 30 to 90 Days </option>
                    <option value = '>90'> >90 Days </option>
                  </select>
                </div>
              </div>
              
              <div class="col-md-3"> 
                <label>Date Range</label>
                <div class="form-group">
                  <input type="text" class="form-control date-picker" name="datefilter" id="datefilter" ng-model="datefilter"/>
                  <input type="hidden" name="dateRangeValue" id="dateRangeValue" ng-model="dateRangeValue">
                </div>            
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-primary" ng-click="getCustomerReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','','');getTripVendorList();clearData();">Reset</button>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </form> 
      <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="flash-message validation-error" id="message" style="display: none;"> 
              <p class="alert alert-danger"></p>
            </div>   
            <div class="align_right">
              <button export-to-csv class="btn btn-primary btn-flat">Export as CSV</button>
              <button type="button" class="btn btn-primary" ng-click="exportToPDF()">Download as PDF</button> 
            </div>   
              <div class="table-responsive no-padding" id="pdfDataHolder">
                <table class="table table-bordered table-hover" id="tableContainer"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr>
                    <th>LR No</th> 
                    <th>Date</th> 
                    <th>MAT</th> 
                    <th>Qty</th> 
                    <th>Shipment</th> 
                    <th>Invoice</th> 
                    <th>Transporter</th> 
                    <th>Truck</th> 
                    <th>Ship to Party</th> 
                    <th>Destination</th> 
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Pending Since</th> 
                  </tr>
                  <tr ng-repeat="row in records" ng-hide="total == 0">
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.lr_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(row.trip_date) | date:'dd/MM/yyyy'}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.item_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.quantity}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.do_shipment_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.invoice_challan_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.vendor_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.party_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.address}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.podFileStatus}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.remarks}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.pending_since}}</td>
                  </tr>
                  <tr ng-hide="total == 0" style="text-align: center;font-size: 20px; background: #BEE8F5">
                    <td colspan="3">Total Quantity</td>
                    <td colspan="4">@{{records[0]['totalQuantity']}}</td>
                    <td colspan="3">No Of Trips</td>
                    <td colspan="3">@{{records[0]['noOfTrips']}}</td>
                  </tr>
                  <tr style="text-align: center;" ng-show="total == 0">
                    <td colspan="13">No Record Found</td>
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
                paging-action="getCustomerReport(page, paginationControl.orderby, paginationControl.ordertype,challanStatus,pendingPeriod,company,datefilter,dateRangeValue)">
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

  <script src="{{ asset('/angularJs/angularModules/vendors/vendorApp.js') }}"></script>
  
@endsection
