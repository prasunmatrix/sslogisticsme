@extends('layouts.afterlogintemplate')
@section('content')



  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Category</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Categories</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="categoriesController" data-ng-init="categoryList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="categoryList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="categoryList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
                      <a ng-click="categoryList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="categoryList(paginationControl.currentPage,'category_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Category Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='category_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='category_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='category_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="categoryList(paginationControl.currentPage,'category_description',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Category Description</a>
                      <span ng-if="ordertype=='asc' && orderby=='category_description'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='category_description'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='category_description'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>Status</th>                      
                    <th>Last Updated</th>
                    @if(\Gate::check('category_edit') || \Gate::check('category_delete'))
                      <th width="">Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>@{{row.id}}</td>
                      <td>@{{row.category_name}}</td>
                      <td>@{{row.category_description == NULL ? 'N/A' : row.category_description}}</td> 
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                      @if(\Gate::check('category_edit') || \Gate::check('category_delete'))
                        <td>
                           @can('category_edit')
                           <a href=<?php echo url(''); ?>/view-category-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Category" ><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('category_delete')
                           <a ng-click="deleteCategory(row.id,paginationControl.currentPage,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword);" title="Delete Category" ><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true" style="cursor: pointer;"></i></a>
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
                paging-action="categoryList(page,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)">
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/categories/categoryApp.js') }}"></script>
@endsection
