@extends('layouts.afterlogintemplate')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Payment Report</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Payment Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="paymentReportsController" data-ng-init="getPaymentReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','');getPaymentVendorList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
       <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
   
     
     
      <form ng-submit="getPaymentReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,company,1,challanExps,tds)">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-4"> 
                <label>Vendor Name (Truck Owner)</label>
                <div class="form-group">
                  <select ng-model="company" name="company" id="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control">
                      <option value="" selected="selected">Select Vendor</option>
                  </select>
                </div>            
              </div>
              <div class="col-md-4">
                <label>&nbsp;</label>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-primary" ng-click="getPaymentReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','');getPaymentVendorList();clearData();">Reset</button>
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
            <div class="align_right" ng-hide="total == 0">
              <button export-to-csv class="btn btn-primary btn-flat">Export as CSV</button>
              <button type="button" class="btn btn-primary" ng-click="exportToPDF(records)">Download as PDF</button> 
            </div>   
              <div class="table-responsive no-padding" id="pdfDataHolder">
                <table id="hiddenTable" style="display: none;">
                   <tr style="display: none;" class="hiddenHeading">
                    <th>serial_no</th> 
                    <th>trip_date</th> 
                    <th>truck_no</th> 
                    <th>address</th> 
                    <th>party_name</th> 
                    <th>lr_no</th> 
                    <th>do_shipment_no</th> 
                    <th>quantity</th> 
                    <th>rate</th> 
                    <th>unloading_charge</th>
                    <th>tare_charge</th> 
                    <th>toll</th>
                    <th>freight</th>
                    <th>diesel_amount</th> 
                    <th>advance_amount</th>
                    <th>bags</th> 
                    <th>short_bag_amount</th> 
                    <th>payment_balance</th>
                    <th>remarks</th>
                  </tr>
                </table>
                <table class="table table-bordered table-hover" id="tableContainer"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr class="actualHeading">
                    <th>S No</th> 
                    <th>Date</th> 
                    <th>Truck</th> 
                    <th>Destination</th> 
                    <th>Party</th> 
                    <th>LR No.</th> 
                    <th>Shipment</th> 
                    <th>Qty</th> 
                    <th>Rate</th> 
                    <th>U/L</th>
                    <th>Tare</th> 
                    <th>Toll</th>
                    <th>Freight</th>
                    <th>Diesel</th> 
                    <th>Advance</th>
                    <th>Short Bags Quantity</th> 
                    <th>Short Bags Amount</th> 
                    <th>Balance (Rs.)</th>
                    <th>Remarks</th>
                  </tr>
                 
                  <tr ng-repeat="row in records" ng-hide="total == 0">
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;"> @{{$index+1}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(row.trip_date) | date:'dd/MM/yyyy'}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.address}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.party_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.lr_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.do_shipment_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.quantity}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.rate}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.unloading_charge}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.tare_charge}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.toll}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.freight}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.diesel_amount}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.advance_amount}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.bags}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.short_bag_amount}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.payment_balance}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.remarks}}</td>
                  </tr>
                  <tr style="font-weight: bold;" ng-hide="total == 0">
                    <td colspan="14">&nbsp;</td>
                    <td colspan="3">LESS :- CHALLAN EXPS</td>
                    <td rel="challanExps" nocsv>
                      <!--{{\Config::get('constants.challan_Exps')}}--> 
                      <input type="text" name="challanExps" id="challanExps" ng-model="challanExps" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="numberPattern" ng-change="calculatePaymentReportBalance(challanExps,tds,records[0].totalBalance);">
                    </td>
                    <td></td>
                  </tr>
                  <tr style="font-weight: bold;" ng-hide="total == 0">
                    <td colspan="14">&nbsp;</td>
                    <td colspan="3"> LESS :- TDS % </td>
                    <td rel="tds" nocsv>
                      <!--{{\Config::get('constants.tds')}}-->
                      <select name="tds" id="tds" ng-model="tds" ng-change="calculatePaymentReportBalance(challanExps,tds,records[0].totalBalance);">
                        @for($i=0; $i<=30; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </td>
                    <td></td>
                  </tr>
                  <tr style="font-weight: bold;" ng-hide="total == 0">
                    <td colspan="14">&nbsp;</td>
                    <td colspan="3"> TOTAL BALANCE </td>
                    <!--<td>@{{records[0].balanceAfterDeduction}}</td>-->
                    <td class="balanceAfterDeduction" rel="balanceAfterDeduction">
                      <span id="balanceAfterDeduction">@{{balanceAfterDeduction}}</span>
                    </td>
                    <td></td>
                  </tr>
                  <tr style="text-align: center;" ng-show="total == 0">
                    <td colspan="19">No Record Found</td>
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
                paging-action="getPaymentReport(page, paginationControl.orderby, paginationControl.ordertype,company,1,challanExps,tds)">
              </div> 
        </div> 
      </div>
  </section>
  <!-- /.content -->
  
@endsection
@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection
