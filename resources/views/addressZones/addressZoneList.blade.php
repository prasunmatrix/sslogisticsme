@extends('layouts.afterlogintemplate')
@section('content')



  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Address Zone</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Address Zones</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="addressZonesController" data-ng-init="addressZoneList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="addressZoneList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="addressZoneList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
                      <a ng-click="addressZoneList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="addressZoneList(paginationControl.currentPage,'title',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Title</a>
                      <span ng-if="ordertype=='asc' && orderby=='title'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='title'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='title'" class="nosort">
                      <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th> Address </th>
                    <th> Latitude </th>
                    <th> Longitude </th> 
                    <th>Status</th>                      
                    <th>Last Updated</th>
                    @if(\Gate::check('address_zone_edit') || \Gate::check('address_zone_delete'))
                      <th width="">Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>@{{row.id}}</td>
                      <td>@{{row.title}}</td>
                      <td>@{{row.address}}</td>
                      <td>@{{row.latitude}}</td>
                      <td>@{{row.longitude}}</td> 
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                      @if(\Gate::check('address_zone_edit') || \Gate::check('address_zone_delete'))
                        <td>
                           @can('address_zone_edit')
                           <a href=<?php echo url(''); ?>/view-addressZone-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Address Zone" ><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('category_delete')
                           <a style="cursor: pointer;" ng-click="deleteAddressZone(row.id,paginationControl.currentPage,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword);" title="Delete Address Zone" ><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
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
                paging-action="addressZoneList(page,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)">
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/addressZones/addressZoneApp.js') }}"></script>
@endsection
