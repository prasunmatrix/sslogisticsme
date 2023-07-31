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
  <section class="content" data-ng-controller="ledgerReportsController" data-ng-init="getLedgerReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','');getVendorList(); " ng-click="clearAutoFillContainer();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
   
     
      <form ng-submit="getLedgerReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,company,1)">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-4"> 
                <label>Vendor</label>
                <div class="form-group" id="vendorContainer">
                  <!--<select ng-model="company" name="company" id="company" ng-options="vendorRecord.id as vendorRecord.name for vendorRecord in vendorRecords" class="form-control">
                      <option value="" selected="selected">Select Vendor</option>
                  </select>-->

                  <input type="text" class="form-control upperCaseTransform" placeholder="Vendor" name="company" ng-model="company" id="company" ng-maxlength="255" ng-keyup="complete(company)" autocomplete="off" required/>

                  <ul class="list-group vendorListContainer">
                      <li class="list-group-item" ng-repeat="vendordata in filterVENDOR" ng-click="fillTextbox(vendordata)">@{{vendordata}}</li>
                  </ul>
                </div>            
              </div>
             <div class="col-md-4">
                <label>&nbsp;</label>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-primary" ng-click="getLedgerReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'',''); getVendorList();clearData();">Reset</button>
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
              <button type="button" class="btn btn-primary" ng-click="exportLedgerToPDF(records)">Download as PDF</button> 
            </div>   
              <div class="table-responsive no-padding" id="pdfDataHolder">
                <table id="hiddenTable" style="display: none;">
                  <tr style="display: none;" class="hiddenHeading">
                    <th>bill_date</th> 
                    <th>display_trip_id</th> 
                    <th>amount_given_to</th>
                    <th>debited_amount</th>  
                    <th>credited_amount</th> 
                    <th>balance_amount</th> 
                    <th>narration</th> 
                    <th>truck</th> 
                  </tr>
                </table>
                <table class="table table-bordered table-hover" id="tableContainer"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr class="actualHeading">
                    <th>Date</th> 
                    <th>Trip Unique No</th> 
                    <th>Pump Name or Cash</th> 
                    <th>Debited Amount</th> 
                    <th>Credited Amount</th> 
                    <th>Amount Cumulative</th> 
                    <th>Narration</th> 
                    <th>Truck</th> 
                  </tr>
                  <!-- Showing carry forward balance-->
                  <tr ng-hide="total == 0">
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><b> @{{carryForwardBalance}} ( CARRY FORWARD )</b></td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  <!-- Showing carry forward balance-->
                  <tr ng-repeat="row in records" ng-hide="total == 0">
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(row.bill_date) | date:'dd/MM/yyyy'}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">
                        @{{row.display_trip_id}}
                        &nbsp;&nbsp;
                         <span ng-if="row.is_consolidated == 'Y' ">
                          <a href="#" class="marker_icon" title="View Details" data-toggle="modal" data-target="#myModal" ng-click="billDetailsPopup(row.display_trip_id)"><i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i></a>
                         </span>
                      </td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.amount_given_to}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.debited_amount}}</td>
                       <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.credited_amount}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.balance_amount}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.narration}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck}}</td>
                  </tr>
                 
                  <tr style="text-align: center;" ng-show="total == 0">
                    <td colspan="15">No Record Found</td>
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
                paging-action="getLedgerReport(page, paginationControl.orderby, paginationControl.ordertype,company,1)">
              </div> 
        </div> 
      </div>


      <!-- Modal for Bill Details -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="width:800px;">
            <div class="modal-header">
              <label>Bill details</label>
              <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">
                <label>Bill No :- </label>&nbsp;@{{recordBill.bill_no}} &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Challan :- </label>&nbsp;@{{recordBill.challan_exps}} &nbsp;&nbsp;&nbsp;&nbsp;
                <label>TDS(in %) :- </label>&nbsp;@{{recordBill.tds}} &nbsp;&nbsp;
                <table class="table table-bordered table-hover" id="tableContainer" ng-show="recordPay.length != 0">
                  <tr>
                    <th>Trip ID</th>
                    <th>Rate</th>
                    <th>Qty</th>
                    <th>Toll</th>
                    <th>U/L Charge</th>
                    <th>Tare Charge</th>
                    <th>Freight Charge</th>
                    <th>Short Bag Amount</th>
                    <th>ADV</th>
                    <th>DSL</th>
                    <th>Balance</th>
                  </tr>
                  <tr ng-repeat="row in recordPay">
                    <td>SSLT000@{{row.trip_id}}</td>
                    <td>@{{row.rate}}</td>
                    <td>@{{row.quantity}}</td>
                    <td>@{{row.toll}}</td>
                    <td>@{{row.unloading_charge}}</td>
                    <td>@{{row.tare_charge}}</td>
                    <td>@{{row.freight_charge}}</td>
                    <td>@{{row.short_bag_amount}}</td>
                    <td>@{{row.advance_amount}}</td>
                    <td>@{{row.diesel_amount}}</td>
                    <td>@{{row.balance}}</td>
                  </tr>
                </table>  
              </div>
            </div>
            <div class="modal-footer align_center">

            </div>
          </div>
        </div>
      </div>
      <!-- Modal for Bill Details  -->
  </section>
  <!-- /.content -->


@endsection
@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection
