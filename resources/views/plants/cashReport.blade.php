@extends('layouts.afterlogintemplate')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Cash Report</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Cash Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="cashReportsController" data-ng-init="getCashReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','',''); getCashReportPlantList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
       <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
   
     
     
      <form ng-submit="getCashReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,plant,datefilter,dateRangeValue,searchKeywords,1)">
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
             <div class="col-md-3"> 
              <div class="form-group">
                  <label>&nbsp;</label> 
                  <input type="text" class="form-control" name="searchKeywords" id="searchKeywords" placeholder="Search" ng-model="searchKeywords" maxlength="100">
               </div>
              </div>

              <div class="col-md-3"> 
                <label>Plant</label>
                <div class="form-group">
                  <select ng-model="plant" name="plant" id="plant" ng-options="plantRecord.id as plantRecord.name for plantRecord in plantRecords" class="form-control">
                      <option value="" selected="selected">Select Plant</option>
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
              <div class="col-md-3">
                <label>&nbsp;</label>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-primary" ng-click="getCashReport(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,'','','','','');getCashPlantList();clearData();">Reset</button>
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
            <div class="align_left" ng-show="viewBalance">
              <label>Opening Balance : </label> Rs. @{{openingBalance}}<br>
              <label>Closing Balance : </label> Rs.  @{{closingBalance}}<br>
              
            </div>    
            <div class="align_right" ng-hide="total == 0">
              <button export-to-csv class="btn btn-primary btn-flat">Export as CSV</button>
              <button type="button" class="btn btn-primary" ng-click="exportToPDF(records)">Download as PDF</button> 
            </div>   
              <div class="table-responsive no-padding" id="pdfDataHolder">
               <table id="hiddenTable" style="display: none;"> 
                <tr style="display: none;" class="hiddenHeading">
                    <th>created_at</th> 
                    <th>vch_no</th> 
                    <th>plant_name</th> 
                    <th>account_holder_name</th> 
                    <th>truck_no</th> 
                    <th>fund_transfer_text</th> 
                    <th>expenses_text</th> 
                    <th>balance</th> 
                    <th>description</th> 
                  </tr>
                </table>  
                <table class="table table-bordered table-hover" id="tableContainer"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr class="actualHeading">
                    <th>
                      <a ng-click="getCashReport(paginationControl.currentPage,'created_at',changedOrderType,plant,datefilter,dateRangeValue,searchKeywords,1)" style="cursor: pointer;">Date</a>
                      <span ng-if="ordertype=='asc' && orderby=='created_at'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='created_at'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='created_at'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>
                      <a ng-click="getCashReport(paginationControl.currentPage,'id',changedOrderType,plant,datefilter,dateRangeValue,searchKeywords,1)" style="cursor: pointer;">VCH No</a>
                      <span ng-if="ordertype=='asc' && orderby=='id'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='id'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='id'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>
                      <a ng-click="getCashReport(paginationControl.currentPage,'plant_name',changedOrderType,plant,datefilter,dateRangeValue,searchKeywords,1)" style="cursor: pointer;">Plant</a>
                      <span ng-if="ordertype=='asc' && orderby=='plant_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='plant_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='plant_name'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>
                      <a ng-click="getCashReport(paginationControl.currentPage,'account_holder_name',changedOrderType,plant,datefilter,dateRangeValue,searchKeywords,1)" style="cursor: pointer;">Account Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='account_holder_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='account_holder_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='account_holder_name'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>Truck</th> 
                    <th>
                      <a ng-click="getCashReport(paginationControl.currentPage,'amount',changedOrderType,plant,datefilter,dateRangeValue,searchKeywords,1)" style="cursor: pointer;">Fund Transfer</a>
                      <span ng-if="ordertype=='asc' && orderby=='amount'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='amount'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='amount'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                    </th> 
                    <th>
                      <a ng-click="getCashReport(paginationControl.currentPage,'amount',changedOrderType,plant,datefilter,dateRangeValue,searchKeywords,1)" style="cursor: pointer;">Expenses</a>
                      <span ng-if="ordertype=='asc' && orderby=='amount'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='amount'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='amount'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                    </th> 
                    <th>Balance (Rs)</th> 
                    <th>Narration</th> 
                  </tr>

                  <!-- Showing carry forward balance-->
                  <tr>
                    <td>-</td>
                    <td>-</td>
                    <td><b>@{{plantName}}</b></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><b>@{{carryForwardBalance}}</b></td>
                    <td><b>CARRY FORWARD</b></td>
                  </tr>
                  <!-- Showing carry forward balance-->

                  <tr ng-repeat="row in records" ng-hide="total == 0">
                    
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(row.created_at)|date:'dd/MM/yyyy'}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.vch_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.plant_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.account_holder_name}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.truck_no}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.fund_transfer_text}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.expenses_text}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.balance}}</td>
                      <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{row.descriptionText}}</td>
                  </tr>
                  <tr style="text-align: center;font-size: 20px; background: #BEE8F5" ng-hide="total == 0">
                    <td colspan="5">Total</td>
                    <td>@{{records[0]['totalPayment']}}</td>
                    <td>@{{records[0]['totalPurchase']}}</td>
                    <td>@{{records[0]['remainingBalance']}}</td>
                    <td></td>
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
                paging-action="getCashReport(page, paginationControl.orderby, paginationControl.ordertype,plant,datefilter,dateRangeValue,searchKeywords,1)">
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

  <script src="{{ asset('/angularJs/angularModules/plants/plantApp.js') }}"></script>
  
@endsection
