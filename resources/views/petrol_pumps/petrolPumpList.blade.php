@extends('layouts.afterlogintemplate')
@section('content')


 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Petrol Pump</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Petrol Pumps</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="petrolPumpsController" data-ng-init="petrolPumpList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="petrolPumpList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,searchKeyword)" ng-keyup="petrolPumpList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype,searchKeyword)">
                </div>
              </div>
            </div>
          </div>
        </div> 
      </form>
      @can('petrol_pump_add')
      <div class="import_section container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-9">
              <form ng-submit="contentData=fileContent;savePetrolPumpCSV();">
                <input type="file" file-reader="fileContent" required="required" />
                <button type="submit" class="btn btn-primary btn-flat">Import</button>
              </form>
            </div>
            <div class="col-md-3" style="text-align: right;">
              <a href="{{ asset('csvformat/petrolpump1.csv') }}" download class="btn btn-primary btn-flat"> Sample File Download </a>
            </div>
          </div>
        </div>
      <div class="clearfix"></div>
      </div>
      @endcan

      <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="flash-message validation-error" id="message" style="display: none;"> 
              <p class="alert alert-danger"></p>
            </div>
            <div class="align_right">
              <button export-to-csv class="btn btn-primary btn-flat">Export as CSV</button>
            </div>

            <div class="table-responsive no-padding">
              <table class="table table-bordered table-hover" id="tableContainer">
                <tr>
                  <th>
                      <a ng-click="petrolPumpList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="petrolPumpList(paginationControl.currentPage,'petrol_pump_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Petrol Pump Name</a>
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
                  <th>Address</th> 
                  <th>Contact Number</th>
                  <th>Contact Email </th>
                  <th >Contact Person </th> 
                  <th>Status</th>                      
                  <th>Last Updated </th>
                  @if(\Gate::check('petrol_pump_edit') || \Gate::check('petrol_pump_delete'))
                    <th>Action</th>
                  @endif
                </tr>
                <tr ng-repeat="row in records">
                    <td>@{{row.id}}</td>
                    <td>@{{row.petrol_pump_name}}</td>
                    <td>@{{row.address}}</td> 
                    <td>@{{row.contact_number == NULL ? 'N/A' : row.contact_number}}</td>
                    <td>@{{row.contact_email == NULL ? 'N/A' : row.contact_email}}</td>
                    <td>@{{(row.contact_person == NULL|| record.contact_person == '') ? 'N/A' : row.contact_person}}</td>
                    <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                    <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                    @if(\Gate::check('petrol_pump_edit') || \Gate::check('petrol_pump_delete'))
                      <td>
                         @can('petrol_pump_edit')
                           <a href=<?php echo url(''); ?>/view-petrolPump-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Petrol Pump"><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true" ng-show="row.canEditDelete"></i></a>
                         @endcan
                         &nbsp;
                         @can('petrol_pump_view')
                            <a href=<?php echo url(''); ?>/petrol-pump-view/@{{row.id}}/@{{paginationControl.currentPage}} title="View Petrol Pump"><i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i></a>
                         @endcan
                         &nbsp;
                         @can('petrol_pump_delete')
                            <a style="cursor: pointer;" ng-click="deletePetrolPump(row.id,paginationControl.currentPage,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword);" title="Delete Petrol Pump"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true" ng-show="row.canEditDelete"></i></a>
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
              paging-action="petrolPumpList(page,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)">
            </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/petrol-pumps/petrolPumpApp.js') }}"></script>
@endsection
