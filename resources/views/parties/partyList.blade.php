@extends('layouts.afterlogintemplate')
@section('content')


 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Party</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Parties</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="partiesController" data-ng-init="partyList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
    <div class="flash-message"  ng-hide="msgDisplay">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="partyList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="partyList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
                </div>
              </div>
            </div>
          </div>
        </div> 
      </form>

      @can('party_manage_add')
      <div class="import_section container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-9">
              <form ng-submit="contentData=fileContent;savePartyCSV();">
                <input type="file" file-reader="fileContent" required="required" />
                <button type="submit" class="btn btn-primary btn-flat">Import</button>
              </form>
            </div>
            <div class="col-md-3" style="text-align: right;">
              <a href="{{ asset('csvformat/Party1.csv') }}" download class="btn btn-primary btn-flat"> Sample File Download </a>
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
                      <a ng-click="partyList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="partyList(paginationControl.currentPage,'party_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Party Name</a>
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
                    <th class="parties_address_col">Address</th>   
                    <th>Party Description</th> 
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Status</th>                      
                    <th>Last Updated</th>
                    @if(\Gate::check('party_manage_edit') || \Gate::check('party_manage_delete'))
                      <th width="">Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in records">
                      <td>@{{row.id}}</td>
                      <td>@{{row.party_name}}</td> 
                      <td class="parties_address_col">@{{row.address}}</td>
                      <td>@{{row.party_description == NULL ? 'N/A' : row.party_description}}</td> 
                      <td>@{{row.phone_number == NULL ? 'N/A' : row.phone_number}}</td>
                      <td>@{{row.email == NULL ? 'N/A' : row.email}}</td>
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>
                      @if(\Gate::check('party_manage_edit') || \Gate::check('party_manage_delete'))
                        <td>
                           @can('party_manage_edit')
                           <a href=<?php echo url(''); ?>/view-party-edit-form/@{{row.id}}/@{{paginationControl.currentPage}} title="Edit Party"><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('party_manage_view')
                           <a href=<?php echo url(''); ?>/party-view/@{{row.id}}/@{{paginationControl.currentPage}} title="View Party"><i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('party_manage_delete')
                           <a ng-click="deleteParty(row.id,paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);" style="cursor: pointer;" title="Delete Party"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
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
                paging-action="partyList(page,paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword)">
              </div> 
          </div> 
        </div>

  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/parties/partyApp.js') }}"></script>
@endsection
