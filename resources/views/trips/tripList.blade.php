@extends('layouts.afterlogintemplate')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Trip</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Trips</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="tripsController" data-ng-init="tripList(paginationControl.currentPage, 'created_at', 'desc', paginationControl.searchKeyword)">
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
                  <input type="text" class="form-control"  name="searchKeyword" id="searchKeyword" placeholder="Search" ng-model="searchKeyword" maxlength="100"  ng-change="tripList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)" ng-keyup="tripList(paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, searchKeyword)">
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
                <table class="table table-bordered table-hover" id="tableContainer">
                  <tr>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'id',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">ID</a>
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
                      <a ng-click="tripList(paginationControl.currentPage,'trip_date',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Trip date</a>
                      <span ng-if="ordertype=='asc' && orderby=='trip_date'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='trip_date'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='trip_date'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'trip_type',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Consignment Type</a>
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
                      <a ng-click="tripList(paginationControl.currentPage,'lr_no',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">LR No</a>
                      <span ng-if="ordertype=='asc' && orderby=='lr_no'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='lr_no'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='lr_no'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'plant_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Plant Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='plant_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='plant_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='plant_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th class="trip_prtyname_col"> 
                      <a ng-click="tripList(paginationControl.currentPage,'party_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Party Name</a>
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
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'vendor_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Vendor Name</a>
                      <span ng-if="ordertype=='asc' && orderby=='vendor_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='vendor_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='vendor_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'truck_no',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Truck</a>
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
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'quantity',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Quantity</a>
                      <span ng-if="ordertype=='asc' && orderby=='quantity'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='quantity'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='quantity'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'bags',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Short Bags</a>
                      <span ng-if="ordertype=='asc' && orderby=='bags'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='bags'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='bags'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'trip_status',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Trip Status</a>
                      <span ng-if="ordertype=='asc' && orderby=='trip_status'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='trip_status'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='trip_status'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th class="trip_advncamount_col">
                      <a ng-click="tripList(paginationControl.currentPage,'advance_amount',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Advance Amount </a>
                      <span ng-if="ordertype=='asc' && orderby=='advance_amount'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='advance_amount'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='advance_amount'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th class="trip_dislamount_col">
                      <a ng-click="tripList(paginationControl.currentPage,'diesel_amount',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Diesel Amount </a>
                      <span ng-if="ordertype=='asc' && orderby=='diesel_amount'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='diesel_amount'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='diesel_amount'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th class="trip_status_col">
                      <a ng-click="tripList(paginationControl.currentPage,'POD_status',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">POD Status </a>
                      <span ng-if="ordertype=='asc' && orderby=='POD_status'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='POD_status'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='POD_status'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th>
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'user_name',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Added By </a>
                      <span ng-if="ordertype=='asc' && orderby=='user_name'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='user_name'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='user_name'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>
                      <a ng-click="tripList(paginationControl.currentPage,'closedByName',changedOrderType,paginationControl.searchKeyword)" style="cursor: pointer;">Closed By </a>
                      <span ng-if="ordertype=='asc' && orderby=='closedByName'" class="ascsort">
                        <i class="fa fa-sort-asc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="ordertype=='desc' && orderby=='closedByName'" class="descsort">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                      </span>
                      <span ng-if="orderby!='closedByName'" class="nosort">
                        <i class="fa fa-sort" aria-hidden="true"></i>
                      </span>
                    </th> 
                    <th>Status</th> 
                    @if(\Gate::check('trip_manage_edit') || \Gate::check('trip_manage_view') || \Gate::check('trip_manage_upload_pdo'))                      
                      <th>Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in records" ng-hide="(records|filter:paginationControl.searchKeyword).length == 0">
                      <td>SSLT000@{{row.id}}</td>
                      <td>@{{formatDate(row.trip_date) |  date:'dd-MM-yyyy'}}</td>
                      <td>@{{row.trip_type}}</td>
                      <td>@{{row.lr_no}}</td> 
                      <td>@{{row.plant_name}}</td> 
                      <td class="trip_prtyname_col">@{{row.party_name}}</td> 
                      <td>@{{row.vendor_name}}</td>
                      <td>@{{row.truck_no}}</td>
                      <td>@{{row.quantity}}</td> 
                      <td>@{{row.bags == NULL ? 'N/A' : row.bags}}</td>
                      <td>@{{row.trip_status}}</td>
                      <td class="trip_advncamount_col">
                        <!--<span ng-show="row.trip_status !== 'Completed'">-->
                          @{{row.advance_amount}}&nbsp;
                        <!--</span>-->


                        <a ng-show="row.canDo == 1" data-toggle="modal" ng-show="row.plantJournalLaserEditRequestCount == 0 && row.trip_status !== 'Completed'" data-target="#advEditRequestModal" title="ADV Edit Request" ng-click="advEditRequestPopup(row.id,paginationControl.currentPage)" title="Edit Request"><i class="{{\Config::get('constants.editRequestIcon')}}" aria-hidden="true" style="cursor: pointer;"></i></a>
                       
                        <!--<span ng-show="row.plantJournalLaserEditRequestApprovedCount > 0 && row.trip_status !== 'Closed'">
                          <input type="text" ng-model="row.advance_amount" name="advanceAmount" style="width: 55px;">
                          <a ng-click="savePlantEditRequest(row.id,row.advance_amount,row.plant_id)" style="cursor: pointer;">Save</a>
                        </span>-->
                      </td>
                      <td class="trip_dislamount_col">
                        <!--<span ng-show="row.trip_status !== 'Completed'">-->
                          @{{row.diesel_amount}}&nbsp;
                        <!--</span>-->

                        <!--<a href="" ng-show="row.petrolPumpJournalLaserEditRequestCount == 0 && row.trip_status !== 'Closed' && row.petrolPumpJournalLaserEditRequestApprovedCount == 0" title="DSL Edit Request" ng-click="DSLeditRequest(row.id)" title="Edit Request"><i class="{{\Config::get('constants.editRequestIcon')}}" aria-hidden="true"></i></a>-->

                        <a ng-show="row.canDo == 1" data-toggle="modal" ng-show="row.petrolPumpJournalLaserEditRequestCount == 0 && row.trip_status !== 'Completed'" title="DSL Edit Request" data-target="#dslEditRequestModal" ng-click="dslEditRequestPopup(row.id,paginationControl.currentPage)" title="Edit Request"><i class="{{\Config::get('constants.editRequestIcon')}}" aria-hidden="true" style="cursor: pointer;"></i></a>


                        <!--<span ng-show="row.petrolPumpJournalLaserEditRequestApprovedCount > 0 && row.trip_status !== 'Closed'">
                          <input type="text" ng-model="row.diesel_amount" name="dieselAmount" style="width: 55px;">
                          <a ng-click="savePetrolPumpEditRequest(row.id,row.diesel_amount)" style="cursor: pointer;">Save</a>
                        </span>-->
                      </td>
                      <td class="trip_status_col">
                        @{{row.POD_status}}  @{{row.podFileStatus}}
                      </td>
                      <td>@{{row.user_name}}</td>
                      <td>@{{row.closedByName}}</td>
                      <td>@{{row.status === 'A' ? 'Active' : 'Inactive'}} </td>
                      @if(\Gate::check('trip_manage_edit') || \Gate::check('trip_manage_view') || \Gate::check('trip_manage_upload_pdo'))
                        <td>
                           @can('trip_manage_edit')
                           <a ng-show="row.canDo == 1" ng-show="row.trip_status !== 'Completed'" href="<?php echo url(''); ?>/view-trip-edit-form/@{{row.id}}/@{{paginationControl.currentPage}}" title="Edit Trip"><i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @can('trip_manage_view')
                           <a href="<?php echo url(''); ?>/trip-view/@{{row.id}}/@{{paginationControl.currentPage}}" title="View Trip"><i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i></a>
                           @endcan
                           &nbsp;
                           @if(\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))
                             @can('trip_manage_delete')
                                <a ng-show="row.canDo == 1" style="cursor: pointer;" ng-click="deleteTrip(row.id,paginationControl.currentPage, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword);" title="Delete Trip"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
                             @endcan
                           @endif
                           &nbsp;
                           @can('trip_manage_upload_pdo')
                            <a ng-show="row.canDo == 1" data-toggle="modal" data-target="#myModal" ng-click="podPopup(row.id, paginationControl.currentPage)" title="Upload POD" ><i class="{{\Config::get('constants.folderIcon')}}" style="cursor:pointer;" aria-hidden="true"></i></a>
                            &nbsp;

                            @if(\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))
                              <a data-toggle="modal" data-target="#approvalModal" ng-click="podApprovePopup(row.id,paginationControl.currentPage)" title="Approve/Disapprove POD" ng-show="row.podFileStatus == '(Pending)'"> <i class="{{\Config::get('constants.paperPlaneIcon')}}" style="cursor:pointer;" aria-hidden="true"></i></a>
                            @endif
                           @endcan
                           &nbsp;
                           <a ng-show="row.canDo == 1" data-toggle="modal" ng-show="row.trip_status != 'Completed'" data-target="#tripCloseModal" ng-click="tripPopup(row.id,paginationControl.currentPage)" title="Close Trip"><i class="{{\Config::get('constants.completeIcon')}}" style="cursor:pointer;" aria-hidden="true"></i></a>
                        </td>
                      @endif
                  </tr>
                  <tr ng-hide="(records|filter:paginationControl.searchKeyword).length == 0" style="text-align: center;font-size: 20px; background: #BEE8F5">
                    <td colspan="6">&nbsp;</td>
                    <td colspan="2">Total Quantity</td>
                    <td colspan="1">@{{totalQty}}</td>
                    <td colspan="9">&nbsp;</td>
                  </tr>
                  <tr style="text-align: center;" ng-show="(records|filter:paginationControl.searchKeyword).length == 0">
                    <td colspan="18">No Record Found</td>
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
                paging-action="tripList(page, paginationControl.orderby, paginationControl.ordertype, paginationControl.searchKeyword)">
              </div> 
        </div> 
      </div>

      <!-- Modal for Uploading POD and list of POD -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <label>Upload POD</label>
              <button type="button" class="uploadPODclose close" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">

                <div class="flash-message" id="message" ng-hide="msgDisplay">
                  @include('common.flash_message') 
                  <span ng-view='podDeleteSuccess' ng-cloak ng-bind='podDeleteSuccess' class="alert alert-success" ng-show="podDeleteSuccess"></span>
                  <span ng-view='podDeleteDanger' ng-cloak ng-bind='podDeleteDanger' class="alert alert-danger" ng-show="podDeleteDanger"></span>
                </div>

                <!-- list of previously uploaded POD -->
                <table class="table table-bordered table-hover" id="tableContainer" ng-show="podRecords.length != 0">
                  <tr>
                    <th>ID</th>
                    <th>POD File</th>
                    <th>Status</th>
                    <th>Reason</th>
                    @if(\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))
                      <th>Action</th>
                    @endif
                  </tr>
                  <tr ng-repeat="row in podRecords">
                    <td>@{{row.id}}</td>
                    <td><a href="{{ asset(\Config::get('constants.tripPODPath')) }}/@{{row.pod_file}} " download>@{{row.pod_file}}</a></td>
                    <td>@{{row.status}}</td>
                    <td>@{{row.reason}}</td>
                    @if(\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))
                      <td>
                          <input type="hidden" class="form-control" name="deletePODCurrentPage" id="deletePODCurrentPage" ng-model="deletePODCurrentPage">
                          <a style="cursor: pointer;" ng-click="deletePOD(row.id);" title="Delete POD"><i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i></a>
                      </td>
                    @endif
                  </tr>
                  
                </table>    
                <!-- list of previously uploaded POD -->

              <form ng-submit="savePOD();" id="podForm" name="podForm" ng-hide="latestPODStatus == 'Pending' || latestPODStatus == 'OK CHALLAN' || latestPODStatus == 'STAMPED SHORT CHALLAN'">
                <div class="flash-message" id="message"></div>
                <input type="hidden" class="form-control" name="dataId" id="dataId" ng-model="dataId">
                <input type="hidden" class="form-control" name="uploadPODCurrentPage" id="uploadPODCurrentPage" ng-model="uploadPODCurrentPage">
                <div class="popup_form">
                  <div class="form-group has-feedback">
                     <input type="file" class="form-control" id ="podFile" ng-model="podFile" file-model="podFile" required style="border:none;" />

                     <span ng-view='podFileName' ng-cloak ng-bind='podFileName'></span>
                     <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.podFile.$touched && tripForm.podFile.$error.required">The POD File is required.</span>
                  </div>
                   
                  <div class="row submit-button-holder">
                    <div class="col-xs-8">    
                                            
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
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
      <!-- Modal for Uploading POD and list of POD  -->


      <!-- Modal for POD Status Change -->
      <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <label>Approve/Disapprove POD</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">
              <form ng-submit="saveTripPOD();" id="tripPodForm" name="tripPodForm">
                <div class="flash-message" id="message" ng-hide="msgDisplay">
                  @include('common.flash_message') 
                  <span ng-view='podSuccess' ng-cloak ng-bind='podSuccess' class="alert alert-success" ng-show="podSuccess"></span>
                  <span ng-view='podDanger' ng-cloak ng-bind='podDanger' class="alert alert-danger" ng-show="podDanger"></span>
                </div>
                <input type="hidden" class="form-control" name="dataId" id="dataId" ng-model="dataId">
                <input type="hidden" class="form-control" name="approvalModalCurrentPage" id="approvalModalCurrentPage" ng-model="approvalModalCurrentPage">

                <div class="popup_form">
                  <div class="form-group has-feedback">
                    <label>POD File : </label>
                    <a href="{{asset(\Config::get('constants.tripPODPath'))}}/@{{podFile}}" download>@{{podFile}}</a>
                  </div>
                  <div class="form-group has-feedback">
                      <label>Status</label><br>
                      <input type="radio" ng-model="status" name="status" value="OK CHALLAN" required> OK CHALLAN<br>
                      <input type="radio" ng-model="status" name="status" value="UNSTAMPED CHALLAN"> UNSTAMPED CHALLAN<br>
                      <input type="radio" ng-model="status" name="status" value="STAMPED SHORT CHALLAN" required> STAMPED SHORT CHALLAN<br>
                      <input type="radio" ng-model="status" name="status" value="UNSTAMPED SHORT CHALLAN"> UNSTAMPED SHORT CHALLAN<br>
                  </div>
   

                  <div class="form-group has-feedback" ng-show="status === 'STAMPED SHORT CHALLAN' || status === 'UNSTAMPED SHORT CHALLAN'">
                   <label>Short Bags</label>
                   <input type="text" class="form-control" name="bags" ng-model="bags" maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="numberPattern" ng-required="status === 'STAMPED SHORT CHALLAN' || status === 'UNSTAMPED SHORT CHALLAN'"/>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="tripPodForm.bags.$touched && tripPodForm.bags.$error.required">The Short Bags is required.</span>
                  </div>

                  <div class="form-group has-feedback" ng-show="status === 'STAMPED SHORT CHALLAN' || status === 'UNSTAMPED SHORT CHALLAN'">
                    <label>Remarks</label>
                    <input type="text" class="form-control" id ="remarks" ng-model="remarks" name="remarks"/>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="tripPodForm.remarks.$touched && tripPodForm.remarks.$error.required">The Remarks is required.</span>
                  </div>

                  <div class="form-group has-feedback">
                    <label>Reason</label>
                    <input type="text" class="form-control" id ="reason" ng-model="reason" name="reason"/>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="tripPodForm.reason.$touched && tripPodForm.reason.$error.required">The Reason is required.</span>
                  </div>
                  
                  <div class="row submit-button-holder">
                    <div class="col-xs-8">    
                                            
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary" ng-disabled="tripPodForm.$invalid">Submit</button>
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
      <!-- Modal for POD Status Change -->


      <!-- Modal for closing trip -->
      <div class="modal fade" id="tripCloseModal" tabindex="-1" role="dialog" aria-labelledby="tripCloseModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <label>Close Trip</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">
              <form ng-submit="closeTrip();" id="closeTripForm" name="closeTripForm">
                <div class="flash-message" id="message" ng-hide="msgDisplay">
                  @include('common.flash_message') 
                  <span ng-view='tripCloseSuccess' ng-cloak ng-bind='tripCloseSuccess' class="alert alert-success" ng-show="tripCloseSuccess"></span>
                  <span ng-view='tripCloseDanger' ng-cloak ng-bind='tripCloseDanger' class="alert alert-danger" ng-show="tripCloseDanger"></span>
                </div>
                <input type="hidden" class="form-control" name="tripDataId" id="tripDataId" ng-model="tripDataId">
                <input type="hidden" class="form-control" name="closeTripCurrentPage" id="closeTripCurrentPage" ng-model="closeTripCurrentPage">
                <div class="popup_form">
                  <div class="form-group has-feedback">
                    <label>Closing Reason</label>
                    <input type="text" class="form-control" id ="closingReason" name="closingReason" ng-model="closingReason" required/>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="closeTripForm.closingReason.$touched && closeTripForm.closingReason.$error.required">The Closing Reason is required.</span>
                  </div>
                   
                  <div class="row submit-button-holder">
                    <div class="col-xs-8">    
                                            
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary" ng-disabled="closeTripForm.$invalid">Submit</button>
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
      <!-- Modal for closing trip -->


      <!-- Modal for ADV Edit Request -->
      <div class="modal fade" id="advEditRequestModal" tabindex="-1" role="dialog" aria-labelledby="advEditRequestModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <label>Advance Amount Edit Request</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">
              <form ng-submit="ADVeditRequest();" id="advEditRequestForm" name="advEditRequestForm">
                <div class="flash-message" id="message" ng-hide="msgDisplay">
                  @include('common.flash_message') 
                  <span ng-view='advEditRequestSuccess' ng-cloak ng-bind='advEditRequestSuccess' class="alert alert-success" ng-show="advEditRequestSuccess"></span>
                  <span ng-view='advEditRequestDanger' ng-cloak ng-bind='advEditRequestDanger' class="alert alert-danger" ng-show="advEditRequestDanger"></span>
                </div>
                <input type="hidden" class="form-control" name="advEditRequestDataId" id="advEditRequestDataId" ng-model="advEditRequestDataId">
                <input type="hidden" class="form-control" name="advEditRequestCurrentPage" id="advEditRequestCurrentPage" ng-model="advEditRequestCurrentPage">
                <div class="popup_form">
                  <div class="form-group has-feedback">
                    <label>Advance Amount</label>
                    <input type="text" class="form-control" id ="advAmountPopUp" name="advAmountPopUp" ng-model="advAmountPopUp" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required/>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="advEditRequestForm.advAmountPopUp.$touched && advEditRequestForm.advAmountPopUp.$error.required">The Advance Amount is required.</span>
                  </div>
                   

                  <div class="row submit-button-holder">
                    <div class="col-xs-8">    
                                            
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary" ng-disabled="advEditRequestForm.$invalid">Submit</button>
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
      <!-- Modal for ADV Edit Request -->


      <!-- Modal for DSL Edit Request -->
      <div class="modal fade" id="dslEditRequestModal" tabindex="-1" role="dialog" aria-labelledby="dslEditRequestModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <label>Diesel Amount Edit Request</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
            </div>
            <div class="modal-body">
              <div class="modal_select">
              <form ng-submit="DSLeditRequest();" id="dslEditRequestForm" name="dslEditRequestForm">
                <div class="flash-message" id="message" ng-hide="msgDisplay">
                  @include('common.flash_message') 
                  <span ng-view='dslEditRequestSuccess' ng-cloak ng-bind='dslEditRequestSuccess' class="alert alert-success" ng-show="dslEditRequestSuccess"></span>
                  <span ng-view='dslEditRequestDanger' ng-cloak ng-bind='dslEditRequestDanger' class="alert alert-danger" ng-show="dslEditRequestDanger"></span>
                </div>
                <input type="hidden" class="form-control" name="dslEditRequestDataId" id="dslEditRequestDataId" ng-model="dslEditRequestDataId">
                <input type="hidden" class="form-control" name="dslEditRequestCurrentPage" id="dslEditRequestCurrentPage" ng-model="dslEditRequestCurrentPage">
                <div class="popup_form">
                  <div class="form-group has-feedback">
                    <label>DSL Amount</label>
                    <input type="text" class="form-control" name="dslAmountPopUp" id ="dslAmountPopUp" ng-model="dslAmountPopUp" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required/>
                    <span class="invalidInputErrorClass" ng-cloak ng-show="dslEditRequestForm.dslAmountPopUp.$touched && dslEditRequestForm.dslAmountPopUp.$error.required">The DSL Amount is required.</span>
                  </div>
                   
                  <div class="row submit-button-holder">
                    <div class="col-xs-8">    
                                            
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary" ng-disabled="dslEditRequestForm.$invalid">Submit</button>
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
      <!-- Modal for DSL Edit Request -->

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
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection
