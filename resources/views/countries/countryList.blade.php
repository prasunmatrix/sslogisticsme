@extends('layouts.afterlogintemplate')
@section('content')


 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Country</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Countries</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="countriesController" data-ng-init="countryList();">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
    </div>
    
       <!-- <form>
        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100">
                </div>
              </div>
            </div>
          </div>
        </div> 
      </form> -->

      <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="flash-message validation-error" id="message" style="display: none;"> 
              <p class="alert alert-danger"></p>
            </div>
            

              <div class="table-responsive no-padding">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th width="" ng-click="sort('id')">ID 
                       <span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('country_name')">Country Name 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='country_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('country_code')">Country Code
                      <span class="glyphicon sort-icon" ng-show="sortKey=='country_code'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th width="" ng-click="sort('status')">Status
                      <span class="glyphicon sort-icon" ng-show="sortKey=='Status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>                      
                    <th width="" ng-click="sort('updated_at')">Last Updated 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                   
                  </tr>
                  <tr ng-repeat="row in records | orderBy:sortKey:reverse | filter:searchKeyword ">
                      <td>@{{row.id}}</td>
                      <td>@{{row.country_name}}</td>
                      <td>@{{row.country_code}}</td> 
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                  </tr>
                  <tr style="text-align: center;" ng-show="(records|filter:searchKeyword).length == 0">
                    <td colspan="11">No Record Found</td>
                  </tr>
                </table>
                
              </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/countries/countryApp.js') }}"></script>
@endsection
