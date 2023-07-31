@extends('layouts.afterlogintemplate')
@section('content')


<!-- Main content -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Truck Insurance</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Truck Insurances</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="insurancesController" data-ng-init="insuranceList();">
    <div class="flash-message">
      @include('common.flash_message')
    </div>
    <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success" ng-hide="msgDisplay"></span>
       <form>
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
      </form>

      <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="flash-message validation-error" id="message" style="display: none;"> 
              <p class="alert alert-danger"></p>
            </div>
            <div class="align_right">
              <button class="btn btn-primary btn-flat button-link-holder"><a href="<?php echo \URL::route('viewAddTruckInsurance'); ?>">Add</a></button>
            </div>
              <div class="table-responsive no-padding">
                <table class="table table-bordered table-hover" id="tableContainer">
                  <tr>
                    <th width="" ng-click="sort('id')">ID 
                       <span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('truck_no')">Truck Number
                      <span class="glyphicon sort-icon" ng-show="sortKey=='truck_no'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('policy_no')">Policy Number
                      <span class="glyphicon sort-icon" ng-show="sortKey=='policy_no'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th> 
                    <th width="" ng-click="sort('name')">Name 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('policy_on')">Policy On 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='policy_on'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>  
                    <th width="" ng-click="sort('policy_start')">Policy Start 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='policy_start'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('policy_end')">Policy End 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='policy_end'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('policy_file')">Policy File 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='policy_file'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" ng-click="sort('status')">Status
                      <span class="glyphicon sort-icon" ng-show="sortKey=='Status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>                      
                    <th width="" ng-click="sort('updated_at')">Last Updated 
                      <span class="glyphicon sort-icon" ng-show="sortKey=='updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                    </th>
                    <th width="" style="display: none;">Action</th>
                  </tr>
                  <tr ng-repeat="row in records | orderBy:sortKey:reverse | filter:searchKeyword ">
                      <td>@{{row.id}}</td>
                      <td>@{{row.truck_no}}</td>
                      <td>@{{row.policy_no}}</td> 
                      <td>@{{row.name}}</td> 
                      <td>@{{row.policy_on}}</td>
                      <td>@{{row.policy_start}}</td> 
                      <td>@{{row.policy_end}}</td>
                      <td>@{{row.policy_file}}</td>
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                      <td style="display: none;">
                         <a href=<?php echo url(''); ?>/view-truckInsurance-edit-form/@{{row.id}} ><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                         &nbsp;
                         <a ng-click="deleteTruckInsurance(row.id);"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
                      </td>
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

<!-- /.container -->

@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/truck-insurances/insuranceApp.js') }}"></script>
@endsection
