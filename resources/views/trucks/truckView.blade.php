@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Truck Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Truck Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" data-ng-controller="trucksController" data-ng-init="getTruckDetail()">
        
        <div class="box">
          <div class="box-header with-border">
                <h3 class="box-title">Truck Details</h3>
          </div>
          <div class="box-body">
            
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="truck_view">
                    	<div class="row">
                            <div class="col-md-12 section-heading"><label><h4>Owner's Information</h4></label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>ID : </label> @{{record.truckDetails.id}}  
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Type : </label> 
                                    @{{record.truckDetails.type === 'C' ? 'Company' : 'Market'}} 
                                    ( @{{record.vendorName}} )
                                </div>
                            </div>
                        </div> 
                        
                         
                      	<div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                     <label>Status  : </label> @{{record.truckDetails.status === 'A' ? 'Active' : 'Inactive'}} 
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Last Updated  : </label>  
                                    @{{formatDate(record.truckDetails.updated_at) |  date:'dd-MM-yyyy'}} 
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
             
                <div class="col-md-6 col-xs-12">
                    <div class="truck_view">
                    	<div class="row">
                            <div class="col-md-12 section-heading"><label><h4>Registration Information</h4></label></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-12" ng-show="selectType==='C'">
                                <div class="form-group has-feedback">
                                    <label>Registration On : </label>   
                                    @{{formatDate(record.truckRegDetails.registered_on) |  date:'dd-MM-yyyy'}} 
                                </div>                        
                            </div>
                            <div class="col-md-6 col-xs-12"  ng-show="selectType==='C'">
                                <div class="form-group has-feedback">
                                    <label>Registration End : </label> 
                                    @{{formatDate(record.truckRegDetails.registration_end) |  date:'dd-MM-yyyy'}}  
                                </div>                        
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Registration File : </label>
                                    <span ng-show="record.truckRegDetails.registration_file == '' ">N/A</span> 
                                    <a ng-show="record.truckRegDetails.registration_file !== '' " href="{{ asset(\Config::get('constants.truckRegistrationPath')) }}/@{{record.truckRegDetails.registration_file}} " download>@{{record.truckRegDetails.registration_file}}</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Truck Number : </label> 
                                    @{{record.truckDetails.truck_no === 'undefined' ? '' : record.truckDetails.truck_no}}
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
                

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="truck_view" ng-show="selectType==='C'">
                        <div class="row">
                            <div class="col-md-12 section-heading"><label><h4>Permit Information</h4></label></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Permit Number : </label> @{{record.truckPermitDetails.permit_no}}  
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Permit On : </label>  
                                    @{{formatDate(record.truckPermitDetails.permit_on) |  date:'dd-MM-yyyy'}}   
                                </div>
                            </div>
                        </div>
                            
                            
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Permit End : </label> 
                                    @{{formatDate(record.truckPermitDetails.permit_end) |  date:'dd-MM-yyyy'}}   
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Permit File : </label> 
                                    <span ng-show="record.truckPermitDetails.permit_file == '' ">N/A</span> 
                                    <a ng-show="record.truckPermitDetails.permit_file !== '' " href="{{ asset(\Config::get('constants.truckPermitPath')) }}/@{{record.truckPermitDetails.permit_file}} " download>@{{record.truckPermitDetails.permit_file}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-6 col-xs-12">
                    <div class="truck_view" ng-show="selectType==='C'">
                        <div class="row">
                            <div class="col-md-12 section-heading"><label><h4>Insurance Information</h4></label></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Policy Number : </label> @{{record.truckInsuranceDetails.policy_no}}  
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Policy On : </label> 
                                    @{{formatDate(record.truckInsuranceDetails.policy_on) |  date:'dd-MM-yyyy'}} 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Policy End : </label> 
                                     @{{formatDate(record.truckInsuranceDetails.policy_end) |  date:'dd-MM-yyyy'}}  
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Policy File : </label>
                                    <span ng-show="record.truckInsuranceDetails.policy_file == '' ">N/A</span>  
                                    <a ng-show="record.truckInsuranceDetails.policy_file !== '' " href="{{ asset(\Config::get('constants.truckInsurancePath')) }}/@{{record.truckInsuranceDetails.policy_file}} " download>@{{record.truckInsuranceDetails.policy_file}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

               

            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="truck_view" ng-show="selectType==='C'">
                        <div class="row">
                            <div class="col-md-12 section-heading"><label><h4>Tax Information</h4></label></div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Invoice Number : </label> @{{record.truckTaxDetails.invoice_no}}  
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Tax Paid Date : </label> 
                                    @{{formatDate(record.truckTaxDetails.tax_paid_date) |  date:'dd-MM-yyyy'}}   
                                </div>
                            </div> 
                        </div>
                            
                                                    
                        <div class="row">                        
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Tax Period End : </label> 
                                     @{{formatDate(record.truckTaxDetails.tax_period_end) |  date:'dd-MM-yyyy'}}   
                                </div>
                            </div>
                        
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group has-feedback">
                                <label>Tax File : </label>
                                <span ng-show="record.truckTaxDetails.tax_file == '' ">N/A</span>  
                                <a ng-show="record.truckTaxDetails.tax_file !== '' " href="{{ asset(\Config::get('constants.trucktaxPath')) }}/@{{record.truckTaxDetails.tax_file}} " download>@{{record.truckTaxDetails.tax_file}}</a> 
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-6 col-xs-12">
                    <div class="truck_view" ng-show="selectType==='C'">
                        <div class="row">
                            <div class="col-md-12 section-heading"><label><h4>Pollution Information</h4></label></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Pollution Number : </label> @{{record.truckPollutionDetails.pollution_no}}  
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Pollution On : </label> 
                                     @{{formatDate(record.truckPollutionDetails.pollution_on) |  date:'dd-MM-yyyy'}}   
                                </div>
                            </div>
                        </div>
                    
                            
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Pollution End : </label>   
                                    @{{formatDate(record.truckPollutionDetails.pollution_end) |  date:'dd-MM-yyyy'}} 
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group has-feedback">
                                    <label>Pollution File : </label>
                                    <span ng-show="record.truckPollutionDetails.pollution_file == '' ">N/A</span>  
                                    <a ng-show="record.truckPollutionDetails.pollution_file !== '' " href="{{ asset(\Config::get('constants.truckPollutionPath')) }}/@{{record.truckPollutionDetails.pollution_file}} " download>@{{record.truckPollutionDetails.pollution_file}}</a>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-12 col-xs-12" style="text-align: center;">
                        <hr>
                        <a href="<?php echo URL('');?>/trucks" class="btn btn-default btn-flat">Back</a>
                    </div>
            </div>
            
          </div>
          <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/trucks/truckApp.js') }}"></script>
@endsection

