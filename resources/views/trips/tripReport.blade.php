@extends('layouts.afterlogintemplate')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Trip Report</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Trip Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="tripReportsController" data-ng-init="getTripReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','','');getTripVendorList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
       <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
   
     
     
       <form ng-submit="getTripReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,tripStatus,timePeriod,company,datefilter,dateRangeValue)">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <label>Trip Status</label>
                <div class="form-group">
                  <select class="form-control" name="tripStatus" ng-model="tripStatus" id="tripStatus">
                    <option value = ''> Select Trip Status </option>
                    <option value = 'Awaiting'> Awaiting </option>
                    <option value = 'Cancelled'> Cancelled </option>
                    <option value = 'Completed'> Completed </option>
                    <option value = 'Running'> Running </option>
                    <option value = 'Settled'> Settled </option>
                    <option value = 'Unsettled'> Unsettled </option>
                    
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                 <label>Time Period</label>
                <div class="form-group">
                  <select class="form-control" name="timePeriod" ng-model="timePeriod" id="timePeriod">
                    <option value = ''> Select Time Period </option>
                    <option value = 'all'> All </option>
                    <option value = '<12'> <12 Hours </option>
                    <option value = '12TO24'> 12 to 24 Hours </option>
                    <option value = '24TO36'> 24 to 36 Hours </option>
                    <option value = '>36'> >36 Hours </option>
                  </select>
                </div>
              </div>
              <div class="col-md-3"> 
                <label>Vendor</label>
                <div class="form-group">
                  <select ng-model="company" name="company" id="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control">
                      <option value="" selected="selected">Select Vendor</option>
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
                  <button type="button" class="btn btn-primary" ng-click="getTripReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','','');getTripVendorList();clearData();">Reset</button>
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
            <div class="align_right" ng-hide="total == 0">
              <button export-to-csv class="btn btn-primary btn-flat">Export as CSV</button>
              <button type="button" class="btn btn-primary"  ng-click="exportToPDF(tripReportRecords)">Download as PDF</button>
            </div>   
              <div class="table-responsive no-padding" id="pdfDataHolder">
                <table id="hiddenTable" style="display: none;">
                  <tr style="display: none;" class="hiddenHeading">
                    <th>lr_no</th> 
                    <th>trip_date</th> 
                    <th>item_name</th> 
                    <th>quantity</th> 
                    <th>do_shipment_no</th> 
                    <th>invoice_challan_no</th> 
                    <th>vendor_name</th> 
                    <th>truck_no</th> 
                    <th>additional1</th> 
                    <th>additional2</th> 
                    <th>party_name</th> 
                    <th>address</th> 
                    <th>trip_status</th> 
                    <th>timeDiff</th>
                    <th>user_name</th>
                    <th>closedByName</th> 
                    <th>Route</th> 
                    <th>contact_number</th> 
                  </tr>
                </table>
                <table width="100%" class="table table-bordered table-hover" id="tableContainer"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr class="actualHeading">
                    <th>LR No</th> 
                    <th>Date</th> 
                    <th>MAT</th> 
                    <th>Qty</th> 
                    <th>Shipment</th> 
                    <th>Invoice</th> 
                    <th>Transporter</th> 
                    <th>Truck</th> 
                    <th>Wheeler</th> 
                    <th>Loading</th> 
                    <th>Ship to Party</th> 
                    <th>Destination</th> 
                    <th>Status</th> 
                    <th>Time Elapsed</th> 
                    <th>Added By</th>
                    <th>Closed By</th> 
                    <th>Route</th> 
                    <th>Contact No</th> 
                  </tr>
                  
                  <tr ng-repeat="row in tripReportRecords" ng-hide="total == 0">
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.lr_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(row.trip_date) | date:'dd/MM/yyyy'}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.item_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.quantity}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.do_shipment_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.invoice_challan_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.vendor_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.additional1}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.additional2}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.party_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.address}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.trip_status}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.trip_status === 'Running' ? row.timeDiff : ''}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.user_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.closedByName}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;"><a href="#">LINK</a></td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.contact_number}}</td>
                  </tr>
                  <tr style="text-align: center;" ng-show="total == 0">
                    <td colspan="18">No Record Found</td>
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
                paging-action="getTripReport(page, paginationControl.orderby, paginationControl.ordertype,tripStatus,timePeriod,company,datefilter,dateRangeValue)">
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

  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
  
@endsection
