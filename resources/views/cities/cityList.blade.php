@extends('layouts.afterlogintemplate')
@section('content')


 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>City</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Cities</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="citiesController" data-ng-init="cityList(1,'id','asc','');">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="cityList(currentPage,orderby,changedOrderType,searchKeyword)" ng-keyup="cityList(currentPage,orderby,changedOrderType,searchKeyword)">
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
                      <a ng-click="cityList(currentPage,'id',changedOrderType,searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="cityList(currentPage,'city_name',changedOrderType,searchKeyword)" style="cursor: pointer;">City Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='city_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='city_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='city_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                  </th>
                  <th>
                      <a ng-click="cityList(currentPage,'city_code',changedOrderType,searchKeyword)" style="cursor: pointer;">City Code</a>
                      <span ng-if="ordertype=='asc' && orderby=='city_code'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='city_code'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='city_code'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                  </th>
                  <th >Country Name</th>
                  <th>State Name</th> 
                  <th>Status </th>                      
                  <th>Last Updated </th>
                  @if(\Gate::check('city_edit') || \Gate::check('city_delete'))
                    <th>Action</th>
                  @endif
                </tr>
                <tr ng-repeat="row in records">
                    <td>@{{row.id}}</td>
                    <td>@{{row.city_name}}</td>
                    <td>@{{row.city_code}}</td> 
                    <td>@{{row.country_name}}</td> 
                    <td>@{{row.state_name}}</td>
                    <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                    <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                    @if(\Gate::check('city_edit') || \Gate::check('city_delete'))
                      <td>
                         @can('city_edit')
                         <a href=<?php echo url(''); ?>/view-city-edit-form/@{{row.id}} title="Edit City"  ><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                         @endcan
                         &nbsp;

                         @can('city_delete')
                         <a ng-click="deleteCity(row.id,currentPage,orderby,ordertype,searchKeyword);" title="Delete City" ><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
                         @endcan
                      </td>
                    @endif
                </tr>
                <tr style="text-align: center;" ng-show="(records|filter:searchKeyword).length == 0">
                  <td colspan="11">No Record Found</td>
                </tr>
              </table>
              
            </div>
            <div paging
              class="pagination pagination-sm no-margin pull-right"
              page="currentPage" 
              page-size="perPageRecord" 
              total="total"
              show-prev-next="true"
              show-first-last="true"
              paging-action="cityList(page,orderby,ordertype,searchKeyword)">
            </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/cities/cityApp.js') }}"></script>
@endsection
