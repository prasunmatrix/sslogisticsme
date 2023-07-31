@extends('layouts.afterlogintemplate')
@section('content')



  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Extra Diesel</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Extra Diesel</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="extraCashDieselsController" data-ng-init="extraDieselList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
    
       <form>
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="extraDieselList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="extraDieselList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
              <a href=<?php echo url(''); ?>/view-extra-diesel-add-form class="btn btn-primary btn-flat">Pay Extra Diesel</a>
            </div>
              <div class="table-responsive no-padding">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th>
                      <a ng-click="extraDieselList(paginationControl.currentPage,'bill_date',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Date</a>
                      <span ng-if="ordertype=='asc' && orderby=='bill_date'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='bill_date'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='bill_date'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="extraDieselList(paginationControl.currentPage,'plant_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Plant Name</a>
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
                      <a ng-click="extraDieselList(paginationControl.currentPage,'truck_no',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Truck No</a>
                      <span ng-if="ordertype=='asc' && orderby=='truck_no'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='truck_no'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='truck_no'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>
                      <a ng-click="extraDieselList(paginationControl.currentPage,'vendor_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Vendor Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='vendor_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='vendor_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='vendor_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="extraDieselList(paginationControl.currentPage,'extra_diesel',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Amount</a>
                      <span ng-if="ordertype=='asc' && orderby=='extra_diesel'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='extra_diesel'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='extra_diesel'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="extraDieselList(paginationControl.currentPage,'petrol_pump_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Petrol Pump Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='petrol_pump_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='petrol_pump_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='petrol_pump_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>Remarks</th>
                    <th width="">Action</th>
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>@{{formatDate(row.bill_date) |  date:'dd-MM-yyyy'}}</td>
                      <td>@{{row.plant_name}}</td>
                      <td>@{{row.truck_no}}</td> 
                      <td>@{{row.vendor_name}} </td>
                      <td>@{{row.extra_diesel}}</td>
                      <td>@{{row.petrol_pump_name}}</td>
                      <td>@{{row.narration}}</td>
                      @if(\Gate::check('extra_cash'))
                        <td>
                           @can('extra_diesel')
                            <a href=<?php echo url(''); ?>/view-extra-diesel-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Extra Diesel" ><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('extra_diesel')
                            <a ng-click="deleteExtraDiesel(row.id,paginationControl.currentPage,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword);" title="Delete Category" ><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true" style="cursor: pointer;"></i></a>
                           @endcan
                        </td>
                      @endif 
                  </tr>
                 <tr style="text-align: center;" ng-show="(records|filter:paginationControl.searchKeyword).length == 0">
                    <td colspan="11">No Record Found</td>
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
                paging-action="extraDieselList(page,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)">
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection
