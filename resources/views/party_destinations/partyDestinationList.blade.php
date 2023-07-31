@extends('layouts.afterlogintemplate')
@section('content')


 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Party Destination</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Party Destinations</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="partyDestinationsController" data-ng-init="partyDestinationList(1,'id','asc','');">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="partyDestinationList(currentPage,orderby,changedOrderType,searchKeyword)" ng-keyup="partyDestinationList(currentPage,orderby,changedOrderType,searchKeyword)">
                </div>
              </div>
            </div>
          </div>
        </div> 
      </form>
      @can('party_manage_distination_add')
      <div class="import_section container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-9">
              <form ng-submit="contentData=fileContent;savePartyDestinationCSV();">
                <input type="file" file-reader="fileContent" required="required" />
                <button type="submit" class="btn btn-primary btn-flat">Import</button>
              </form>
            </div>
            <div class="col-md-3" style="text-align: right;">
              <a href="{{ asset('csvformat/PartyDescription1.csv') }}" download class="btn btn-primary btn-flat"> Sample File Download </a>
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
                    <a ng-click="partyDestinationList(currentPage,'id',changedOrderType,searchKeyword)" style="cursor: pointer;">ID</a>
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
                    <a ng-click="partyDestinationList(currentPage,'party_name',changedOrderType,searchKeyword)" style="cursor: pointer;">Party Name</a>
                    <span ng-if="ordertype=='asc' && orderby=='party_name'" class="ascsort">
                      <i class="fa fa-sort-asc" aria-hidden="true"></i>
                    </span>
                    <span ng-if="ordertype=='desc' && orderby=='party_name'" class="descsort">
                      <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    </span>
                    <span ng-if="orderby!='party_name'" class="nosort">
                    <i class="fa fa-sort" aria-hidden="true"></i>
                    </span>
                  </th>
                  <th>Address</th>
                  <th>Country Name</th>
                  <th>State Name</th>  
                  <th>City Name</th>
                  <th>Contact Number</th>
                  <th>Contact Email</th>
                  <th>Contact Person</th>                  
                  <th>Status</th>                      
                  <th>Last Updated</th>
                    @if(\Gate::check('party_manage_distination_edit') || \Gate::check('party_manage_distination_delete'))
                  <th width="">Action</th>
                  @endif
                </tr>
                <tr ng-repeat="row in records | orderBy:sortKey:reverse | filter:searchKeyword ">
                    <td>@{{row.id}}</td>
                    <td>@{{row.party_name}}</td>
                    <td>@{{row.address}}</td>
                    <td>@{{row.country_name}}</td> 
                    <td>@{{row.state_name}}</td>
                    <td>@{{row.city_name}}</td> 
                    <td>@{{row.contact_number}}</td>
                    <td>@{{row.contact_email}}</td>
                    <td>@{{row.contact_person}}</td>
                    <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                    <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                     @if(\Gate::check('party_manage_distination_edit') || \Gate::check('party_manage_distination_delete'))
                      <td>
                         @can('party_manage_distination_edit')
                         <a href=<?php echo url(''); ?>/view-partyDestination-edit-form/@{{row.id}} title="Edit Party Destination"><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                         @endcan
                         &nbsp;
                         @can('party_manage_distination_delete')
                         <a ng-click="deletePartyDestination(row.id,currentPage,orderby,ordertype,searchKeyword);" title="Delete Party Destination"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
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
              paging-action="partyDestinationList(page,orderby,ordertype,searchKeyword)">
            </div>
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
 <script src="{{ asset('/angularJs/angularModules/party-destinations/partyDestinationApp.js') }}"></script>
@endsection
