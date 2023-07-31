@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Trip Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Trip Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" data-ng-controller="tripsController" data-ng-init="getTripDetail()">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Trip Details</h3>
            </div>
            <div class="box-body">
              <!-- Trip Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_view">
                    <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Basic Trip Information</h4></label></div>
                    </div>
                    <div class="row">
                          <div class="col-sm-6 col-xs-12 col-xs-12">
                            <div class="form-group has-feedback">
                              <label>ID : </label> SSLT000@{{record.id}}
                            </div>
                          </div>
                          <div class="col-sm-6 col-xs-12 col-xs-12">
                            <div class="form-group has-feedback">
                              <label>Trip Date : </label> @{{formatDate(record.trip_date) |  date:'dd-MM-yyyy'}} (@{{record.trip_type}} Consignment Trip)
                            </div>
                          </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>LR No : </label> @{{record.lr_no}} 
                        </div>
                      </div>  
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Shipment No : </label> @{{record.do_shipment_no}}  
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                           <label>Invoice/Challan No : </label> @{{record.invoice_challan_no}} 
                        </div>
                      </div>  
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Quantity(in Metric Ton) : </label> @{{record.quantity}}  
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Category : </label> @{{record.category_name}} 
                        </div>
                      </div>  
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Subcategory : </label> @{{subcatName}} 
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Trip Status : </label> @{{record.trip_status}}  
                        </div>
                      </div>                        
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>GPS Trip Status : </label> @{{record.GPS_trip_status}} 
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Additional 1 : </label> @{{record.additional1}}  
                        </div>
                      </div>                        
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Additional 2 : </label> @{{record.additional2}} 
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Additional 3 : </label> @{{record.additional3}} 
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>POD File : </label> 
                            <span ng-show="record.pod_file == ''">N/A</span>
                            <a ng-hide="record.pod_file == ''" href="{{ asset(\Config::get('constants.tripPODPath')) }}/@{{record.pod_file}} " download>@{{record.pod_file}}</a>  
                        </div>
                      </div>                        
                    </div>


                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>POD Status : </label> @{{record.POD_status}} @{{record.pod_file_status}} 
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>POD Uploaded At : </label> @{{formatDate(record.updated_at) |  date:'dd-MM-yyyy'}}  
                        </div>
                      </div>                        
                    </div>
                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Remarks : </label> @{{record.remarks == NULL ? 'N/A' : record.remarks}}   
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Short Bags : </label> @{{record.bags == NULL ? 'N/A' : record.bags}}  
                        </div>
                      </div>
                    </div>
                    <div class="row" ng-show="record.trip_status == 'Completed'">
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Closing Reason : </label> @{{record.closing_reason}} 
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                              <label>Closed At : </label> @{{formatDate(record.closed_at) |  date:'dd-MM-yyyy'}}  
                          </div>
                        </div>                        
                    </div>

                    <!--<div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Last Updated : </label> @{{formatDate(record.updated_at) |  date:'dd-MM-yyyy'}}  
                        </div>
                      </div>
                    </div>-->

                  </div>
                </div>
              </div>
              <!-- Trip Information -->



              <!-- Vendor Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_view">
                    <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Vendor & Truck Information</h4></label></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Vendor : </label> @{{record.company_name}}
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Truck : </label> @{{record.truck_no}}
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Truck Owner : </label>
                          @{{record.truck_owner == NULL ? 'N/A' : record.truck_owner}}
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                           <label>Advance Amount : </label> @{{record.advance_amount}}
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                          <label>Truck Driver Name : </label> @{{record.truck_driver_name}}  
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Truck Driver Phone Number : </label> @{{record.truck_driver_phone_number}}
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Truck Driver Email : </label> @{{record.truck_driver_email}}
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
              <!-- Company Information -->


              <!-- Plant & Party Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_view">
                      <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Plant & Party Information</h4></label></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Plant Name : </label> @{{record.plant_name}}
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Plant Address : </label> @{{record.start_location}}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Party Name : </label> @{{record.party_name}}
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Party Address : </label> @{{record.end_location}}
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>    
              <!-- Plant & Party Information -->



              <!-- Petrol Pump Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_view">
                      <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Petrol Pump Information</h4></label></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                            <label>Petrol Pump Name : </label> @{{record.petrol_pump_name}}
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                          <label>Diesel Amount : </label> @{{record.diesel_amount}}  
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-xs-12 col-xs-12">
                          <div class="form-group has-feedback">
                             <label>Description : </label> @{{record.description}}  
                          </div>
                        </div>
                      </div>
                  </div>    
                </div>  
              </div>  
              <!-- Petrol Pump Information -->

              <div class="row">
                    <div class="col-md-12 col-xs-12" style="text-align: center;">
                        <hr>
                        <a href="<?php echo URL('');?>/trips" class="btn btn-default btn-flat">Back</a>
                    </div>
            </div>
                
            </div>
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection

