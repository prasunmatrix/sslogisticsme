@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Plant Laser</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Plant Laser</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="PlantLaserController" data-ng-init="viewSelectedPlantLaser({{$plant_id}},{{$year}});">
    <div class="flash-message" ng-hide="msgDisplay">
      @include('common.flash_message')
      <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
      <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
      <form ng-submit="searchPlantLaser({{$year}},{{$plant_id}});" id="plantLaserForm" name="plantLaserForm">
        <div class="box box-default">
          <div class="box-body">
          <div class="select_plant">
            <div class="row">
              <div class="col-xs-7">
                <div class="form-group">
                <label>Select Year</label>
                  @{{selectYear}}
                  <select data-ng-model="selectYear"  name="selectYear" 
                  data-ng-options="item for item in years" class="form-control" required>
                    <option value="" selected="selected">Select Year</option>
                  </select>
                   <span class="invalidInputErrorClass" ng-show="plantLaserForm.selectYear.$touched && plantLaserForm.selectYear.$error.required">Please Select Year</span>
                </div>
              </div>
              <div class="col-xs-5">
                <div class="form-group">
                  <button type="submit" ng-disabled="plantLaserForm.$invalid" class="btn btn-primary">Submit</button>
                  <a href="<?php echo URL('');?>/plant-laser-view" class="btn btn-default btn-flat">Back</a>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div> 
      </form>
      <div class="box box-default">
      <div class="newplant">
      <h3>@{{plantName}}</h3>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive no-padding">
              <table class="table table-bordered" id="tableContainer">
                <tr ng-show="(records).length > 0">
                  <th width="60%">Description</th>                  
                  <th width="20%" class="right">Debit</th>
                  <th width="20%" class="right">Credit</th>
                </tr>
                <tr ng-repeat="row in records">
                    <td>@{{row.description}} (@{{formatDate(row.created_at) |  date:'dd-MM-yyyy'}})</td>
                    <td class="right">@{{row.type === 'D' ? (row.amount | number : 2) : (0 | number : 2)}}</td>
                    <td class="right">@{{row.type === 'C' ? (row.amount | number : 2) : (0 | number : 2)}}</td>
                </tr>
                <tr ng-show="(records).length > 0">
                  <td><strong>Total</strong></td>
                  <td class="right"><strong> Rs. @{{totalDebit | number : 2}}</strong></td>
                  <td class="right"><strong> Rs. @{{totalCredit | number : 2}}</strong></td>
                </tr>
                <tr ng-show="(records).length > 0">
                  <td class="right amount" colspan="3">@{{balance > 0 ? 'Credit balance - ':'Debit balance - '}} Rs. @{{balance | number : 2}}</td>
                </tr>
                <tr style="text-align: center;" ng-show="(records).length == 0">
                  <td colspan="3"><strong>No Record Found</strong></td>
                </tr>
              </table>
              
            </div>
        </div> 
        </div>
      </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/plants/plantApp.js') }}"></script>
@endsection
