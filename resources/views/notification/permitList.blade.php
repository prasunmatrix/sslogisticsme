@extends('layouts.afterlogintemplate')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Permit Notification</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Permit Notifications</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="NotificationController" data-ng-init="permitList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
    </div>
    
       <form>
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="permitList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="permitList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
                      <a ng-click="permitList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="permitList(paginationControl.currentPage,'permit_no',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Permit No</a>
                      <span ng-if="ordertype=='asc' && orderby=='permit_no'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='permit_no'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='permit_no'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>Truck No</th>
                    <th>Permit On</th> 
                    <th>Permit End Date</th>                   
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>@{{row.id}}</td>
                      <td>@{{row.permit_no}}</td> 
                      <td>@{{row.truck_no}}</td>
                      <td>@{{formatDate(row.permit_on) |  date:'dd-MM-yyyy'}}</td> 
                      <td>@{{formatDate(row.permit_end) |  date:'dd-MM-yyyy'}}</td>
                  </tr>
                  <tr style="text-align: center;" ng-show="(records|filter:paginationControl.searchKeyword).length == 0">
                    <td colspan="8">No Record Found</td>
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
                paging-action="permitList(page, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword)">
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/notifications/notificationApp.js') }}"></script>
@endsection
