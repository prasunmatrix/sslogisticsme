@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Advance List</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Advance List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="ApprovalManageController" data-ng-init="advanceList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100" ng-change="advanceList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="advanceList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
                  <th width="5%">
                      <a ng-click="advanceList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                  <th width="9%">
                      <a ng-click="advanceList(paginationControl.currentPage,'trip_id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Trip ID</a>
                      <span ng-if="ordertype=='asc' && orderby=='trip_id'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='trip_id'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='trip_id'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                  </th>
                  <th width="9%">
                      <a ng-click="advanceList(paginationControl.currentPage,'name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Plant Name</a>
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
                  <th width="9%">
                      <a ng-click="advanceList(paginationControl.currentPage,'truck_no',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Truck No.</a>
                      <span ng-if="ordertype=='asc' && orderby=='truck_no'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='truck_no'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='truck_no'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                  </th>
                  <th width="9%">
                      <a ng-click="advanceList(paginationControl.currentPage,'full_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Added By</a>
                      <span ng-if="ordertype=='asc' && orderby=='full_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='full_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='full_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                  </th>
                  <th width="10%">Previous Advance Amount</th>    
                  <th width="10%">Requested Advance Amount</th>
                  <th width="12%">Current Advance Amount</th>  
                  <th width="9%">Approval/Disapproval Reason</th>                
                  <th width="9%">Last Updated </th>
                  <th width="9%">@if(\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) Status @else Action @endif</th>
                </tr>
                <tr ng-repeat="row in records">
                    <td>@{{row.id}}</td>
                    <td>SSLT000@{{row.trip_id}}</td>
                    <td>@{{row.name}}</td>
                    <td>@{{row.truck_no}}</td>
                    <td>@{{row.supervisor_name}}</td>
                    <td>@{{row.actual_amount | number : 2}}</td>
                    <td>@{{row.requested_amount | number : 2}}</td>
                    <td>@{{row.advance_amount | number : 2}}</td>
                    <td>@{{row.approval_reason}}</td>
                    <td>@{{formatDate(row.updated_at) |  date:'dd-MM-yyyy'}}</td>                    
                    <td>
                      @if(\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId'))
                        @{{row.approval_status}}
                      @else
                        <span ng-if="row.approval_status == 'Pending'">
                           <!--<a ng-click="approveAdv(row.id,paginationControl.currentPage,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)"><button type="button" class="btn btn-primary btn-sm active">Approve</button></a> <a ng-click="disapproveAdv(row.id,paginationControl.currentPage,paginationControl.orderby,paginationControl.ordertype,paginationControl.searchKeyword)"><button type="button" class="btn btn-danger btn-sm active">Disapprove</button></a>-->

                           <a data-toggle="modal" data-target="#reason" ng-click="reasonPopup(row.id,'Approved')"><button type="button" class="btn btn-primary btn-sm active" title="Approve"><i class="{{\Config::get('constants.checkIcon')}}" aria-hidden="true"></i></button></a> 
                           <a data-toggle="modal" data-target="#reason" ng-click="reasonPopup(row.id,'Disapproved')"><button type="button" class="btn btn-primary btn-sm active" style="background-color: #ff4444; border-color: #ff4444" title="Disapprove"><i class="{{\Config::get('constants.closeIcon')}}" aria-hidden="true" ></i></button></a> 
                        </span>
                        <span ng-if="row.approval_status != 'Pending'">
                        @{{row.approval_status}}
                        </span>
                      @endif
                    </td>
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
              paging-action="advanceList(page, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword)">
            </div>
          </div> 
        </div>


      <!-- Modal for approval/disapproval reason -->
      <div class="modal fade" id="reason" tabindex="-1" role="dialog" aria-labelledby="reasonLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <label>Add Your Reason</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">
              <form ng-submit="advChangeApproval();" id="reason" name="reasonForm">
                <div class="flash-message" id="message" ng-hide="msgDisplay">
                  @include('common.flash_message') 
                  <span ng-view='reasonSuccess' ng-cloak ng-bind='reasonSuccess' class="alert alert-success" ng-show="reasonSuccess"></span>
                  <span ng-view='reasonDanger' ng-cloak ng-bind='reasonDanger' class="alert alert-danger" ng-show="reasonDanger"></span>
                </div>
                <input type="hidden" class="form-control" name="dataId" id="dataId" ng-model="dataId">
                <input type="hidden" class="form-control" name="status" id="status" ng-model="status">
                <div class="popup_form">
                  <div class="form-group has-feedback">
                    <label>Note</label>
                    <input type="text" class="form-control" id ="changeApprovalReason" ng-model="changeApprovalReason" name="changeApprovalReason" required/>
                    <span class="invalidInputErrorClass" ng-show="reasonForm.changeApprovalReason.$touched && reasonForm.changeApprovalReason.$error.required">The Reason is required</span>
                  </div>
                   

                  <div class="row submit-button-holder">
                    <div class="col-xs-8">    
                                            
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary" ng-disabled="reasonForm.$invalid">Submit</button>
                      <a class="btn btn-default btn-flat button_style_cancel" href="#">Cancel</a>
                    </div><!-- /.col -->
                  </div>


                </div>
                <div class="clearfix"></div>
              </form>
              </div>
            </div>
            <div class="modal-footer align_center">

            </div>
          </div>
        </div>
      </div>


  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script type="text/javascript">
    /*Cancel functionality of modal*/
    $('body').on('click','.button_style_cancel',function(){
      $('.close').click();
    });
  </script>
  <script src="{{ asset('/angularJs/angularModules/approval/approvalApp.js') }}"></script>
@endsection
