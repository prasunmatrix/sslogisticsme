@extends('layouts.afterlogintemplate')
@section('content')


 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Truck</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Trucks</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="trucksController" data-ng-init="truckList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="truckList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="truckList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
            
              <div class="table-responsive no-padding">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th>
                      <a ng-click="truckList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="truckList(paginationControl.currentPage,'type',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Type</a>
                      <span ng-if="ordertype=='asc' && orderby=='type'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='type'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='type'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="truckList(paginationControl.currentPage,'truck_no',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Truck No</a>
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
                    <th>Vendor Name</th>
                    <th>Status</th>                      
                    <th>Last Updated </th>
                    @if(\Gate::check('truck_manage_edit') || \Gate::check('truck_manage_view') || \Gate::check('truck_manage_delete'))
                      <th>Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>SSLV000@{{row.id}}</td>
                      <td>@{{row.type === 'C' ? 'Company' : 'Market'}}</td>
                      <td>@{{row.truck_no === 'undefined' ? '' : row.truck_no}}</td> 
                      <td>@{{row.vendor_name}}</td>
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                      @if(\Gate::check('truck_manage_edit') || \Gate::check('truck_manage_view') || \Gate::check('truck_manage_delete'))
                        <td>
                           @can('truck_manage_edit')
                            <a ng-show="row.canEditDelete" href=<?php echo url(''); ?>/view-truck-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Truck"><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('truck_manage_view')
                            <a href=<?php echo url(''); ?>/truck-view/@{{row.id}}/@{{paginationControl.currentPage}} title="View Truck" ><i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('truck_manage_delete')
                            <a ng-show="row.canEditDelete" style="cursor: pointer;" ng-click="deleteTruck(row.id,paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);" title="Delete Truck"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
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
                paging-action="truckList(page,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)">
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/trucks/truckApp.js') }}"></script>
@endsection
