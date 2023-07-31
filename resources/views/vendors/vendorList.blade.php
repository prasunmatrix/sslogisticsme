@extends('layouts.afterlogintemplate')
@section('content')



  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Vendor</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Vendors</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="vendorsController" data-ng-init="vendorList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="vendorList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="vendorList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
                      <a ng-click="vendorList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="vendorList(paginationControl.currentPage,'name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Vendor Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th> Contact Number </th> 
                    <th> Contact Email </th>
                    <th> Status</th>                      
                    <th> Last Updated</th>
                    @if(\Gate::check('vendor_edit') || \Gate::check('vendor_delete'))
                      <th width="">Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>@{{row.id}}</td>
                      <td>@{{row.name}}</td>
                      <td>@{{row.contact_number == NULL ? 'N/A' : row.contact_number}}</td> 
                      <td>@{{row.contact_email == NULL ? 'N/A' : row.contact_email}}</td> 
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                      @if(\Gate::check('vendor_edit') || \Gate::check('vendor_delete'))
                        <td>
                           @can('vendor_edit')
                           <a ng-hide="row.name == 'SSLogistics'" href=<?php echo url(''); ?>/view-vendor-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Vendor" ><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('vendor_view')
                           <a href=<?php echo url(''); ?>/vendor-view/@{{row.id}}/@{{paginationControl.currentPage}} title="View Vendor" ><i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('vendor_delete')
                           <a style="cursor: pointer;" ng-hide="row.name == 'SSLogistics'" ng-click="deleteVendor(row.id,paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);" title="Delete Vendor" ><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
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
                paging-action="vendorList(page,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)">
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/vendors/vendorApp.js') }}"></script>
@endsection
